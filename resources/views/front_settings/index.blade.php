@extends('layouts.app')
@section('title')
    {{ __('messages.setting.front_settings') }}
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.setting.front_settings') }}</h1>
        </div>
        <div class="section-body">
            @include('flash::message')
            <div class="alert alert-danger d-none" id="validationErrorsBox"></div>
            <div class="card">
                <div class="card-body">

                    {{ Form::open(['route' => 'front.settings.update','files' => true,]) }}

                    @include('front_settings.fields')

                    {{ Form::close() }}

                </div>
            </div>
        </div>

    </section>
@endsection
@push('scripts')
    <script src="{{mix('assets/js/web/front_settings/front_settings.js')}}"></script>
@endpush
