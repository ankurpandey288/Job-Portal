@extends('privacy_policy.index')
@section('title')
    {{ __('messages.setting.terms_conditions') }}
@endsection
@section('section')
    {{ Form::open(['route' => 'privacy.policy.update', 'id' => 'termsConditions']) }}
    <div class="row mt-3">
        <div class="form-group col-sm-12 my-0">
            {{ Form::label('terms_conditions', __('messages.setting.terms_conditions').':') }}<span
                    class="text-danger">*</span>
            {{ Form::textarea('terms_conditions', $privacyPolicy['terms_conditions'], ['class' => 'form-control h-75', 'id' => 'description']) }}
        </div>
    </div>
    <div class="row mt-4">
        <div class="form-group col-sm-12">
            {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary']) }}
        </div>
    </div>
    {{ Form::close() }}
@endsection
