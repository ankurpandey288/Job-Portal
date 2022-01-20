<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.plan.edit_subscription_plan') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['id' => 'editForm']) !!}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="editValidationErrorsBox"></div>
                {!! Form::hidden('planId',null,['id'=>'planId']) !!}
                <div class="row">
                    <div class="form-group col-sm-12">
                        {!! Form::label('name', __('messages.inquiry.name').':') !!}<span class="text-danger">*</span>
                        {!! Form::text('name', null, ['id'=>'editName','class' => 'form-control','required']) !!}
                    </div>
                    <div class="form-group col-sm-12">
                        {!! Form::label('allowed_jobs', __('messages.plan.allowed_jobs').':') !!}<span
                                class="text-danger">*</span>
                        {!! Form::number('allowed_jobs', null, ['id'=>'editAllowedJobs', 'class' => 'form-control allowed-jobs', 'required', 'min' => '1', 'max' => '99999']) !!}
                    </div>
                    <div class="form-group col-sm-12">
                        {!! Form::label('currency', __('messages.plan.currency').':') !!}<span
                                class="text-danger">*</span>
                        {!! Form::select('salary_currency_id',[], null, ['id'=>'editCurrency','required','class' => 'form-control select2Selector','placeholder' => 'Select Currency','disabled']) !!}
                    </div>
                    <div class="form-group col-sm-12">
                        {!! Form::label('amount', __('messages.plan.amount').':') !!}<span class="text-danger">*</span>
                        {!! Form::text('amount', null, ['id'=>'editAmount','class' => 'form-control amount', 'required', 'min' => '1', 'max' => '99999', 'readonly', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) !!}
                        <span class="text-danger d-none"
                              id="planAmount">{{ __('messages.plan.plan_amount_cannot_be_changes') }}</span>
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnEditSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" id="btnEditCancel" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
