@extends('layouts.app')
@section('title')
    {{ __('messages.branding_sliders') }}
@endsection
@push('css')
    @livewireStyles
@endpush
@section('content')
    <section class="section">
        <div class="section-header flex-wrap">
            <h1 class="mb-2">{{ __('messages.branding_sliders') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="card-header-action grid-flex-end">
                    {{  Form::select('is_active', $statusArr, null, ['id' => 'branding_filter_status', 'class' => 'form-control status-filter w-100', 'placeholder' => __('messages.image_slider.select_status')]) }}
                </div>
                <a href="#"
                   class="btn btn-primary form-btn addBrandingSliderModal ml-2 back-btn-right">{{ __('messages.image_slider.add') }}
                    <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @livewire('branding-sliders')
                </div>
            </div>
        </div>
        @include('branding_sliders.templates.templates')
        @include('branding_sliders.add_modal')
        @include('branding_sliders.edit_modal')
    </section>
@endsection
@push('scripts')
    @livewireScripts
    <script>
        let brandingSliderUrl = "{{ route('branding.sliders.index') }}";
        let brandingSliderSaveUrl = "{{ route('branding.sliders.store') }}";
        let defaultDocumentImageUrl = "{{ asset('assets/img/infyom-logo.png') }}";
        let view = "{{ __('messages.common.view') }}";
        let brandingExtensionMessage = "{{ __('messages.image_slider.image_extension_message') }}";
    </script>
    <script src="{{mix('assets/js/branding_sliders/branding_sliders.js')}}"></script>
@endpush
