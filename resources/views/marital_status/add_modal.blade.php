<div id="addMaritalStatusModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="SalaryPeriodHeader">{{ __('messages.marital_status.new_marital_status') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'addMaritalStatusForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="maritalStatusValidationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('marital_status',__('messages.marital_status.marital_status').':') }}<span
                                class="text-danger">*</span>
                        {{ Form::text('marital_status', null, ['class' => 'form-control','required']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('description',__('messages.marital_status.description').':') }}<span
                                class="text-danger">*</span>
                        {{ Form::textarea('description', null, ['class' => 'form-control','id' => 'martialDescription']) }}
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'maritalStatusBtnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" id="maritalStatusBtnCancel" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
