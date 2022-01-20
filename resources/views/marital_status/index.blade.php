@extends('layouts.app')
@section('title')
    {{ __('messages.marital_statuses') }}
@endsection
@push('css')
    @livewireStyles
    <link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.marital_statuses') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="#"
                   class="btn btn-primary form-btn addMaritalStatusModal back-btn-right">{{ __('messages.marital_status.add') }}
                    <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @livewire('marital-statuses')
                </div>
            </div>
        </div>
        @include('marital_status.add_modal')
        @include('marital_status.edit_modal')
        @include('marital_status.show_modal')
    </section>
@endsection
@push('scripts')
    @livewireScripts
    <script>
        let maritalStatusUrl = "{{ route('maritalStatus.index') }}/";
        let maritalStatusSaveUrl = "{{ route('maritalStatus.store') }}";
    </script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{mix('assets/js/marital_status/marital_status.js')}}"></script>
@endpush
