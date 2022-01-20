@extends('employer.layouts.app')
@section('title')
    {{ __('messages.job_stage.job_stage') }}
@endsection
@push('css')
    @livewireStyles
    <link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.job_stage.job_stage') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="px-3 back-btn-right">
                    <a href="javascript:void(0)"
                       class="btn btn-primary form-btn addJobStageModal">{{ __('messages.common.add') }}
                        <i class="fas fa-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body followers-body">
                    @livewire('job-stage')
                </div>
            </div>
        </div>
        @include('employer.job_stages.add_modal')   
        @include('employer.job_stages.edit_modal')
        @include('employer.job_stages.show_modal')
    </section>
@endsection
@push('scripts')
    @livewireScripts
    <script>
        let jobStageUrl = "{{ route('job.stage.index') }}/";
        let jobStageSaveUrl = "{{ route('job.stage.store') }}";
    </script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{mix('assets/js/job_stages/job_stages.js')}}"></script>
@endpush
