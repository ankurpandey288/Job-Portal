@extends('layouts.app')
@section('title')
    {{ __('messages.job_notification.job_notifications') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header flex-wrap">
            <h1 class="mb-2 mr-4 w-700">{{ __('messages.job_notification.job_notifications') }}</h1>
            <div class="section-header-breadcrumb flex-center">
                <div class="row justify-content-end">
                    <div class="col-12">
                        <div class="card-header-action">
                            {{  Form::select('employers', $companies, null, ['id' => 'filter_employers', 'class' => 'form-control status-filter','placeholder' => 'Select Employer']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-body">
            @include('flash::message')
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['route' => 'job-notification.store','id' => 'createJobNotificationForm']) }}
                    @include('job_notification.send_notification')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        @include('job_notification.templates.templates')
    </section>
@endsection
@push('scripts')
    <script>
        let getEmployerJobs = "{{ url('admin/employer-jobs') }}";
        let jobDetails = "{{ url('admin/jobs') }}";
        let jobNotification = "{{ url('admin/job-notifications') }}";
    </script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{mix('assets/js/jobs/job_notification.js')}}"></script>
@endpush

