<?php

namespace App\Http\Controllers\Auth\Front;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Company;
use App\Providers\RouteServiceProvider;
use Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @return Factory|View
     */
    protected function showAdminLoginForm()
    {
        return view('auth.login');
    }

    /**
     * @return Factory|View
     */
    protected function showLoginForm()
    {
        return view('web.auth.login');
    }

    /**
     * @return Factory|View
     */
    protected function employeeLogin()
    {
        return view('web.auth.employer_login');
    }

    /**
     * @return Factory|View
     */
    protected function candidateLogin()
    {
        return view('web.auth.candidate_login');
    }

    /**
     * @param  Request  $request
     *
     * @return RedirectResponse
     */
    protected function sendLoginResponse(Request $request)
    {
        $type = $request->get('type');
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if (Auth::user()->hasRole('Employer') && $type == Company::COMPANY_LOGIN_TYPE) {
            $this->redirectTo = RouteServiceProvider::EMPLOYER_HOME;
        } else {
            if (Auth::user()->hasRole('Candidate') && $type == Candidate::CANDIDATE_LOGIN_TYPE) {
                $this->redirectTo = RouteServiceProvider::CANDIDATE_HOME;
            } else {
                Auth::logout();
                $section = ($type == Company::COMPANY_LOGIN_TYPE) ? 'users/employee-login' : 'users/candidate-login';

                return redirect('/'.$section)->withInput()->withErrors([
                    'error' => 'These credentials do not match our records.',
                ]);
            }
        }

        if (isset($request->remember)) {
            return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath())
                    ->withCookie(\Cookie::make('email', $request->email, 3600))
                    ->withCookie(\Cookie::make('password', $request->password, 3600))
                    ->withCookie(\Cookie::make('remember', 1, 3600));
        }

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath())
                ->withCookie(\Cookie::forget('email'))
                ->withCookie(\Cookie::forget('password'))
                ->withCookie(\Cookie::forget('remember'));
    }
}
