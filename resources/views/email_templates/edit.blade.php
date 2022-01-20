@extends('layouts.app')
@section('title')
    {{ __('messages.email_template.edit_email_template') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.email_template.edit_email_template') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('email.template.index') }}"
                   class="btn btn-primary form-btn float-right">{{ __('messages.common.back') }}</a>
            </div>
        </div>
        @include('layouts.errors')
        {{ Form::model($emailTemplate, ['route' => ['email.template.update', $emailTemplate->id], 'method' => 'put', 'id' => 'editEmailTemplateForm', 'files' => 'true']) }}
        <div class="section-body">
            <div class="card mt-2">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            {{ Form::label('template_name',__('messages.email_template.template_name').':') }}
                            {{ Form::text('template_name', null, ['class' => 'form-control', 'readonly']) }}
                        </div>
                        <div class="form-group col-sm-12">
                            {{ Form::label('subject',__('messages.email_template.subject').':') }}<span
                                    class="text-danger">*</span>
                            {{ Form::text('subject', null, ['class' => 'form-control','required']) }}
                        </div>
                        <div class="form-group col-sm-12">
                            {{ Form::label('body',__('messages.email_template.body').':') }}<span
                                    class="text-danger">*</span>
                            {{ Form::textarea('body', null, ['class' => 'form-control', 'id' => 'body', 'rows' => '5']) }}
                        </div>
                        <div class="form-group col-sm-12">
                            {{ Form::label('variables',__('messages.email_template.short_code').':') }}
                            {{ Form::text('variables', null, ['class' => 'form-control', 'readonly']) }}
                        </div>
                    </div>
                    <div class="text-left">
                        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary']) }}
                        <a href="{{ route('email.template.index') }}"
                           class="btn btn-secondary text-dark">{{__('messages.common.cancel')}}</a>
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{mix('assets/js/email_templates/create-edit.js')}}"></script>
@endpush
