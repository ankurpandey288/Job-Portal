@extends('layouts.app')
@section('title')
    {{ __('messages.employers') }}
@endsection
@push('css')
    @livewireStyles
    <link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.company.employers') }}</h1>
            <div class="section-header-breadcrumb flex-basis-unset">
                <div class="row justify-content-end custom-row-pl-3 align-items-center">
                    @if(count($data) > 0)
                        <div class="pl-3 pr-md-3 pr-0 py-1 grid-width-100">
                            <div class="card-header-action">
                                {{  Form::select('is_featured', $featured, null, ['id' => 'filter_featured', 'class' => 'form-control status-filter w-100', 'placeholder' => 'Select Featured Company']) }}
                            </div>
                        </div>
                        <div class="pl-3 pr-md-3 pr-0 py-1 grid-width-100">
                            <div class="card-header-action w-100">
                                {{  Form::select('is_stauts', $statusArr, null, ['id' => 'filter_status', 'class' => 'form-control status-filter w-100', 'placeholder' => 'Select Status']) }}
                            </div>
                        </div>
                    @endif
                    <div class="pl-3 py-1 grid-width-100 grid-add-end">
                        <a href="{{ route('company.create') }}"
                           class="btn btn-primary form-btn">{{ __('messages.common.add') }}
                            <i class="fas fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-body">
            @include('flash::message')
            <div class="card">
                <div class="card-body overflow-hidden">
                    @livewire('employers-search')
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    @livewireScripts
    <script>
        let companiesUrl = "{{ route('company.index') }}";
    </script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{mix('assets/js/companies/companies.js')}}"></script>
@endpush

