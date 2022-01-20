@extends('layouts.app')
@section('title')
    {{ __('messages.header_sliders') }}
@endsection
@push('css')
    @livewireStyles
    <link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header flex-wrap">
            <h1 class="mb-2">{{ __('messages.header_sliders') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="card-header-action grid-flex-end">
                    {{  Form::select('is_active', $statusArr, null, ['id' => 'headerFilterStatus', 'class' => 'form-control status-filter w-100', 'placeholder' => __('messages.image_slider.select_status')]) }}
                </div>
                <a href="#"
                   class="btn btn-primary form-btn addHeaderSliderModal ml-2 back-btn-right">{{ __('messages.image_slider.add') }}
                    <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form method="post" id="searchIsActive">
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-6 col-sm-12">
                                <label class="custom-switch switch-label row">
                                    <input type="checkbox" name="is_active"
                                           class="custom-switch-input searchIsActive" {{ ($settings['slider_is_active'] == 1) ? 'checked' : '' }} >
                                    <span class="custom-switch-indicator switch-span"></span>
                                </label>
                                <span class="custom-switch-description font-weight-bold position-absolute">{{ __('messages.image_slider.message') }}
                            <i class="fas fa-question-circle ml-1"
                               data-toggle="tooltip" data-placement="top"
                               title="{{ __('messages.image_slider.message_title') }}"></i></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @livewire('header-sliders')
                </div>
            </div>
        </div>
        @include('header_sliders.templates.templates')
        @include('header_sliders.add_modal')
        @include('header_sliders.edit_modal')
    </section>
@endsection
@push('scripts')
    @livewireScripts
    <script>
        let headerSliderUrl = "{{ route('header.sliders.index') }}/";
        let headerSliderSaveUrl = "{{ route('header.sliders.store') }}";
        let defaultDocumentImageUrl = "{{ asset('assets/img/infyom-logo.png') }}";
        let view = "{{ __('messages.common.view') }}";
        let headerSizeMessage = "{{ __('messages.header_slider.image_size_message') }}";
        let headerExtensionMessage = "{{ __('messages.image_slider.image_extension_message') }}";
    </script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{mix('assets/js/header_sliders/header_sliders.js')}}"></script>
@endpush
