@extends('layouts.app')
@section('title')
    {{ __('messages.company.reported_companies') }}
@endsection
@push('css')
    @livewireStyles
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header flex-wrap">
            <h1 class="mr-4 w-700">{{ __('messages.company.reported_employers') }}</h1>
            @if(count($reportedEmployee) > 0)
                <div class="section-header-breadcrumb flex-center">
                    <div class="row justify-content-end">
                        <div class="mt-3 mt-md-0">
                            <div class="card-header-action w-100">
                                {!! Form::selectMonth('month', null, ['id' => 'filter_reported_date', 'class'=>'form-control w-100','placeholder' => 'Select Month']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @livewire('reported-employee')
                </div>
            </div>
        </div>
        @include('employer.companies.show_reported_company_modal')
    </section>
@endsection
@push('scripts')
    @livewireScripts
    <script>
        let reportedCompaniesUrl = "{{ route('reported.companies') }}";
    </script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{mix('assets/js/companies/front/reported_companies.js')}}"></script>
@endpush

