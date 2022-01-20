<div id="addSalaryPeriodModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="SalaryPeriodHeader">{{ __('messages.salary_period.new_salary_period') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'addSalaryPeriodForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="salaryPeriodValidationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('period',__('messages.salary_period.period').':') }}<span
                                class="text-danger">*</span>
                        {{ Form::text('period', null, ['class' => 'form-control','required']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('description',__('messages.salary_period.description').':') }}<span
                                class="text-danger">*</span>
                        {{ Form::textarea('description', null, ['class' => 'form-control','id' => 'salaryPeriodDescription']) }}
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'salaryPeriodBtnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" id="salaryPeriodBtnCancel" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
