@extends('layouts.app')
@section('title')
    {{ __('messages.post_category.post_categories') }}
@endsection
@push('css')
    @livewireStyles
    <link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.post_category.post_categories') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="#" class="btn btn-primary form-btn addBlogCategoryModal back-btn-right">{{ __('messages.common.add') }}
                    <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @livewire('blog-categories')
                </div>
            </div>
        </div>
        @include('blog_categories.templates.templates')
        @include('blog_categories.add_modal')
        @include('blog_categories.edit_modal')
        @include('blog_categories.show_modal')
    </section>
@endsection
@push('scripts')
    @livewireScripts
    <script>
        let blogCategoryUrl = "{{ route('post-categories.index') }}/";
        let blogCategorySaveUrl = "{{ route('post-categories.store') }}";
    </script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{mix('assets/js/blog_categories/blog_categories.js')}}"></script>
@endpush
