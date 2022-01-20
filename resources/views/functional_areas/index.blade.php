@extends('layouts.app')
@section('title')
    {{ __('messages.functional_areas') }}
@endsection
@push('css')
    @livewireStyles
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.functional_areas') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="#" class="btn btn-primary form-btn addFunctionalAreaModal back-btn-right">{{ __('messages.common.add') }}
                    <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @livewire('functional-areas')
                </div>
            </div>
        </div>
        @include('layouts.action_template')
        @include('functional_areas.add_modal')
        @include('functional_areas.edit_modal')
    </section>
@endsection
@push('scripts')
    @livewireScripts
    <script>
        let functionalAreaUrl = "{{ route('functionalArea.index') }}/";
        let functionalAreaSaveUrl = "{{ route('functionalArea.store') }}";
    </script>
    <script src="{{mix('assets/js/functional_areas/functional_areas.js')}}"></script>
@endpush
