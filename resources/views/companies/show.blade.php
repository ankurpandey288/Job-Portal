@extends('layouts.app')
@section('title')
    {{ __('messages.company.employer_details') }}
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.company.employer_details') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('company.edit',$company->id) }}"
                   class="btn btn-warning form-btn float-right mr-2">{{ __('messages.common.edit') }}</a>
                <a href="{{ route('company.index') }}"
                   class="btn btn-primary form-btn">{{ __('messages.common.back') }}</a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('companies.show_fields')
                </div>
            </div>
        </div>
    </section>
@endsection
