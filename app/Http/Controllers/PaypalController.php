<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\NotificationSetting;
use App\Models\Plan as SubscriptionPlan;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Input;
use Laracasts\Flash\Flash;
use PayPal\Api\Amount;
use PayPal\Api\ExecutePayment;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use Stripe\StripeClient;
use URL;

/** All Paypal Details class **/
class PaypalController extends Controller
{
    private $_api_context;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /** setup PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'],
            $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    /**
     * @param  SubscriptionPlan  $plan
     *
     * @return mixed
     */
    public function oneTimePayment(SubscriptionPlan $plan)
    {
        if ($plan->salaryCurrency != null && ! in_array($plan->salaryCurrency->currency_code,
                getPayPalSupportedCurrencies())) {
            Flash::error('This currency is not supported by PayPal for making payments.');

            return redirect()->route('manage-subscription.index');
        }
        $currency = $plan->with('salaryCurrency')->findOrFail($plan->id);
        $amountToBePaid = (int) $plan->amount;
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();
        $item_1->setName('Subscription Payment')/** item name **/
        ->setCurrency($plan->salaryCurrency != null ? $currency->salaryCurrency->currency_code : 'USD')
            ->setQuantity(1)
            ->setPrice($amountToBePaid);
        /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems([$item_1]);

        $amount = new Amount();
        $amount->setCurrency($plan->salaryCurrency != null ? $currency->salaryCurrency->currency_code : 'USD')
            ->setTotal($amountToBePaid);
        $redirect_urls = new RedirectUrls();
        /** Specify return URL **/
        $redirect_urls->setReturnUrl(URL::route('status'))
            ->setCancelUrl(URL::route('status'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions([$transaction]);
        try {
            $payment->create($this->_api_context);
        } catch (\Exception $ex) {
            if (\Config::get('app.debug')) {
                Flash::error('Connection timeout.');

                return Redirect::route('manage-subscription.index');
            } else {
                Flash::error('Some error occur, sorry for inconvenient.');

                return Redirect::route('manage-subscription.index');
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        /** add payment ID to session **/
        \Session::put('paypal_payment_id', $payment->getId());
        \Session::put('plan_id', $plan->id);
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }

        \Session::put('error', 'Unknown error occurred');

        return Redirect::route('manage-subscription.index');
    }

    /**
     * @param  Request  $request
     *
     * @return mixed
     */
    public function getPaymentStatus(Request $request)
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        $planId = Session::get('plan_id');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        Session::forget('plan_id');
        if (empty($request->PayerID) || empty($request->token)) {
            session()->flash('error', 'Payment failed');

            return Redirect::route('manage-subscription.index');
        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->PayerID);
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
            session()->flash('success', 'Payment success');
            $stripe = new StripeClient(
                config('services.stripe.secret_key')
            );
            setStripeApiKey();
            /** @var User $user */
            $user = Auth::user();

            /** @var \App\Models\Plan $plan */
            $plan = SubscriptionPlan::findOrFail($planId);

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
                'stripe_status'        => 'active',
                'user_id'              => $user->id,
                'plan_id'              => $plan->id,
                'current_period_start' => Carbon::now(),
                'current_period_end'   => Carbon::now()->addMonth(),
                'paypal_payment_id'    => $payment_id,
            ]);
            $adminId = User::role('Admin')->first()->id;
            NotificationSetting::whereKey(Notification::EMPLOYER_PURCHASE_PLAN)->first()->value == 1 ?
                addNotification([
                    Notification::EMPLOYER_PURCHASE_PLAN,
                    $adminId,
                    Notification::ADMIN,
                    $user->first_name.' '.$user->last_name.' purchase '.$plan->name,
                ]) : false;

            $transaction = (new \App\Models\Transaction())->fill([
                'user_id'    => $tsSubscription->user_id,
                'owner_id'   => $tsSubscription->id,
                'owner_type' => Subscription::class,
                'amount'     => $plan->amount,
            ]);

            $transaction->save();

            // if another account subscription already running than cancel it
            if ($existingSubscription && $existingSubscription->user_id === $user->id) {
                // immediately cancel old subscription from strip
                $existingSubscription->update(['ends_at' => Carbon::now()]);
            }

            return Redirect::route('manage-subscription.index');
        }
        session()->flash('error', 'Payment failed');

        return Redirect::route('manage-subscription.index');
    }
}
