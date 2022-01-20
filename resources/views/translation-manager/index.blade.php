@extends('layouts.app')
@section('title')
    {{__('messages.translation_manager')}}
@endsection
@section('content')
    <section class="section">
        <div class="section-header flex-wrap">
            <h1 class="mb-2">{{__('messages.translation_manager')}}</h1>
            <div class="section-header-breadcrumb">
                <a href="javascript:void(0)" class="btn btn-primary addLanguageModal back-btn-right">
                    {{ __('messages.common.add') }} <i class="fas fa-plus "></i>
                </a>
            </div>
        </div>
        <div class="section-body">
            @include('flash::message')
            @include('error')
            <div class="card">
                {{ Form::open(['route' => 'translation-manager.update','method'=>'post']) }}
                @include('translation-manager.fields')
                {{ Form::close() }}
            </div>
        </div>
        @include('translation-manager.create')
    </section>
@endsection
@push('scripts')
    <script>
        let languageCreateURL = "{{route('translation-manager.store')}}";
        let languageName = "{{ $selectedLang }}";
        let fileName = "{{ $selectedFile }}";
    </script>
    <script src="{{mix('assets/js/language_translate/language_translate.js')}}"></script>
@endpush
