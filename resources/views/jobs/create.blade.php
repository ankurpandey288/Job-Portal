@extends('layouts.app')
@section('title')
    {{ __('messages.job.new_job') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/bootstrap-datetimepicker.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.job.new_job') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('admin.jobs.index') }}"
                   class="btn btn-primary form-btn float-right">{{ __('messages.common.back') }}</a>
            </div>
        </div>
        <div class="section-body">
            @include('layouts.errors')
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['route' => 'admin.job.store','id' => 'createJobForm']) }}

                    @include('jobs.fields')

                    {{ Form::close() }}
                </div>
            </div>
            @include('job_types.add_modal')
            @include('job_categories.add_modal')
            @include('skills.add_modal')
            @include('salary_periods.add_modal')
            @include('countries.add_modal')
            @include('states.add_modal')
            @include('cities.add_modal')
            @include('career_levels.add_modal')
            @include('job_shifts.add_modal')
            @include('job_tags.add_modal')
            @include('required_degree_levels.add_modal')
            @include('functional_areas.add_modal')
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        let jobStateUrl = "{{ route('states-list') }}";
        let jobCityUrl = "{{ route('cities-list') }}";
        let employerPanel = false;
        let jobTypeSaveUrl = "{{ route('jobType.store') }}";
        let jobCategorySaveUrl = "{{ route('job-categories.store') }}";
        let skillSaveUrl = "{{ route('skills.store') }}";
        let salaryPeriodSaveUrl = "{{ route('salaryPeriod.store') }}";
        let countrySaveUrl = "{{ route('countries.store') }}";
        let stateSaveUrl = "{{ route('states.store') }}";
        let citySaveUrl = "{{ route('cities.store') }}";
        let careerLevelSaveUrl = "{{ route('careerLevel.store') }}";
        let jobShiftSaveUrl = "{{ route('jobShift.store') }}";
        let jobTagSaveUrl = "{{ route('jobTag.store') }}";
        let requiredDegreeLevelSaveUrl = "{{ route('requiredDegreeLevel.store') }}";
        let functionalAreaSaveUrl = "{{ route('functionalArea.store') }}";
    </script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{mix('assets/js/jobs/create-edit.js')}}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/autonumeric/autoNumeric.min.js') }}"></script>
@endpush
