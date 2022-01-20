@extends('layouts.app')
@section('title')
    {{ __('messages.company_sizes') }}
@endsection
@push('css')
    @livewireStyles
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.company_sizes') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="#" class="btn btn-primary form-btn addCompanySizeModal back-btn-right">{{ __('messages.company_size.add') }}
                    <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @livewire('company-sizes')
                </div>
            </div>
        </div>
        @include('layouts.action_template')
        @include('company_sizes.add_modal')
        @include('company_sizes.edit_modal')
    </section>
@endsection
@push('scripts')
    @livewireScripts
    <script>
        let companySizeUrl = "{{ route('companySize.index') }}/";
        let companySizeSaveUrl = "{{ route('companySize.store') }}";
    </script>
    <script src="{{mix('assets/js/company_sizes/company_sizes.js')}}"></script>
@endpush
