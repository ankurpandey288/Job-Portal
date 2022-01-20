<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Redirect;

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
        $this->middleware(['guest', 'setLanguage'])->except('logout');
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
     * Send the response after the user was authenticated.
     *
     * @param  Request  $request
     *
     * @return Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if (Auth::user()->hasRole('Admin')) {
            $this->redirectTo = RouteServiceProvider::ADMIN_HOME;
        }

        if (Auth::user()->hasRole(['Employer', 'Candidate'])) {
            Auth::logout();

            return Redirect::to('/admin/login')
                ->withInput()
                ->withErrors([
                    'error' => 'These credentials do not match our records.',
                ]);
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
