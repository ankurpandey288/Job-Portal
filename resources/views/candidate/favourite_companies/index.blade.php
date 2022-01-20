@extends('candidate.layouts.app')
@section('title')
    {{ __('messages.favourite_companies') }}
@endsection
@push('css')
    @livewireStyles
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.favourite_companies') }}</h1>
        </div>
        <div class="section-body">
            @include('flash::message')
            <div class="card">
                <div class="card-body favourite-companies-body">
                    @livewire('favourite-companies')
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    @livewireScripts
    <script src="{{mix('assets/js/candidate/favourite_company.js')}}"></script>
@endpush
