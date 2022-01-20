@extends('candidate.layouts.app')
@section('title')
    {{ __('messages.profile') }}
@endsection
@stack('page-css')
@push('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section profile">
        <div class="section-header">
            <h1>{{ __('messages.profile') }}</h1>
            <a class="font-weight-bold public-profile"
               href="{{ route('front.candidate.details',$user->candidate->unique_id) }}"
               target="_blank">{{ __('messages.common.view_profile') }}</a>
        </div>
        @include('flash::message')

        <div class="section-body">
            <div class="card">
                @include('layouts.errors')
                <div class="card-body py-0 mt-2">
                    @include('candidate.profile.profile_menu')
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        let companyStateUrl = "{{ route('states-list') }}";
        let companyCityUrl = "{{ route('cities-list') }}";
        let defaultImageUrl = "{{ asset('assets/img/infyom-logo.png') }}";
    </script>
    @stack('page-scripts')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
@endpush
