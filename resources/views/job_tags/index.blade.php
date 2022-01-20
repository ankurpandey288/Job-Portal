@extends('layouts.app')
@section('title')
    {{ __('messages.job_tags') }}
@endsection
@push('css')
    @livewireStyles
    <link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header flex-wrap">
            <h1 class="mb-2">{{ __('messages.job_tags') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="#" class="btn btn-primary form-btn addJobTagModal back-btn-right">{{__('messages.job_tag.add') }}
                    <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @livewire('job-tags')
                </div>
            </div>
        </div>
        @include('job_tags.add_modal')
        @include('job_tags.edit_modal')
        @include('job_tags.show_modal')
    </section>
@endsection
@push('scripts')
    @livewireScripts
    <script>
        let jobTagUrl = "{{ route('jobTag.index') }}/";
        let jobTagSaveUrl = "{{ route('jobTag.store') }}";
    </script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{mix('assets/js/job_tags/job_tags.js')}}"></script>
@endpush
