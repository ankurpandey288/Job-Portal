@extends('layouts.app')
@section('title')
    {{ __('messages.city.cities') }}
@endsection
@push('css')
    @livewireStyles
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header flex-wrap">
            <h1 class="mb-2">{{ __('messages.city.cities') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="px-3 grid-flex-end">
                    {{ Form::select('states', $states, null, ['id' => 'filter_state', 'class' => 'form-control status-filter w-100', 'placeholder' => 'Select state']) }}
                </div>
                <div class="px-3 back-btn-right">
                    <a href="#" class="btn btn-primary form-btn addCityModal">{{ __('messages.common.add') }}
                        <i class="fas fa-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @livewire('cities')
                </div>
            </div>
        </div>
        @include('cities.add_modal')
        @include('cities.edit_modal')
    </section>
@endsection
@push('scripts')
    @livewireScripts
    <script>
        let cityUrl = "{{ route('cities.index') }}";
        let citySaveUrl = "{{ route('cities.store') }}";
    </script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{mix('assets/js/cities/cities.js')}}"></script>
@endpush
