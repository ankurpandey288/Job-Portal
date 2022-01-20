@extends('layouts.app')
@section('title')
    {{ __('messages.post.edit_post') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.post.edit_post') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('posts.index') }}"
                   class="btn btn-primary form-btn float-right">{{ __('messages.common.back') }}</a>
            </div>
        </div>
        <div class="section-body">
            @include('layouts.errors')
            <div class="card mt-2">
                <div class="card-body">
                    {{ Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'put', 'id' => 'editBlogForm', 'files' => 'true']) }}

                    @include('blogs.fields')

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{mix('assets/js/blogs/create-edit.js')}}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
@endpush
