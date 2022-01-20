<div class="row details-page">
    <div class="form-group col-sm-3">
        {{ Form::label('name', __('messages.inquiry.name').':') }}
        <p>{{ html_entity_decode($inquiry->name) }}</p>
    </div>
    <div class="form-group col-sm-3">
        {{ Form::label('email', __('messages.inquiry.email').':') }}
        <p>{{ $inquiry->email }}</p>
    </div>
    <div class="form-group col-sm-3">
        {{ Form::label('phone_no', __('messages.inquiry.phone_no').':') }}
        <p>{{ (isset($inquiry->phone_no)) ? $inquiry->phone_no : __('messages.common.n/a') }}</p>
    </div>
    <div class="form-group col-sm-3">
        {{ Form::label('subject', __('messages.inquiry.subject').':') }}
        <p>{{ $inquiry->subject }}</p>
    </div>
    <div class="form-group col-sm-3">
        {{ Form::label('created_at', __('messages.common.created_on').':') }}
        <p>{{ $inquiry->created_at->diffForHumans() }}</p>
    </div>
    <div class="form-group col-sm-3">
        {{ Form::label('updated_at', __('messages.common.last_updated').':') }}
        <p>{{ $inquiry->updated_at->diffForHumans() }}</p>
    </div>
    <div class="form-group col-sm-12">
        {{ Form::label('message', __('messages.inquiry.message').':') }}
        <p>{!! nl2br($inquiry->message) !!} </p>
    </div>
</div>
