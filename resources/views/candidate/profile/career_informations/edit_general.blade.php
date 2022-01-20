{{ Form::open(['id'=>'editGeneralForm']) }}
<div class="row">
    <div class="form-group col-sm-6">
        {{ Form::label('first_name',__('messages.candidate.first_name').':') }}<span
                class="text-danger">*</span>
        {{ Form::text('first_name', null, ['class' => 'form-control','required','id'=> 'first_name']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('last_name',__('messages.candidate.last_name').':') }}<span
                class="text-danger">*</span>
        {{ Form::text('last_name', null, ['class' => 'form-control','required','id'=>'last_name']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('email',__('messages.candidate.email').':') }}<span class="text-danger">*</span>
        {{ Form::text('email', null, ['class' => 'form-control','required','id'=>'email','disabled']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('phone',__('messages.candidate.phone').':') }}
        {{ Form::number('phone', null, ['class' => 'form-control','id'=>'phone']) }}
    </div>
    <div class="form-group col-sm-12">
        {{ Form::label('skillId',__('messages.candidate.candidate_skill').':') }}<span
                class="text-danger">*</span>
        {{Form::select('candidateSkills[]',$data['skills'], (count($candidateSkills) > 0)?$candidateSkills:null, ['class' => 'form-control  ','id'=>'skillId','multiple'=>true,'required'])}}
    </div>
    <div class="form-group col-sm-12">
        {{ Form::label('country', __('messages.company.country').':') }}<span
                class="text-danger">*</span>
        {{ Form::select('country_id', $data['countries'], null, ['id'=>'candidateCountryId','class' => 'form-control','placeholder' => 'Select Country','required']) }}
    </div>
    <div class="form-group col-sm-12">
        {{ Form::label('state', __('messages.company.state').':') }}
        {{ Form::select('state_id', [], null, ['id'=>'candidateStateId','class' => 'form-control','placeholder' => 'Select State']) }}
    </div>
    <div class="form-group col-sm-12">
        {{ Form::label('city', __('messages.company.city').':') }}
        {{ Form::select('city_id', [], null, ['id'=>'candidateCityId','class' => 'form-control','placeholder' => 'Select City']) }}
    </div>
</div>
<div class="text-right">
    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnEditGeneralSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
    <button type="button" id="btnGeneralCancel"
            class="btn btn-light ml-1 text-dark">{{ __('messages.common.cancel') }}</button>
</div>
{{ Form::close() }}
