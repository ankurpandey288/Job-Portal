<?php

namespace App\Http\Controllers;

use App\Models\FeaturedRecord;
use App\Models\FrontSetting;
use App\Models\Job;
use App\Models\Notification;
use App\Models\NotificationSetting;
use App\Models\Transaction;
use App\Models\User;
use Auth;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use View;

/**
 * Class FeaturedJobSubscriptionController
 */
class FeaturedJobSubscriptionController extends AppBaseController
{
    /**
     * @param  Request  $request
     *
     * @throws ApiErrorException
     *
     * @return JsonResponse
     */
    public function createSession(Request $request)
    {
        $amount = FrontSetting::where('key', 'featured_jobs_price')->first()->value;
        $jobId = $request->get('jobId');
        $job = Job::findOrFail($jobId);
        $user = Auth::user();
        $userEmail = $user->email;

        setStripeApiKey();
        $session = Session::create([
            'payment_method_types' => ['card'],
            'customer_email'       => $userEmail,
            'line_items'           => [
                [
                    'price_data'  => [
                        'product_data' => [
                            'name' => 'Make '.$job->job_title.' as featured Job',
                        ],
                        'unit_amount'  => $amount * 100,
                        'currency'     => 'USD',
                    ],
                    'quantity'    => 1,
                    'description' => 'Make '.$job->job_title.' as featured Job',
                ],
            ],
            'client_reference_id'  => $jobId,
            'mode'                 => 'payment',
            'success_url'          => url('job-payment-success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'           => url('job-failed-payment?error=payment_cancelled'),
        ]);
        $result = [
            'sessionId' => $session['id'],
        ];

        return $this->sendResponse($result, 'Session created successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return RedirectResponse|RedirectorStripe::setApiKey(<API-KEY>)
     */
    public function paymentSuccess(Request $request)
    {
        $sessionId = $request->get('session_id');

        if (empty($sessionId)) {
            throw new UnprocessableEntityHttpException('session_id required');
        }
        setStripeApiKey();

        $sessionData = \Stripe\Checkout\Session::retrieve($sessionId);

        $stripeID = $sessionData->id;
        $jobId = $sessionData->client_reference_id;
        $userId = getLoggedInUserId();
        $addDays = FrontSetting::where('key', 'featured_jobs_days')->first()->value;
        $adminId = User::role('Admin')->first()->id;

        $featuredRecord = [
            'owner_id'   => $jobId,
            'owner_type' => Job::class,
            'user_id'    => $userId,
            'stripe_id'  => $stripeID,
            'start_time' => Carbon::now(),
            'end_time'   => Carbon::now()->addDays($addDays),
            'meta'       => $sessionData->toJSON(),
        ];
        FeaturedRecord::create($featuredRecord);
        $loggedInUser = getLoggedInUser();
        NotificationSetting::whereKey(Notification::MARK_JOB_FEATURED)->where('type',
            'employer')->first()->value == 1 ?
            addNotification([
                Notification::MARK_JOB_FEATURED,
                $adminId,
                Notification::ADMIN,
                'Company '.$loggedInUser->first_name.' '.$loggedInUser->last_name.' marked as featured',
            ])
            : false;
        $transaction = [
            'owner_id'   => $jobId,
            'owner_type' => Job::class,
            'user_id'    => $userId,
            'amount'     => intval($sessionData->amount_total / 100),
        ];
        Transaction::create($transaction);
        Flash::success('Your Payment is successfully completed');

        return redirect(route('job.index'));
    }

    /**
     * @return Factory|View
     */
    public function handleFailedPayment()
    {
        Flash::error('Your Payment is not completed');

        return redirect(route('job.index'));
    }
}
