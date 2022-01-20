<?php

namespace App\Repositories;

use App\Models\Company;
use App\Models\Job;
use App\Models\Plan;
use App\Models\Subscription;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PlanRepository
{
    /**
     * @param $input
     *
     * @throws Exception
     *
     * @return bool
     */
    public function createPlan($input)
    {
        $input['amount'] = formatNumber($input['amount']);

        try {
            DB::beginTransaction();

            /** @var Plan $plan */
            $plan = Plan::create($input);

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * @param  array  $input
     * @param  Plan  $plan
     *
     * @throws Exception
     *
     * @return bool
     */
    public function updatePlan($input, $plan)
    {
        $input['amount'] = formatNumber($input['amount']);

        try {
            DB::beginTransaction();
            $plan->update($input);

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * @param  Plan  $plan
     *
     * @throws Exception
     */
    public function deletePlan($plan)
    {
        try {
            DB::beginTransaction();

            $plan->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        try {
            $stripe = new \Stripe\StripeClient(
                config('services.stripe.secret_key')
            );
            $deletedStripePlan = $stripe->plans->delete(
                $plan->stripe_plan_id,
                []
            );
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    /**
     * @throws Exception
     *
     * @return null
     */
    public function getPlans()
    {
        /** @var Company $company */
        $company = Company::whereUserId(Auth::id())->first();

        $data['subscription'] = Subscription::whereUserId($company->user_id)
            ->active()
            ->latest()
            ->first();

        $data['activePlanId'] = null;

        if ($data['subscription'] && $data['subscription']->paypal_payment_id && $data['subscription']->current_period_end <= Carbon::now()->toDayDateTimeString()) {
            $data['activePlanId'] = $data['subscription']->plan_id;
            $data['subscription'] = null;
        }

        $data['jobsCount'] = Job::whereStatus(Job::STATUS_OPEN)->where('company_id', $company->id)->where('is_created_by_admin',0)->count();

        $data['plans'] = Plan::orderBy('amount', 'ASC')->with('salaryCurrency')->get();

        return $data;
    }
}
