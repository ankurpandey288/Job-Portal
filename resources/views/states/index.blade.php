@extends('layouts.app')
@section('title')
    {{ __('messages.state.states') }}
@endsection
@push('css')
    @livewireStyles
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header flex-wrap">
            <h1 class="mb-2">{{ __('messages.state.states') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="px-3 grid-flex-end">
                    {{ Form::select('country', $countries, null, ['id' => 'filter_country', 'class' => 'form-control status-filter w-100', 'placeholder' => 'Select Country']) }}
                </div>
                <div class="px-3 back-btn-right">
                    <a href="#" class="btn btn-primary form-btn addStateModal">{{ __('messages.common.add') }}
                        <i class="fas fa-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @livewire('states')
                </div>
            </div>
        </div>
        @include('states.add_modal')
        @include('states.edit_modal')
    </section>
@endsection
@push('scripts')
    @livewireScripts
    <script>
        let stateUrl = "{{ route('states.index') }}";
        let stateSaveUrl = "{{ route('states.store') }}";
    </script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{mix('assets/js/states/states.js')}}"></script>
@endpush
