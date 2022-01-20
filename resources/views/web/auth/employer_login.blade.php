@extends('web.layouts.app')
@section('title')
    {{ __('web.login') }}
@endsection
@section('content')
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ __('web.login_menu.login_to') }} {{ __('web.register_menu.employer') }}</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="ptb80" id="login">
        <div class="container">
            <div class="col-md-6 col-md-offset-3 col-xs-12">
            @include('flash::message')
            <!-- Start of Tab Content -->
                <div class="tab-content">
                    <!-- Start of Tabpanel for Employer Account -->
                    <div id="employer">
                        <div class="login-box">
                            <form method="POST" action="{{ route('front.login') }}" id="employeeForm">
                                @csrf
                                <div id="employerValidationErrBox">
                                    @include('layouts.errors')
                                </div>
                                <input type="hidden" name="type" value="0"/>
                                <div class="form-group">
                                    <label>{{ __('web.common.email') }}</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                           placeholder="Your Email"
                                           value="{{ (Cookie::get('email') !== null) ? Cookie::get('email') : old('email') }}"
                                           autofocus required>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('web.common.password') }}</label>
                                    <input type="password" name="password" class="form-control" id="password"
                                           placeholder="Your Password"
                                           value="{{ (Cookie::get('password') !== null) ? Cookie::get('password') : null }}"
                                           required>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <input type="checkbox" name="remember" class="custom-control-input"
                                                   id="rememberemployer" {{ (Cookie::get('remember') !== null) ? 'checked' : '' }}>
                                            <label for="rememberemployer">{{ __('web.login_menu.remember_me') }}</label>
                                        </div>
                                        <div class="col-xs-6 text-right">
                                            <a href="{{ route('password.request') }}">{{ __('web.login_menu.forget_password') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center pb15">
                                    <button class="btn btn-purple btn-effect btn-login">{{ __('web.login') }}</button>
                                    <a href="{{ route('employer.register') }}"
                                       class="btn btn-purple btn-effect btn-login">{{ __('web.sign_up') }}</a>
                                </div>
                                <div class="form-group text-center ml20">
                                    <div class="social-login-buttons d-flex flex-md-wrap justify-content-center">
                                        <a class="google-login btn-login" href="{{ url('/login/google?type=0') }}"><i
                                                    class="fa fa-google"></i>
                                            {{ __('web.login_menu.login_via_google') }}</a>
                                        <a class="facebook-login btn-login"
                                           href="{{ url('/login/facebook?type=0') }}"><i
                                                    class="fa fa-facebook"></i> {{ __('web.login_menu.login_via_facebook') }}
                                        </a>
                                        <a class="facebook-login btn-login"
                                           href="{{ url('/login/linkedin?type=0') }}"><i
                                                    class="fa fa-linkedin"></i> {{ __('web.login_menu.login_via_linkedin') }}
                                        </a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <!-- End of Tabpanel for Employer Account -->
                </div>
                <!-- End of Tab Content -->
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        let registerSaveUrl = "{{ route('front.save.register') }}";
    </script>
    <script src="{{mix('assets/js/front_register/front_register.js')}}"></script>
@endsection
