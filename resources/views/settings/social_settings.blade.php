@extends('settings.index')
@section('title')
    {{ __('messages.setting.social_settings') }}
@endsection
@section('section')
    {{ Form::open(['route' => 'settings.update','id'=>'editForm']) }}
    {{ Form::hidden('sectionName', $sectionName) }}
    <div class="row mt-3">
        <div class="form-group col-sm-6">
            {{ Form::label('facebook_url', __('messages.setting.facebook_url').':') }}
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fab fa-facebook-f facebook-fa-icon"></i>
                    </div>
                </div>
                {{ Form::text('facebook_url', $setting['facebook_url'], ['class' => 'form-control','id'=>'facebookUrl']) }}
            </div>
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('twitter_url', __('messages.setting.twitter_url').':') }}
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fab fa-twitter twitter-fa-icon"></i>
                    </div>
                </div>
                {{ Form::text('twitter_url', $setting['twitter_url'], ['class' => 'form-control','id'=>'twitterUrl']) }}
            </div>
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('google_plus_url', __('messages.setting.google_plus_url').':') }}
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fab fa-google-plus-g google-plus-fa-icon"></i>
                    </div>
                </div>
                {{ Form::text('google_plus_url', $setting['google_plus_url'], ['class' => 'form-control','id'=>'googlePlusUrl']) }}
            </div>
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('linkedIn_url', __('messages.setting.linkedIn_url').':') }}
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fab fa-linkedin-in linkedin-fa-icon"></i>
                    </div>
                </div>
                {{ Form::text('linkedIn_url', $setting['linkedIn_url'], ['class' => 'form-control','id'=>'linkedInUrl']) }}
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <!-- Submit Field -->
        <div class="form-group col-sm-12">
            {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary','id'=>'submitId']) }}
            <a href="" class="btn btn-secondary hover-text-dark text-dark">{{__('messages.common.cancel')}}</a>
        </div>
    </div>
    {{ Form::close() }}
@endsection
