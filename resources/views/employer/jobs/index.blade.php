@extends('employer.layouts.app')
@section('title')
    {{ __('messages.jobs') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header flex-wrap">
            <h1 class="mr-3">{{ __('messages.jobs') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="pl-3 pr-md-3 pr-0 py-1 grid-width-100">
                    {{ Form::select('is_featured', $featured, null, ['id' => 'filter_featured', 'class' => 'form-control status-filter w-100', 'placeholder' => 'Select Featured Job']) }}
                </div>
                <div class="pl-3 pr-md-3 pr-0 py-1 grid-width-100">
                    {{ Form::select('status', $statusArray, null, ['id' => 'filter_status', 'class' => 'form-control status-filter w-100', 'placeholder' => 'Select Status']) }}
                </div>
                <div class="pl-3 py-1 grid-width-100 grid-add-end">
                <a href="{{ route('job.create') }}"
                   class="btn btn-primary form-btn">{{ __('messages.common.add') }}
                    <i class="fas fa-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="section-body">
            @include('flash::message')
            @include('layouts.errors')
            <div class="card overflow-hidden">
                <div class="card-body">
                    @include('employer.jobs.table')
                </div>
            </div>
        </div>
        @include('employer.jobs.templates.templates')
    </section>
@endsection
@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        let jobsUrl = "{{ route('job.index') }}";
        let frontJobDetail = "{{ route('front.job.details') }}";
        let jobStatusUrl = "{{  url('employer/job') }}/";
        let statusArray = JSON.parse('@json($statusArray)');
        let isFeaturedEnable = "{{ ($isFeaturedEnable == 1) ? true : false }}";
        let isFeaturedAvilabal = "{{ $isFeaturedAvilabal }}";
        let stripe = Stripe('{{ config('services.stripe.key') }}');
        let jobStripePaymentUrl = '{{ url('job-stripe-charge') }}';
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/jobs/jobs.js')}}"></script>
    <script src="{{mix('assets/js/jobs/jobs_stripe_payment.js')}}"></script>
@endpush

