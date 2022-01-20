@extends('layouts.app')
@section('title')
    {{ __('messages.inquiry.inquiry_details') }}
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.inquiry.inquiry_details') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('inquires.index') }}"
                   class="btn btn-primary form-btn float-right">{{ __('messages.common.back') }}</a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('inquires.show_fields')
                </div>
            </div>
        </div>
    </section>
@endsection
