@extends('layouts.app')
@section('title')
    {{ __('messages.companies') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.company.reported_employers') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('company.create') }}" class="btn btn-primary form-btn">{{ __('messages.common.add') }}
                    <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            @include('flash::message')
            <div class="card">
                <div class="card-body">
                    @include('companies.table')
                </div>
            </div>
        </div>
        @include('companies.templates.templates')
    </section>
@endsection
@push('scripts')
    <script>
        let companiesUrl = "{{ route('company.index') }}";
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/companies/companies.js')}}"></script>
@endpush

