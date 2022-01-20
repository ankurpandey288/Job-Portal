<div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="SalaryPeriodHeader">{{ __('messages.plan.new_subscription_plan') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {!! Form::open(['id'=>'addNewForm']) !!}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="validationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        {!! Form::label('name', __('messages.inquiry.name').':') !!}<span class="text-danger">*</span>
                        {!! Form::text('name', null, ['id'=>'name','class' => 'form-control','required']) !!}
                    </div>
                    <div class="form-group col-sm-12">
                        {!! Form::label('allowed_jobs', __('messages.plan.allowed_jobs').':') !!}<span
                                class="text-danger">*</span>
                        {!! Form::number('allowed_jobs', null, ['id'=>'allowedJobs', 'class' => 'form-control allowed-jobs', 'required', 'min' => '1', 'max' => '99999']) !!}
                    </div>
                    <div class="form-group col-sm-12">
                        {!! Form::label('currency', __('messages.plan.currency').':') !!}<span
                                class="text-danger">*</span>
                        {!! Form::select('salary_currency_id',[], null, ['id'=>'currency','required','class' => 'form-control select2Selector','placeholder' => 'Select Currency']) !!}
                    </div>
                    <div class="form-group col-sm-12">
                        {!! Form::label('amount', __('messages.plan.amount').':') !!}<span class="text-danger">*</span>
                        {!! Form::text('amount', null, ['id'=>'amount','class' => 'form-control amount','required','min'=>'1', 'max' => '99999']) !!}
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" id="btnCancel" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
