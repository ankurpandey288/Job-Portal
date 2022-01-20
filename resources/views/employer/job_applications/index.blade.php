@extends('employer.layouts.app')
@section('title')
    {{ __('messages.job_applications') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section ">
        <div class="section-header">
            <h1>
                <a href="{{  route('front.job.details',$job->job_id) }}"
                   class="font-weight-bold">{{$job->job_title}}</a> {{ __('messages.job_applications') }}
            </h1>
            <div class="section-header-breadcrumb">
                <div class="pl-3 pr-md-3 pr-0 py-1 grid-width-100">
                    <div class="card-header-action w-100">
                        {{ Form::select('status',$statusArray,null, ['class'=>'form-control','id'=>'filterStatus','placeholder'=>'Select Status']) }}
                    </div>
                </div>
                <a href="{{  route('job.edit',$job->id) }}"
                   class="btn btn-warning form-btn mr-2">{{ __('messages.job.edit_job') }}
                </a>
                <a href="{{ route('job.index') }}" class="btn btn-primary form-btn">{{ __('messages.common.back') }}
                </a>
            </div>
        </div>
        <div class="section-body">
            @include('flash::message')
            <div class="card">
                <div class="card-body">
                    @include('employer.job_applications.table')
                </div>
            </div>
        </div>
        @include('employer.job_applications.job_stages_modal')
        @include('employer.job_applications.templates.templates')
    </section>
@endsection
@push('scripts')
    <script>
        let jobApplicationsUrl = "{{  route('job-applications', ['jobId' => $jobId]) }}";
        let jobApplicationStatusUrl = "{{  url('employer/job-applications') }}/";
        let jobApplicationDeleteUrl = "{{  url('employer/job-applications') }}";
        let jobDetailsUrl = "{{  route('front.job.details') }}";
        let candidateDetailsUrl = "{{  url('candidate-details') }}";
        let statusArray = JSON.parse('@json($statusArray)');
        let downloadDocumentUrl = "{{ url('employer/resume-download') }}";
        let changeJobStage = "{{ route('change.job.stage', ['jobId' => $jobId]) }}";
        let viewSlotScreen = "{{ url('employer/job-applications/'.request()->route('jobId')) }}";
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ asset('assets/js/custom/currency.js') }}"></script>
    <script src="{{mix('assets/js/job_applications/job_applications.js')}}"></script>
@endpush

