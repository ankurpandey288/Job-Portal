@extends('layouts.app')
@section('title')
    {{ __('messages.country.countries') }}
@endsection
@push('css')
    @livewireStyles
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.country.countries') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="#" class="btn btn-primary form-btn addCountryModal back-btn-right">{{ __('messages.common.add') }}
                    <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @livewire('countries')
                </div>
            </div>
        </div>
        @include('countries.add_modal')
        @include('countries.edit_modal')
    </section>
@endsection
@push('scripts')
    @livewireScripts
    <script>
        let countryUrl = "{{ route('countries.index') }}";
        let countrySaveUrl = "{{ route('countries.store') }}";
    </script>
    <script src="{{mix('assets/js/countries/countries.js')}}"></script>
@endpush
