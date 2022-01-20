<?php

namespace App\Repositories;

use App\Models\Notification;
use App\Models\NotificationSetting;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Checkout\Session;
use Stripe\StripeClient;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class SubscriptionRepository
{
    /**
     * @param  User  $user
     *
     * @throws Exception
     *
     * @return bool
     */
    public function createStripeCustomer($user)
    {
        try {
            $plan = $this->getDefaultPlan();

            DB::beginTransaction();
            /** @var Subscription $userSubscription */
            $userSubscription = new Subscription();
            $userSubscription->fill([
                'user_id'              => $user->id,
                'name'                 => $plan->name,
                'plan_id'              => $plan->id,
                'stripe_status'        => 'trialing',
                'trial_ends_at'        => Carbon::now()->addYears(10)->toDateTimeString(),
                'current_period_start' => Carbon::now()->toDateTimeString(),
                'current_period_end'   => Carbon::now()->addYears(10)->toDateTimeString(),
            ]);

            $userSubscription->save();

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param  string  $sessionId
     *
     * @throws Exception
     *
     * @return Subscription
     */
    public function purchaseSubscription($sessionId)
    {
        try {
            setStripeApiKey();
            /** @var Session $sessionData */
            $sessionData = Session::retrieve($sessionId);

            $subscriptionId = $sessionData->subscription;
            $stripe = new StripeClient(
                config('services.stripe.secret_key')
            );

            /** @var \Stripe\Subscription $subscription */
            $subscription = $stripe->subscriptions->retrieve(
                $subscriptionId,
                []
            );

            $customerId = $sessionData->customer;

            /** @var Subscription $userSubscription */
            $userSubscription = Subscription::whereStripeId($subscriptionId)->exists();

            if ($userSubscription) {
                throw new UnprocessableEntityHttpException('Account Subscription already exists.');
            }

            /** @var User $user */
            $user = Auth::user();
            $stripePlan = $subscription->items->first()->plan;

            /** @var Plan $plan */
            $plan = Plan::whereStripePlanId($stripePlan->id)->firstOrFail();

            /** @var \Stripe\Subscription $subscription */
            $subscription = \Stripe\Subscription::retrieve(
                $subscriptionId
            );

            /** @var Subscription $existingSubscription */
            $existingSubscription = Subscription::NotOnTrial()
                ->whereUserId($user->id)
                ->active()
                ->first();

            // end trial subscription
            Subscription::whereUserId($user->id)->where(function (Builder $query) {
                $query->where('stripe_status', '=', 'trialing');
            })->whereNotNull('trial_ends_at')
                ->update([
                    'ends_at'       => Carbon::now(),
                    'trial_ends_at' => Carbon::now(),
                ]);

            /** @var Subscription $tsSubscription */
            $tsSubscription = Subscription::create([
                'name'                 => $plan->name,
                'stripe_id'            => $subscriptionId,
                'stripe_status'        => $subscription->status,
                'stripe_plan'          => $stripePlan->id,
                'user_id'              => $user->id,
                'plan_id'              => $plan->id,
                'current_period_start' => isset($subscription->current_period_start) ? Carbon::createFromTimestamp($subscription->current_period_start) : null,
                'current_period_end'   => isset($subscription->current_period_start) ? Carbon::createFromTimestamp($subscription->current_period_end) : null,
            ]);
            $adminId = User::role('Admin')->first()->id;
            NotificationSetting::whereKey(Notification::EMPLOYER_PURCHASE_PLAN)->first()->value == 1 ?
                addNotification([
                    Notification::EMPLOYER_PURCHASE_PLAN,
                    $adminId,
                    Notification::ADMIN,
                    $user->first_name.' '.$user->last_name.' purchase '.$plan->name,
                ]) : false;

            $price = $subscription->items->data[0]->price;
            $invoiceId = $subscription->latest_invoice;
            $transaction = (new Transaction())->fill([
                'user_id'    => $tsSubscription->user_id,
                'owner_id'   => $tsSubscription->id,
                'owner_type' => Subscription::class,
                'amount'     => intval($price->unit_amount / 100),
                'invoice_id' => $invoiceId,
            ]);

            $transaction->save();

            if (empty($user->stripe_id)) {
                $user->stripe_id = $customerId;
                $user->save();
            }

            // if another account subscription already running than cancel it
            if ($existingSubscription && $existingSubscription->user_id === $user->id) {
                // immediately cancel old subscription from strip
                if (! $existingSubscription->paypal_payment_id) {
                    $subscription = \Stripe\Subscription::retrieve(
                        $existingSubscription->stripe_id
                    );

                    $subscription->delete([
                        'prorate'     => true,
                        'invoice_now' => true,
                    ]);
                }

                $existingSubscription->update(['ends_at' => Carbon::now()]);
            }

            DB::commit();

            return $tsSubscription;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @throws Exception
     *
     * @return Plan|Builder|Model|object|null
     */
    public function getDefaultPlan()
    {
        /** @var Plan $plan */
        $plan = Plan::where('is_trial_plan', true)->first();

        if (empty($plan)) {
            /** @var Plan $plan */
            $plan = Plan::first();
        }

        if (empty($plan)) {
            throw new Exception('Not able to find any plan');
        }

        return $plan;
    }

    /**
     * @param  int  $userId
     *
     * @return Subscription|bool
     */
    public function getUserSubscription($userId)
    {
        /** @var Subscription $subscription */
        $subscription = Subscription::whereUserId($userId)
            ->active()
            ->latest()
            ->first();

        if (! $subscription) {
            return false;
        }

        if ($subscription->paypal_payment_id && $subscription->current_period_end <= Carbon::now()) {
            return false;
        }

        return $subscription;
    }

    /**
     * @param  array  $input
     */
    public function updateSubscription($input)
    {
        $subscriptionId = $input['data']['object']['id'];
        $subscription = Subscription::whereStripeId($subscriptionId)->first();

        if ($subscription) {
            try {
                DB::beginTransaction();
                $tsSubscription = $subscription->update([
                    'stripe_id'            => $subscriptionId,
                    'stripe_status'        => $input['data']['object']['status'],
                    'current_period_start' => isset($input['data']['object']['current_period_start']) ? Carbon::createFromTimestamp($input['data']['object']['current_period_start']) : null,
                    'current_period_end'   => isset($input['data']['object']['current_period_end']) ? Carbon::createFromTimestamp($input['data']['object']['current_period_end']) : null,
                ]);

                // update subscription if it's cancelled
                if ($input['data']['object']['cancel_at_period_end']) {
                    if ($subscription->onTrial()) {
                        $subscription->ends_at = $subscription->trial_ends_at;
                    } else {
                        $subscription->ends_at = Carbon::createFromTimestamp(
                            $input['data']['object']['current_period_end']
                        );
                    }
                    $subscription->save();
                }

                $price = $input['data']['object']['items']['data'][0]['price'];
                $invoiceId = $input['data']['object']['latest_invoice'];
                $transaction = (new Transaction())->fill([
                    'user_id'         => $subscription->user_id,
                    'subscription_id' => $subscription->id,
                    'amount'          => intval($price['unit_amount'] / 100),
                    'invoice_id'      => $invoiceId,
                ]);

                $transaction->save();
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                Log::info($e->getMessage());
            }
        }
    }
}
