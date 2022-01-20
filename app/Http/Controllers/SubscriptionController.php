<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use App\Repositories\PlanRepository;
use App\Repositories\SubscriptionRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Stripe\Checkout\Session;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Webhook;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use UnexpectedValueException;

class SubscriptionController extends AppBaseController
{
    private $subscriptionRepository;

    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    /**
     * @throws Exception
     * @return Factory|View
     */
    public function index()
    {
        /** @var PlanRepository $planRepo */
        $planRepo = app(PlanRepository::class);
        $plans = $planRepo->getPlans();

        return view('pricing.index')->with($plans);
    }

    /**
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return mixed
     */
    public function purchaseSubscription(Request $request)
    {
        $planId = $request->get('plan_id');
        if (empty($planId)) {
            throw new Exception('plan_id required', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /** @var Plan $plan */
        $plan = Plan::with('salaryCurrency')->findOrFail($planId);

        if (! $plan->stripe_plan_id) {
            createStripePlan($plan);
        }

        $plan->refresh();

        /** @var User $user */
        $user = Auth::user();

        $userEmail = isset($user->email) ? $user->email : null;

        setStripeApiKey();
        $session = Session::create([
            'payment_method_types' => ['card'],
            'customer_email'       => $userEmail,
            'subscription_data'    => [
                'items' => [
                    ['plan' => $plan->stripe_plan_id],
                ],
            ],
            'success_url'          => url('employer/payment-success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'           => url('employer/failed-payment?error=payment_cancelled'),
        ]);
        $result = [
            'sessionId' => $session['id'],
        ];

        return $this->sendResponse($result, 'Subscription resumed successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return RedirectResponse|Redirector
     */
    public function paymentSuccess(Request $request)
    {
        $sessionId = $request->get('session_id');
        if (empty($sessionId)) {
            throw new UnprocessableEntityHttpException('session_id required');
        }

        /** @var SubscriptionRepository $subscriptionRepo */
        $subscriptionRepo = app(SubscriptionRepository::class);
        $subscriptionRepo->purchaseSubscription($sessionId);

        return redirect(route('manage-subscription.index'));
    }

    /**
     * @return Factory|View
     */
    public function handleFailedPayment()
    {
        return view('transactions.failed_payments');
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function cancelSubscription(Request $request)
    {
        $input = $request->all();

        /** @var User $user */
        $user = Auth::user();

        setStripeApiKey();
        /** @var Subscription $subscription */
        $subscription = $user->subscriptions()->active()->first();

        if (! $subscription) {
            return $this->sendError('Yor are not author of subscription. so you are not allowed to cancel this subscription.');
        }

        $subscription->cancellation_reason = $input['cancellation_reason'];

        ! $subscription->paypal_payment_id ? $subscription->cancel() : $subscription->ends_at = Carbon::now();

        $subscription->save();

        return $this->sendSuccess('Subscription cancelled successfully.');
    }

    /**
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function purchaseTrialSubscription()
    {
        /** @var User $user */
        $user = Auth::user();

        /** @var SubscriptionRepository $subscriptionRepo */
        $subscriptionRepo = app(SubscriptionRepository::class);

        $result = $subscriptionRepo->createStripeCustomer($user);

        return $this->sendResponse($result, 'Subscription resumed successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @return bool
     */
    public function updateSubscription(Request $request)
    {
        $stripeWebHookSecret = config('services.stripe.webhook_secret_key');
        $data = $request->all();

        $payload = @file_get_contents('php://input');
        $sigHeader = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = Webhook::constructEvent(
                $payload, $sigHeader, $stripeWebHookSecret
            );
            $input = $request->all();
            $this->subscriptionRepository->updateSubscription($input);

            return true;
        } catch (UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        } catch (SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(400);
            exit();
        }
    }

    /**
     * @param  Plan  $plan
     *
     * @return Application|Factory|View
     */
    public function showPaymentSelect(Plan $plan)
    {
        return view('pricing.payment_methods', compact('plan'));
    }
}
