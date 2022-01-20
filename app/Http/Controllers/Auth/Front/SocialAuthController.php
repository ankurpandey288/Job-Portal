<?php

namespace App\Http\Controllers\Auth\Front;

use App\Http\Controllers\AppBaseController;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\SocialAccount;
use App\Providers\RouteServiceProvider;
use App\Providers\SocialAuthProviders\GoogleAuthProvider;
use App\Repositories\SocialAuthRepository;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Socialite;

/**
 * Class SocialAuthController
 */
class SocialAuthController extends AppBaseController
{
    /** @var SocialAuthRepository */
    private $socialAuthRepo;

    public const EMPLOYEE_TYPE = 0;

    public function __construct(SocialAuthRepository $socialAuthRepo)
    {
        $this->socialAuthRepo = $socialAuthRepo;
    }

    /**
     * @param  string  $provider
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirect($provider, Request $request)
    {
        Cache::put('type', $request->get('type'));

        /** @var GoogleAuthProvider $driver */
        return Socialite::driver($provider)->redirect();
    }

    /**
     * @param string $provider
     * @param Request $request
     *
     * @return RedirectResponse|Redirector
     */
    public function callback($provider, Request $request)
    {
        $socialUser = null;
        switch ($provider) {

            case SocialAccount::GOOGLE_PROVIDER:
                $accessToken = $request->get('code');
                $socialUser = $this->socialAuthRepo->getGoogleUserByToken($accessToken);
                break;

            case SocialAccount::FACEBOOK_PROVIDER:
                $accessToken = $request->get('code');
                $socialUser = $this->socialAuthRepo->getFacebookUserByToken($accessToken);
                break;

            case SocialAccount::LINKEDIN_PROVIDER:
                $accessToken = $request->get('code');
                $socialUser = $this->socialAuthRepo->getLinkedinUserByToken($accessToken);
                break;
        }

        $user = $this->socialAuthRepo->handleSocialUser($provider, $socialUser);
        $type = Cache::get('type', 1);

        Auth::loginUsingId($user->id, true);

        if (Auth::user()->hasRole('Candidate') && $type == Candidate::CANDIDATE_LOGIN_TYPE) {
            return redirect(RouteServiceProvider::CANDIDATE_HOME);
        }
        if (Auth::user()->hasRole('Employer') && $type == Company::COMPANY_LOGIN_TYPE) {
            return redirect(RouteServiceProvider::EMPLOYER_HOME);
        }

        Auth::logout();
        $section = ($type == Company::COMPANY_LOGIN_TYPE) ? 'employee-login' : 'candidate-login';

        return Redirect::to('/users/'.$section)
            ->withInput()
            ->withErrors([
                'error' => 'These credentials do not match our records.',
            ]);
    }
}
