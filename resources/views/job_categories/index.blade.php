@extends('layouts.app')
@section('title')
    {{ __('messages.job_categories') }}
@endsection
@push('css')
    @livewireStyles
    <link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header flex-wrap">
            <h1 class="mb-2">{{ __('messages.job_categories') }}</h1>
            <div class="section-header-breadcrumb">
                @if(count($jobCategories) > 0)
                    <div class="card-header-action grid-flex-end">
                        {{  Form::select('is_featured', $featured, null, ['id' => 'filterFeatured', 'class' => 'form-control status-filter w-100', 'placeholder' => 'Select Featured Job']) }}
                    </div>
                @endif
                <a href="#"
                   class="btn btn-primary form-btn addJobCategoryModal ml-2 back-btn-right">{{ __('messages.job_category.add') }}
                    <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @livewire('job-categories')
                </div>
            </div>
        </div>
        @include('job_categories.add_modal')
        @include('job_categories.edit_modal')
        @include('job_categories.show_modal')
    </section>
@endsection
@push('scripts')
    @livewireScripts
    <script>
        let jobCategoryUrl = "{{ route('job-categories.index') }}/";
        let jobCategorySaveUrl = "{{ route('job-categories.store') }}";
    </script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{mix('assets/js/job_categories/job_categories.js')}}"></script>
@endpush
