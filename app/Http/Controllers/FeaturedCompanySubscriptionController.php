<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\FeaturedRecord;
use App\Models\FrontSetting;
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
 * Class FeaturedCompanySubscriptionController
 */
class FeaturedCompanySubscriptionController extends AppBaseController
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
        $amount = FrontSetting::where('key', 'featured_companies_price')->first()->value;
        $companyId = $request->get('companyId');
        $company = Company::with('user')->findOrFail($companyId);
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
                            'name' => 'Make '.$company->user->first_name.' as featured Company',
                        ],
                        'unit_amount'  => $amount * 100,
                        'currency'     => 'USD',
                    ],
                    'quantity'    => 1,
                    'description' => 'Make '.$company->user->first_name.' as featured Company',
                ],
            ],
            'client_reference_id'  => $companyId,
            'mode'                 => 'payment',
            'success_url'          => url('company-payment-success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'           => url('company-failed-payment?error=payment_cancelled'),
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
        $companyId = $sessionData->client_reference_id;
        $userId = getLoggedInUserId();
        $addDays = FrontSetting::where('key', 'featured_companies_days')->first()->value;

        $company = Company::findOrFail($companyId);
        $employer = User::findOrFail($company->user_id);
        $adminId = User::role('Admin')->first()->id;

        $featuredRecord = [
            'owner_id'   => $companyId,
            'owner_type' => Company::class,
            'user_id'    => $userId,
            'stripe_id'  => $stripeID,
            'start_time' => Carbon::now(),
            'end_time'   => Carbon::now()->addDays($addDays),
            'meta'       => $sessionData->toJSON(),
        ];
        FeaturedRecord::create($featuredRecord);
        NotificationSetting::whereKey(Notification::MARK_COMPANY_FEATURED)->where('type',
            'employer')->first()->value == 1 ?
            addNotification([
                Notification::MARK_COMPANY_FEATURED,
                $adminId,
                Notification::ADMIN,
                'The company marked as featured by '.$employer->first_name.' '.$employer->last_name,
            ])
            : false;
        $transaction = [
            'owner_id'   => $companyId,
            'owner_type' => Company::class,
            'user_id'    => $userId,
            'amount'     => intval($sessionData->amount_total / 100),
        ];
        Transaction::create($transaction);
        Flash::success('Your Payment is successfully completed');

        return redirect(route('company.edit.form', $companyId));
    }

    /**
     * @return Factory|View
     */
    public function handleFailedPayment()
    {
        $companyId = Auth::user()->company->id;
        Flash::error('Your Payment is not completed');

        return redirect(route('company.edit.form', $companyId));
    }
}
