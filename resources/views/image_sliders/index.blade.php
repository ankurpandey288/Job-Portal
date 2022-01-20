@extends('layouts.app')
@section('title')
    {{ __('messages.image_sliders') }}
@endsection
@push('css')
    @livewireStyles
    <link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header flex-wrap">
            <h1 class="mb-2">{{ __('messages.image_sliders') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="card-header-action grid-flex-end">
                    {{  Form::select('is_active', $statusArr, null, ['id' => 'image_filter_status', 'class' => 'form-control status-filter w-100', 'placeholder' => __('messages.image_slider.select_status')]) }}
                </div>
                <a href="#"
                   class="btn btn-primary form-btn addImageSliderModal ml-2 back-btn-right">{{ __('messages.common.add') }}
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
                                           class="custom-switch-input isFullSlider" {{ ($settings['is_full_slider'] == 1) ? 'checked' : '' }} >
                                    <span class="custom-switch-indicator switch-span"></span>
                                </label>
                                <span class="custom-switch-description font-weight-bold position-absolute">{{ __('messages.image_slider.slider') }}
                            <i class="fas fa-question-circle ml-1"
                               data-toggle="tooltip" data-placement="top"
                               title="{{ __('messages.image_slider.slider_title') }}"></i></span>
                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
                                <label class="custom-switch switch-label row">
                                    <input type="checkbox" name="is_active"
                                           class="custom-switch-input isSliderActive" {{ ($settings['is_slider_active'] == 1) ? 'checked' : '' }} >
                                    <span class="custom-switch-indicator switch-span"></span>
                                </label>
                                <span class="custom-switch-description font-weight-bold position-absolute">{{ __('messages.image_slider.slider_active') }}
                            <i class="fas fa-question-circle ml-1"
                               data-toggle="tooltip" data-placement="top"
                               title="{{ __('messages.image_slider.slider_active_title') }}"></i></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @livewire('image-sliders')
                </div>
            </div>
        </div>
        @include('image_sliders.templates.templates')
        @include('image_sliders.add_modal')
        @include('image_sliders.edit_modal')
        @include('image_sliders.show_modal')
    </section>
@endsection
@push('scripts')
    @livewireScripts
    <script>
        let imageSliderUrl = "{{ route('image-sliders.index') }}/";
        let imageSliderSaveUrl = "{{ route('image-sliders.store') }}";
        let defaultDocumentImageUrl = "{{ asset('assets/img/infyom-logo.png') }}";
        let view = "{{ __('messages.common.view') }}";
        let imageSizeMessage = "{{ __('messages.image_slider.image_size_message') }}";
        let imageExtensionMessage = "{{ __('messages.image_slider.image_extension_message') }}";
    </script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{mix('assets/js/image_slider/image_slider.js')}}"></script>
@endpush
