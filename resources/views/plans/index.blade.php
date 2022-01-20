@extends('layouts.app')
@section('title')
    {{ __('messages.subscriptions_plans') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.subscriptions_plans') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="#" class="btn btn-primary form-btn addPlanModal back-btn-right">{{ __('messages.skill.add') }}
                    <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('plans.table')
                </div>
            </div>
        </div>
        @include('plans.templates.templates')
        @include('plans.add_modal')
        @include('plans.edit_modal')
    </section>
@endsection
@push('scripts')
    <script>
        let planUrl = "{{ route('plans.index') }}";
        let planSaveUrl = "{{ route('plans.store') }}";
        let planCurrencies = JSON.parse('@json($currency)');
        let planCurrencySymbols = JSON.parse('@json($currencyIcon)');
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ asset('js/currency.js') }}"></script>
    <script src="{{mix('assets/js/plans/plans.js')}}"></script>
    <script src="{{ asset('assets/js/autonumeric/autoNumeric.min.js') }}"></script>
@endpush
