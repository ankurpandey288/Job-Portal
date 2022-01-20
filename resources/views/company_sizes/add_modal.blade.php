<div id="addCompanySizeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CompanySizeHeader">{{ __('messages.company_size.new_company_size') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'addCompanySizeForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="companySizeValidationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('size',__('messages.company_size.size').':') }}<span class="text-danger">*</span>&nbsp;<span id="errMsg" class="text-danger"></span>
                        {{ Form::text('size', null, ['id'=>'size','class' => 'form-control','required', 'maxlength' => '8']) }}
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'companySizeBtnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" id="companySizeBtnCancel" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
