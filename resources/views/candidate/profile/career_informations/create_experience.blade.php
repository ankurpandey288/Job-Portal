{{ Form::open(['id'=>'addNewExperienceForm']) }}
<div class="alert alert-danger d-none" id="validationErrorsBox"></div>
<div class="row">
    <div class="form-group col-sm-6">
        {{ Form::label('experience_title',__('messages.candidate_profile.experience_title').':') }}<span
                class="text-danger">*</span>
        {{ Form::text('experience_title', null, ['class' => 'form-control','required']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('company',__('messages.candidate_profile.company').':') }}<span
                class="text-danger">*</span>
        {{ Form::text('company', null, ['class' => 'form-control','required']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('country', __('messages.company.country').':') }}<span
                class="text-danger">*</span>
        {{ Form::select('country_id', $data['countries'], null, ['id'=>'countryId','required','class' => 'form-control','placeholder' => 'Select Country', 'data-modal-type' => 'experience']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('state', __('messages.company.state').':') }}
        {{ Form::select('state_id', [], null, ['id'=>'stateId','class' => 'form-control','placeholder' => 'Select State', 'data-modal-type' => 'experience']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('city', __('messages.company.city').':') }}
        {{ Form::select('city_id', [], null, ['id'=>'cityId','class' => 'form-control','placeholder' => 'Select City']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('start_date', __('messages.candidate_profile.start_date').':') }}<span
                class="text-danger">*</span>
        {{ Form::text('start_date', null, ['class' => 'form-control','id' => 'startDate','autocomplete' => 'off', 'required']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('end_date', __('messages.candidate_profile.end_date').':') }}<span
                class="text-danger" id="requiredText">*</span>
        {{ Form::text('end_date', null, ['class' => 'form-control','id' => 'endDate','autocomplete' => 'off', 'required']) }}
    </div>
    <div class="form-group col-sm-6 mb-0 pt-3">
        <label>{{ __('messages.candidate_profile.currently_working') }}</label>
        <div class="col-6 pl-0">
            <label class="custom-switch pl-0">
                <input type="checkbox" name="currently_working" class="custom-switch-input"
                       value="1" id="default">
                <span class="custom-switch-indicator"></span>
            </label>
        </div>
    </div>
    <div class="form-group col-sm-12">
        {{ Form::label('description', __('messages.candidate_profile.description').':') }}
        {{ Form::textarea('description', null, ['class' => 'form-control textarea-sizing','rows'=>'5']) }}
    </div>
</div>
<div class="text-right">
    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary mb-2','id'=>'btnExperienceSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
    <button type="button" id="btnCancel"
            class="btn btn-light ml-1 text-dark mb-2">{{ __('messages.common.cancel') }}</button>
</div>
{{ Form::close() }}
