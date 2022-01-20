@extends('settings.index')
@section('title')
    {{ __('messages.env') }}
@endsection
@section('section')
    {{ Form::open(['route' => 'settings.update', 'id' => 'envUpdateForm']) }}
    {{ Form::hidden('sectionName', $sectionName) }}
    <div class="row mt-3">
        <div class="form-group col-md-12 d-flex justify-content-end">
            <label class="custom-switch mt-2">
                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="enableEdit">
                <span class="custom-switch-indicator"></span>
                <span class="custom-switch-description"
                      id="envUpdateText">{{ __('messages.setting.enable_edit') }}</span>
            </label>
        </div>
        <div class="form-group col-sm-12 my-0">
            <div class="card">
                <h5>{{ __('messages.setting.mail') }} :</h5>
                <div class="row">
                    <div class="form-group col-sm-6">
                        {{ Form::label('mail_mailer', __('messages.setting.mail_mailer').':') }}
                        {{ Form::text('mail_mailer', (empty($mail['MAIL_MAILER'])) ? '' : $mail['MAIL_MAILER'], ['class' => 'form-control', 'disabled']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('mail_host', __('messages.setting.mail_host').':') }}
                        {{ Form::text('mail_host', (empty($mail['MAIL_HOST'])) ? '' : $mail['MAIL_HOST'], ['class' => 'form-control', 'disabled']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('mail_port', __('messages.setting.mail_port').':') }}
                        {{ Form::text('mail_port', (empty($mail['MAIL_PORT'])) ? '' : $mail['MAIL_PORT'], ['class' => 'form-control', 'disabled']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('mail_username', __('messages.setting.mail_username').':') }}
                        {{ Form::text('mail_username', (empty($mail['MAIL_USERNAME'])) ? '' : $mail['MAIL_USERNAME'], ['class' => 'form-control', 'disabled']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('mail_password', __('messages.setting.mail_password').':') }}
                        {{ Form::text('mail_password', (empty($mail['MAIL_PASSWORD'])) ? '' : $mail['MAIL_PASSWORD'], ['class' => 'form-control', 'disabled']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('mail_from_address', __('messages.setting.mail__from_address').':') }}
                        {{ Form::text('mail_from_address', (empty($mail['MAIL_FROM_ADDRESS'])) ? '' : $mail['MAIL_FROM_ADDRESS'], ['class' => 'form-control', 'disabled']) }}
                    </div>
                </div>
            </div>
            <div class="card">
                <h5>{{ __('messages.setting.facebook') }} :</h5>
                <div class="row">
                    <div class="form-group col-sm-6">
                        {{ Form::label('facebook_app_id', __('messages.setting.facebook_app_id').':') }}
                        {{ Form::text('facebook_app_id', (empty($facebook['FACEBOOK_APP_ID'])) ? '' : $facebook['FACEBOOK_APP_ID'], ['class' => 'form-control', 'disabled']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('facebook_app_secret', __('messages.setting.facebook_app_secret').':') }}
                        {{ Form::text('facebook_app_secret', (empty($facebook['FACEBOOK_APP_SECRET'])) ? '' : $facebook['FACEBOOK_APP_SECRET'], ['class' => 'form-control', 'disabled']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('facebook_redirect', __('messages.setting.facebook_redirect').':') }}
                        {{ Form::text('facebook_redirect', (empty($facebook['FACEBOOK_REDIRECT'])) ? '' : $facebook['FACEBOOK_REDIRECT'], ['class' => 'form-control', 'disabled']) }}
                    </div>
                </div>
            </div>
            <div class="card">
                <h5>{{ __('messages.setting.pusher') }} :</h5>
                <div class="row">
                    <div class="form-group col-sm-6">
                        {{ Form::label('pusher_app_id', __('messages.setting.pusher_app_id').':') }}
                        {{ Form::text('pusher_app_id', (empty($pusher['PUSHER_APP_ID'])) ? '' : $pusher['PUSHER_APP_ID'], ['class' => 'form-control', 'disabled']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('pusher_app_key', __('messages.setting.pusher_app_key').':') }}
                        {{ Form::text('pusher_app_key', (empty($pusher['PUSHER_APP_KEY'])) ? '' : $pusher['PUSHER_APP_KEY'], ['class' => 'form-control', 'disabled']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('pusher_app_secret', __('messages.setting.pusher_app_secret').':') }}
                        {{ Form::text('pusher_app_secret', (empty($pusher['PUSHER_APP_SECRET'])) ? '' : $pusher['PUSHER_APP_SECRET'], ['class' => 'form-control', 'disabled']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('pusher_app_cluster', __('messages.setting.pusher_app_cluster').':') }}
                        {{ Form::text('pusher_app_cluster', (empty($pusher['PUSHER_APP_CLUSTER'])) ? '' : $pusher['PUSHER_APP_CLUSTER'], ['class' => 'form-control', 'disabled']) }}
                    </div>
                </div>
            </div>
            <div class="card">
                <h5>{{ __('messages.setting.stripe') }} :</h5>
                <div class="row">
                    <div class="form-group col-sm-6">
                        {{ Form::label('stripe_key', __('messages.setting.stripe_key').':') }}
                        {{ Form::text('stripe_key', (empty($stripe['STRIPE_KEY'])) ? '' : $stripe['STRIPE_KEY'], ['class' => 'form-control', 'disabled']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('stripe_secret_key', __('messages.setting.stripe_secret_key').':') }}
                        {{ Form::text('stripe_secret_key', (empty($stripe['STRIPE_SECRET'])) ? '' : $stripe['STRIPE_SECRET'], ['class' => 'form-control', 'disabled']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('stripe_webhook_key', __('messages.setting.stripe_webhook_key').':') }}
                        {{ Form::text('stripe_webhook_key', (empty($stripe['STRIPE_WEBHOOK_SECRET_KEY'])) ? '' : $stripe['STRIPE_WEBHOOK_SECRET_KEY'], ['class' => 'form-control', 'disabled']) }}
                    </div>
                </div>
            </div>
            <div class="card">
                <h5>{{ __('messages.setting.paypal') }} :</h5>
                <div class="row">
                    <div class="form-group col-sm-6">
                        {{ Form::label('paypal_client_id', __('messages.setting.paypal_client_id').':') }}
                        {{ Form::text('paypal_client_id', (empty($paypal['PAYPAL_CLIENT_ID'])) ? '' : $paypal['PAYPAL_CLIENT_ID'], ['class' => 'form-control', 'disabled']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('paypal_secret', __('messages.setting.paypal_secret').':') }}
                        {{ Form::text('paypal_secret', (empty($paypal['PAYPAL_SECRET'])) ? '' : $paypal['PAYPAL_SECRET'], ['class' => 'form-control', 'disabled']) }}
                    </div>
                </div>
            </div>
            <div class="card">
                <h5>{{__('messages.setting.linkedin') }} :</h5>
                <div class="row">
                    <div class="form-group col-sm-6">
                        {{ Form::label('linkedin_client_id', __('messages.setting.linkedin_client_id').':') }}
                        {{ Form::text('linkedin_client_id', (empty($linkedin['LINKEDIN_CLIENT_ID'])) ? '' : $linkedin['LINKEDIN_CLIENT_ID'], ['class' => 'form-control', 'disabled']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('linkedin_client_secret', __('messages.setting.linkedin_client_secret').':') }}

                        {{ Form::text('linkedin_client_secret', (empty($linkedin['LINKEDIN_CLIENT_SECRET'])) ? '' : $linkedin['LINKEDIN_CLIENT_SECRET'], ['class' => 'form-control', 'disabled']) }}
                    </div>
                </div>
            </div>
            <div class="card">
                <h5>{{ __('messages.setting.google') }} :</h5>
                <div class="row">
                    <div class="form-group col-sm-6">
                        {{ Form::label('google_client_id', __('messages.setting.google_client_id').':') }}
                        {{ Form::text('google_client_id', (empty($google['GOOGLE_CLIENT_ID'])) ? '' : $google['GOOGLE_CLIENT_ID'], ['class' => 'form-control', 'disabled']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('google_client_secret', __('messages.setting.google_client_secret').':') }}
                        {{ Form::text('google_client_secret', (empty($google['GOOGLE_CLIENT_SECRET'])) ? '' : $google['GOOGLE_CLIENT_SECRET'], ['class' => 'form-control', 'disabled']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('google_redirect', __('messages.setting.google_redirect').':') }}
                        {{ Form::text('google_redirect', (empty($google['GOOGLE_REDIRECT'])) ? '' : $google['GOOGLE_REDIRECT'], ['class' => 'form-control', 'disabled']) }}
                    </div>
                </div>
            </div>
            <div class="card">
                <h5>{{ __('messages.setting.cookie') }} :</h5>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label class="custom-switch mt-2 pl-0">
                            <input type="checkbox" name="cookie_consent_enabled" class="custom-switch-input"
                                   id="enableCookie"
                                   {{ (!empty($cookie['COOKIE_CONSENT_ENABLED']) && filter_var($cookie['COOKIE_CONSENT_ENABLED'], FILTER_VALIDATE_BOOLEAN)) ? 'checked' : '' }} disabled>
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description" id="enableCookieText">
                                @if(!empty($cookie['COOKIE_CONSENT_ENABLED']) && filter_var($cookie['COOKIE_CONSENT_ENABLED'], FILTER_VALIDATE_BOOLEAN))
                                    {{ __('messages.setting.disable_cookie') }}
                                @else
                                    {{ __('messages.setting.enable_cookie') }}
                                @endif
                            </span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group col-sm-12 pl-0">
                {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary', 'id' => 'btnSaveEnvData', 'disabled']) }}
                <a href="" class="btn btn-secondary hover-text-dark text-dark">{{__('messages.common.cancel')}}</a>
            </div>
        </div>
    {{ Form::close() }}
@endsection
