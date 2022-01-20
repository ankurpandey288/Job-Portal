@extends('candidate.layouts.app')
@section('title')
    {{ __('messages.applied_job.applied_jobs') }}
@endsection
@push('css')
    @livewireStyles
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.applied_job.applied_jobs') }}</h1>
        </div>
        <div class="section-body">
            @include('flash::message')
            <div class="card">
                <div class="card-body">
                    @livewire('applied-jobs')
                </div>
            </div>
        </div>
        @include('candidate.applied_job.show_applied_jobs_modal')
        @include('candidate.applied_job.templates.templates')
        @include('candidate.applied_job.schedule_slot_book')
    </section>
@endsection
@push('scripts')
    @livewireScripts
    <script>
        let candidateAppliedJobUrl = "{{ route('candidate.applied.job') }}";
    </script>
    <script src="{{mix('assets/js/candidate/applied-jobs.js')}}"></script>
@endpush
