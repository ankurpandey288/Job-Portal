@extends('layouts.app')
@section('title')
    {{ __('messages.settings') }}
@endsection
<link rel="stylesheet" href="{{ asset('assets/css/inttel/css/intlTelInput.css') }}">
<link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.settings') }}</h1>
        </div>
        <div class="section-body">
            @include('flash::message')
            @include('layouts.errors')
            <div class="alert alert-danger d-none" id="validationErrorsBox"></div>
            <div class="card">
                <div class="card-body py-0">
                    @include("settings.setting_menu")
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        let enableEditText = "{{ __('messages.setting.enable_edit') }}";
        let disableEditText = "{{ __('messages.setting.disable_edit') }}";
        let enableCookie = "{{ __('messages.setting.enable_cookie') }}";
        let disableCookie = "{{ __('messages.setting.disable_cookie') }}";
    </script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{ mix('assets/js/settings/settings.js') }}"></script>
@endpush
