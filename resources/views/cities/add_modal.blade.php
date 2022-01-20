<div id="addCityModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.city.new_city') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'addCityForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="cityValidationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('name',__('messages.common.name').':') }}<span class="text-danger">*</span>
                        {{ Form::text('name', null, ['class' => 'form-control','required', 'autocomplete' =>'off']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('state_id',__('messages.city.state_name').':') }}<span
                                class="text-danger">*</span>
                        {{ Form::select('state_id', $states, null, ['class' => 'form-control','required', 'id' => 'stateID','placeholder'=>'Select State']) }}
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'cityBtnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" id="cityBtnCancel" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
