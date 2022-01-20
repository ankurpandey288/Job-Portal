@extends('layouts.app')
@section('title')
    {{ __('messages.email_templates') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.email_templates') }}</h1>
        </div>
        <div class="section-body">
            @include('flash::message')
            <div class="card">
                <div class="card-body">
                    @include('email_templates.table')
                </div>
            </div>
        </div>
        @include('email_templates.templates.templates')
    </section>
@endsection
@push('scripts')
    <script>
        let emailTemplateUrl = "{{ route('email.template.index') }}";
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/email_templates/email_templates.js') }}"></script>
@endpush
