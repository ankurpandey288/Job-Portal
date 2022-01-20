@extends('layouts.app')
@section('title')
    {{ __('messages.reported_jobs') }}
@endsection
@push('css')
    @livewireStyles
@endpush
@section('content')
    <section class="section">
        <div class="section-header flex-wrap">
            <h1 class="mr-4 w-700">{{ __('messages.reported_jobs') }}</h1>
            @if(count($reportedJob) > 0)
                <div class="section-header-breadcrumb flex-center">
                    <div class="row justify-content-end">
                        <div class="mt-3 mt-md-0">
                            <div class="card-header-action w-100">
                                {!! Form::selectMonth('month', null, ['id' => 'filter_reported_date', 'class'=>'form-control w-100','placeholder' => 'Select Month']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @livewire('reported-jobs')
                </div>
            </div>
        </div>
        @include('employer.jobs.show_reported_job_modal')
    </section>
@endsection
@push('scripts')
    @livewireScripts
    <script>
        let reportedJobsUrl = "{{ route('reported.jobs') }}/";
        let frontJobDetail = "{{ route('front.job.details') }}";
        let frontCandidateDetail = "{{ url('candidate-details') }}";
    </script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{mix('assets/js/jobs/reported_jobs.js')}}"></script>
@endpush

