@extends('layouts.app')
@section('title')
    {{ __('messages.languages') }}
@endsection
@push('css')
    @livewireStyles
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.languages') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="#" class="btn btn-primary form-btn addLanguageModal back-btn-right">{{ __('messages.job_category.add') }}
                    <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @livewire('languages')
                </div>
            </div>
        </div>
        @include('languages.templates.templates')
        @include('languages.add_modal')
        @include('languages.edit_modal')
    </section>
@endsection
@push('scripts')
    @livewireScripts
    <script>
        let languageUrl = "{{ route('languages.index') }}/";
        let languageSaveUrl = "{{ route('languages.store') }}";
    </script>
    <script src="{{mix('assets/js/languages/languages.js')}}"></script>
@endpush
