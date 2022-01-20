@extends('layouts.app')
@section('title')
    {{ __('messages.company.new_employer') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/css/inttel/css/intlTelInput.css') }}">
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.company.new_employer') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('company.index') }}"
                   class="btn btn-primary form-btn float-right">{{ __('messages.common.back') }}</a>
            </div>
        </div>
        <div class="section-body">
            @include('layouts.errors')
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['route' => 'company.store', 'files' => 'true', 'id' => 'addCompanyForm']) }}

                    @include('companies.fields')

                    {{ Form::close() }}
                </div>
            </div>
            @include('industries.add_modal')
            @include('ownership_types.add_modal')
            @include('countries.add_modal')
            @include('states.add_modal')
            @include('cities.add_modal')
            @include('company_sizes.add_modal')
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        let companyStateUrl = "{{ route('states-list') }}";
        let companyCityUrl = "{{ route('cities-list') }}";
        let employerPanel = false;
        let utilsScript = "{{asset('assets/js/inttel/js/utils.min.js')}}";
        let isEdit = false;
        let phoneNo = "{{ old('region_code').old('phone') }}";
        let industrySaveUrl = "{{ route('industry.store') }}";
        let ownerShipTypeSaveUrl = "{{ route('ownerShipType.store') }}";
        let countrySaveUrl = "{{ route('countries.store') }}";
        let stateSaveUrl = "{{ route('states.store') }}";
        let citySaveUrl = "{{ route('cities.store') }}";
        let companySizeSaveUrl = "{{ route('companySize.store') }}";
    </script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{mix('assets/js/companies/create-edit.js')}}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/inttel/js/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('assets/js/inttel/js/utils.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/phone-number-country-code.js') }}"></script>
@endpush
