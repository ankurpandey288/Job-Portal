@extends('web.layouts.app')
@section('title')
    {{ __('web.login') }}
@endsection
@section('content')
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ __('web.login') }}</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="ptb80" id="login">
        <div class="container">
            <div class="col-md-6 col-md-offset-3 col-xs-12">
            @include('flash::message')
                <!-- Start of Nav Tabs -->
                <ul class="nav nav-tabs login-nav" role="tablist" id="loginTab">

                    <!-- Candidate Tab -->
                    <li role="presentation" class="active">
                        <a href="#candidate" aria-controls="candidate" role="tab" data-toggle="tab"
                           aria-expanded="true" id="linkCandidate">
                            <h6>{{ __('web.register_menu.candidate') }}</h6>
                        </a>
                    </li>

                    <!-- Employer Tab -->
                    <li role="presentation" class="">
                        <a href="#employer" aria-controls="employer" role="tab" data-toggle="tab"
                           aria-expanded="false" id="linkEmpolyee">
                            <h6>{{ __('web.register_menu.employer') }}</h6>
                        </a>
                    </li>
                </ul>

                <!-- Start of Tab Content -->
                <div class="tab-content">
                    <!-- Start of Tabpanel for Candidate Account -->
                    <div role="tabpanel" class="tab-pane active" id="candidate">
                        <div class="login-box">
                            <div class="login-title">
                                <h4>{{ __('web.login_menu.login_to') }} {{ __('web.register_menu.candidate') }}</h4>
                            </div>
                            <form method="POST" action="{{ route('front.login') }}" id="candidateForm">
                                @csrf
                                <div id="candidateValidationErrBox">
                                    @include('layouts.errors')
                                </div>
                                <input type="hidden" name="type" value="1"/>
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
                                                   id="remember" {{ (Cookie::get('remember') !== null) ? 'checked' : '' }}>
                                            <label for="remember">{{ __('web.login_menu.remember_me') }}</label>
                                        </div>
                                        <div class="col-xs-6 text-right">
                                            <a href="{{ route('password.request') }}">{{ __('web.login_menu.forget_password') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center pb15">
                                    <button class="btn btn-purple btn-effect">{{ __('web.login') }}</button>
                                    <a href="{{ route('front.register') }}"
                                       class="btn btn-purple btn-effect">{{ __('web.sign_up') }}</a>
                                </div>
                                <div class="form-group text-center ml20">
                                    <div class="social-login-buttons d-flex flex-md-wrap justify-content-center">
                                        <a class="google-login" href="{{ url('/login/google?type=1') }}"><i
                                                    class="fa fa-google"></i>
                                            {{ __('web.login_menu.login_via_google') }}</a>
                                        <a class="facebook-login" href="{{ url('/login/facebook?type=1') }}"><i
                                                    class="fa fa-facebook"></i> {{ __('web.login_menu.login_via_facebook') }}
                                        </a>

                                        <a class="linkedin-login" href="{{ url('/login/linkedin?type=1') }}"><i
                                                    class="fa fa-linkedin"></i> {{ __('web.login_menu.login_via_linkedin') }}
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End of Tabpanel for Candidate Account -->

                    <!-- Start of Tabpanel for Employer Account -->
                    <div role="tabpanel" class="tab-pane" id="employer">
                        <div class="login-box">
                            <div class="login-title">
                                <h4>{{ __('web.login_menu.login_to') }} {{ __('web.register_menu.employer') }}</h4>
                            </div>
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
                                    <button class="btn btn-purple btn-effect">{{ __('web.login') }}</button>
                                    <a href="{{ route('front.register') }}"
                                       class="btn btn-purple btn-effect">{{ __('web.sign_up') }}</a>
                                </div>
                                <div class="form-group text-center ml20">
                                    <div class="social-login-buttons d-flex flex-md-wrap justify-content-center">
                                        <a class="google-login" href="{{ url('/login/google?type=0') }}"><i
                                                    class="fa fa-google"></i>
                                            {{ __('web.login_menu.login_via_google') }}</a>
                                        <a class="facebook-login" href="{{ url('/login/facebook?type=0') }}"><i
                                                    class="fa fa-facebook"></i> {{ __('web.login_menu.login_via_facebook') }}
                                        </a>
                                        <a class="linkedin-login" href="{{ url('/login/linkedin?type=1') }}"><i
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
                <!-- End of Nav Tabs -->
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
