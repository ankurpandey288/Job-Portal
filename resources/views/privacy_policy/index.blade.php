@extends('layouts.app')
@section('title')
    {{ __('messages.setting.privacy_policy') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.setting.privacy_policy') }}</h1>
        </div>
        <div class="section-body">
            @include('flash::message')
            <div class="card">
                <div class="alert alert-danger d-none" id="validationErrorsBox"></div>
                <div class="card-body py-0">
                    @include("privacy_policy.section_menu")
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ mix('assets/js/privacy_policy/privacy_policy.js') }}"></script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
@endpush
