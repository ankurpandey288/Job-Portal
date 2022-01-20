<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Flash;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN_HOME;

    /**
     * @param  Request  $request
     *
     * @return string
     */
    public function redirectTo(Request $request)
    {
        if (getLoggedInUser() != null) {
            if (Auth::user()->hasRole('Admin')) {
                return RouteServiceProvider::ADMIN_HOME;
            }

            if (Auth::user()->hasRole('Employer')) {
                return RouteServiceProvider::EMPLOYER_HOME;
            }

            if (Auth::user()->hasRole('Candidate')) {
                return RouteServiceProvider::CANDIDATE_HOME;
            }
        } else {
            $userRole = User::find($request->route('id'))->roles()->first()->name;
            if ($userRole == 'Candidate') {
                Flash::success('You have successfully verified your email. Please login !');

                return route('front.candidate.login');
            } else {
                Flash::success('You have successfully verified your email. Please login !');

                return route('front.employee.login');
            }
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  Request  $request
     *
     * @throws AuthorizationException
     *
     * @return RedirectResponse|Redirector
     */
    public function verify(Request $request)
    {
        /** @var User $user */
        $user = User::find($request->id);

        if ($request->route('id') != $user->getKey()) {
            throw new AuthorizationException;
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect($this->redirectTo($request))->with('verified', true);
    }
}
