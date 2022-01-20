@extends('privacy_policy.index')
@section('title')
    {{ __('messages.setting.privacy_policy') }}
@endsection
@section('section')
    {{ Form::open(['route' => 'privacy.policy.update', 'id' => 'privacyPolicy']) }}
    <div class="row mt-3">
        <div class="form-group col-sm-12 my-0">
            {{ Form::label('privacy_policy', __('messages.setting.privacy_policy').':') }}<span
                    class="text-danger">*</span>
            {{ Form::textarea('privacy_policy', $privacyPolicy['privacy_policy'], ['class' => 'form-control h-75', 'id' => 'description']) }}
        </div>
    </div>
    <div class="row mt-4">
        <div class="form-group col-sm-12">
            {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary']) }}
        </div>
    </div>
    {{ Form::close() }}
@endsection
