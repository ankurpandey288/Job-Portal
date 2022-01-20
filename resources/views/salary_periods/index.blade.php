@extends('layouts.app')
@section('title')
    {{ __('messages.salary_periods') }}
@endsection
@push('css')
    @livewireStyles
    <link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.salary_periods') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="#" class="btn btn-primary form-btn addSalaryPeriodModal back-btn-right">{{ __('messages.salary_period.add') }}
                    <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @livewire('salary-periods')
                </div>
            </div>
        </div>
        @include('salary_periods.add_modal')
        @include('salary_periods.edit_modal')
        @include('salary_periods.show_modal')
    </section>
@endsection
@push('scripts')
    @livewireScripts
    <script>
        let salaryPeriodUrl = "{{ route('salaryPeriod.index') }}/";
        let salaryPeriodSaveUrl = "{{ route('salaryPeriod.store') }}";
    </script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{mix('assets/js/salary_periods/salary_periods.js')}}"></script>
@endpush
