@extends('web.layouts.app')
@section('title')
    {{ __('web.register') }}
@endsection
@section('content')
    <!-- =============== Start of Page Header 1 Section =============== -->
    <section class="page-header">
        <div class="container">
            <!-- Start of Page Title -->
            <div class="row">
                <div class="col-md-12">
                    <h2>{{__('messages.company.employer').' '.__('web.register') }}</h2>
                </div>
            </div>
            <!-- End of Page Title -->
        </div>
    </section>
    <!-- =============== End of Page Header 1 Section =============== -->

    <!-- ===== Start of Login - Register Section ===== -->
    <section class="ptb80" id="register">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Start of Tabpanel for Employer Account -->
                    <div id="employer">
                        {{ Form::open(['id'=>'addEmployerNewForm']) }}
                        <input type="hidden" name="type" value="2">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="form-group">
                                    <label>{{ __('web.common.name').":" }} <span
                                                class="required asterisk-size">*</span></label>
                                    <input type="text" name="first_name" id="employerFirstName" class="form-control"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('web.common.email').":" }} <span
                                                class="required asterisk-size">*</span></label>
                                    <input type="email" name="email" id="employerEmail" class="form-control"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('web.common.password').":" }}<span
                                                class="required asterisk-size">*</span></label>
                                    <input type="password" name="password" id="employerPassword"
                                           class="form-control" required onkeypress="return avoidSpace(event)">
                                </div>
                                <div class="form-group">
                                    <label>{{ __('web.common.confirm_password').":" }}<span
                                                class="required asterisk-size">*</span></label>
                                    <input type="password" name="password_confirmation" id="employerConfirmPassword"
                                           class="form-control" required onkeypress="return avoidSpace(event)">
                                </div>
                                <div class="form-check mb20">
                                    <input type="checkbox" class="form-check-input" name="privacyPolicy"
                                           id="exampleCheck1" checked>
                                    <label class="form-check-label"
                                           for="exampleCheck1">{{ __('messages.by_signing_up_you_agree_to_our') }}
                                        <a href="{{ route('terms.conditions.list') }}">{{ __('messages.setting.terms_conditions') }}</a>
                                        &
                                        <a href="{{ route('privacy.policy.list') }}">{{ __('messages.setting.privacy_policy') }}</a>.
                                    </label>
                                </div>
                                @if($isGoogleReCaptchaEnabled)
                                    <div class="form-group mt10">
                                        <div class="g-recaptcha d-flex justify-content-center"
                                             data-sitekey="{{ config('app.google_recaptcha_site_key') }}"></div>
                                        <div id="g-recaptcha-error"></div>
                                    </div>
                                @endif
                                <div class="form-group text-center nomargin">
                                    <button type="submit" class="btn btn-purple btn-effect" id="btnEmployerSave"
                                            data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">
                                        {{ __('web.register_menu.create_account') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                    <!-- End of Tabpanel for Employer Account -->
                </div>
                <!-- End of Tab Content -->

            </div>
        </div>
        </div>
    </section>
    <!-- ===== End of Login - Register Section ===== -->
@endsection

@if($isGoogleReCaptchaEnabled)
@section('page_scripts')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection
@endif

@section('scripts')
    <script>
        let registerSaveUrl = "{{ route('front.save.register') }}";
        let employerLogInUrl = "{{ route('front.employee.login') }}";
        let isGoogleReCaptchaEnabled = "{{ (boolean)$isGoogleReCaptchaEnabled }}";
    </script>
    <script src="{{mix('assets/js/front_register/front_register.js')}}"></script>
    @if($isGoogleReCaptchaEnabled)
        <script src="{{mix('assets/js/front_register/google-recaptcha.js')}}"></script>
    @endif
@endsection
