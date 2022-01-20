@extends('layouts.app')
@section('title')
    {{ __('messages.selected_candidate') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.selected_candidate') }}</h1>
            <div class="section-header-breadcrumb flex-basis-unset">
                <div class="row justify-content-end custom-row-pl-3 align-items-center">
                    <div class="pl-3 pr-md-3 pr-0 py-1 grid-width-100">
                        <div class="card-header-action w-100">
                            {{ Form::select('status',$status,null, ['class'=>'form-control','id'=>'filterCandidateStatus','placeholder'=>'Select                                                           Status']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('selected_candidate.table')
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        let selectedCandidateUrl = "{{ route('selected.candidate') }}";
        let jobDetailUrl = "{{ route('front.job.details') }}";
    </script>

    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/selected_candidate/selected_candidate.js') }}"></script>

@endpush
