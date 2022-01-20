@extends('settings.index')
@section('title')
    {{ __('messages.setting.general') }}
@endsection
@section('section')
    {{ Form::open(['route' => 'settings.update', 'files' => true, 'id'=>'editGeneralForm']) }}
    {{ Form::hidden('sectionName', $sectionName) }}
    <div class="row mt-3">
        <div class="form-group col-sm-6">
            {{ Form::label('application_name', __('messages.setting.application_name').':') }}<span
                    class="text-danger">*</span>
            {{ Form::text('application_name', $setting['application_name'], ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('application_name', __('messages.setting.company_url').':') }}<span
                    class="text-danger">*</span>
            {{ Form::text('company_url', $setting['company_url'], ['class' => 'form-control', 'required', 'id' => 'companyUrl']) }}
        </div>
        <div class="form-group col-sm-12 my-0">
            {{ Form::label('company_description', __('messages.setting.company_description').':') }}<span
                    class="text-danger">*</span>
            {{ Form::textarea('company_description', $setting['company_description'], ['class' => 'form-control h-75', 'required']) }}
        </div>
    </div>
    <div class="row">
        <!-- Logo Field -->
        <div class="form-group col-sm-4">
            <div class="row">
                <div class="px-3">
                    {{ Form::label('app_logo', __('messages.setting.logo').':') }}<span class="text-danger">*</span>
                    <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip"
                       data-placement="top" title="Upload 90 x 60 logo to get best user experience."></i>
                    <label class="image__file-upload"> {{ __('messages.setting.choose') }}
                        {{ Form::file('logo',['id'=>'logo','class' => 'd-none']) }}
                    </label>
                </div>
                <div class="w-auto pl-3 mt-1">
                    <img id='logoPreview' class="img-thumbnail thumbnail-preview"
                         src="{{($setting['logo']) ? asset($setting['logo']) : asset('assets/img/infyom-logo.png')}}">
                </div>
            </div>
        </div>
        <div class="form-group col-sm-4">
            <div class="row">
                <div class="px-3">
                    {{ Form::label('app_footer_logo','Footer Logo:') }}<span class="text-danger">*</span>
                    <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip"
                       data-placement="top" title="Upload 90 x 60 logo to get best user experience."></i>
                    <label class="image__file-upload"> {{ __('messages.setting.choose') }}
                        {{ Form::file('footer_logo',['id'=>'footerLogo','class' => 'd-none']) }}
                    </label>
                </div>
                <div class="w-auto pl-3 mt-1">
                    <img id='footerLogoPreview' class="img-thumbnail thumbnail-preview"
                         src="{{($setting['footer_logo']) ? asset($setting['footer_logo']) : asset('assets/img/infyom-logo.png')}}">
                </div>
            </div>
        </div>
        <div class="form-group col-sm-4">
            <div class="row">
                <div class="px-3">
                    {{ Form::label('favicon', __('messages.setting.favicon').':') }}
                    <span class="text-danger">*</span><i class="fas fa-question-circle ml-1 mt-1 general-question-mark"
                                                         data-toggle="tooltip" data-placement="top"
                                                         title="The image must be of pixel 16 x 16 and 32 x 32."></i>
                    <label class="image__file-upload"> {{ __('messages.setting.choose') }}
                        {{ Form::file('favicon',['id'=>'favicon','class' => 'd-none']) }}
                    </label>
                </div>
                <div class="w-auto pl-3 mt-1">
                    <img id='faviconPreview' class="img-thumbnail thumbnail-preview mt-4 width-40px"
                         src="{{($setting['favicon']) ? asset($setting['favicon']) : asset('assets/img/infyom-logo.png')}}">
                </div>
            </div>
        </div>
        <div class="form-group col-lg-12 col-md-6 d-flex justify-content-start">
            <label class="custom-switch switch-label mt-2 row pl-0">
                <input type="checkbox" name="enable_google_recaptcha" class="custom-switch-input"
                       {{ ($setting['enable_google_recaptcha']) ? 'checked' : '' }} value="1">
                <span class="custom-switch-indicator switch-span"></span>
            </label>
            <span class="custom-switch-description font-weight-bold mt-2">{{ __('messages.setting.enable_google_recaptcha') }}</span>
        </div>
    </div>
    <div class="row mt-4">
        <!-- Submit Field -->
        <div class="form-group col-sm-12">
            {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary']) }}
            <a href="" class="btn btn-secondary hover-text-dark text-dark">{{__('messages.common.cancel')}}</a>
        </div>
    </div>
    {{ Form::close() }}
@endsection
