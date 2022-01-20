@extends('layouts.app')
@section('title')
    {{ __('messages.jobs') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header flex-wrap">
            <h1>{{ __('messages.jobs') }}</h1>
            <div class="section-header-breadcrumb flex-content-center">
                <div class="row justify-content-center">
                    <div class="px-3 mt-md-1 grid-center">
                        <input type="reset" class="btn btn-danger" id="reset-filter" value="{{ __('messages.common.reset') }}">
                    </div>
                    <div class="pl-3 mt-md-1 pad-x-15 grid-center">
                        <a href="javascript:void(0)" class="btn btn-info w-auto"
                           id="jobsFilters">{{__('messages.common.filters')}}</a>
                    </div>
                    <div class="pl-3 mt-1 pr-0 grid-center pad-x-15 d-sm-flex align-items-sm-center">
                        <a href="{{ route('admin.job.create') }}"
                           class="btn btn-primary form-btn">{{ __('messages.common.add') }}
                            <i class="fas fa-plus"></i></a>
                    </div>
                </div>

                <div class="col-md-5 col-lg-4 col-xl-3 col-sm-12 col-12 d-none jobsFilter border border-light"
                     id="jobsFiltersForm">
                    <div class="mb-1">
                        {{  Form::select('is_featured', $featured, null, ['id' => 'filter_featured', 'class' => 'form-control status-filter w-100', 'placeholder' => 'Select Featured Job']) }}
                    </div>
                    <div class="mb-1">
                        {{  Form::select('is_suspended', $suspended, null, ['id' => 'filter_suspended', 'class' => 'form-control status-filter w-100', 'placeholder' => 'Select Suspended Job']) }}
                    </div>
                    <div class="mb-1">
                        {{  Form::select('is_freelancer', $freelancer, null, ['id' => 'filter_freelancer', 'class' => 'form-control status-filter w-100', 'placeholder' => 'Select Freelancer Job']) }}
                    </div>
                    <div class="mb-1">
                        {!! Form::selectMonth('month', null, ['id' => 'filter_expiry_date', 'class'=>'form-control status-filter w-100','placeholder' => 'Select Job Expiry Month']) !!}
                    </div>
                    <div class="mb-0">
                        {{  Form::select('is_job_active', $jobsActiveExpire, null, ['id' => 'filter_job_active_expire', 'class' => 'form-control status-filter w-100', 'placeholder' => 'Select Job Status']) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="section-body">
            @include('flash::message')
            <div class="card">
                <div class="card-body overflow-hidden">
                    @include('jobs.table')
                </div>
            </div>
        </div>
        @include('jobs.templates.templates')
    </section>
@endsection
@push('scripts')
    <script>
        let jobsUrl = "{{ route('admin.jobs.index') }}";
    </script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/jobs/job_datatable_admin.js')}}"></script>
@endpush

