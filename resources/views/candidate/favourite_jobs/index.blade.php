@extends('candidate.layouts.app')
@section('title')
    {{ __('messages.favourite_jobs') }}
@endsection
@push('css')
    @livewireStyles
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.favourite_jobs') }}</h1>
        </div>
        <div class="section-body">
            @include('flash::message')
            <div class="card">
                <div class="card-body favourite-jobs">
                    @livewire('favorite-jobs')
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    @livewireScripts
    <script src="{{mix('assets/js/candidate/favourite_jobs.js')}}"></script>
@endpush
