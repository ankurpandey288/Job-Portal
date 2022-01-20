<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.salary_period.edit_salary_period') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ Form::open(['id' => 'editForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="editValidationErrorsBox"></div>
                {{ Form::hidden('salaryPeriodId',null,['id'=>'salaryPeriodId']) }}
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('period',__('messages.salary_period.period').':') }}<span
                                class="text-danger">*</span>
                        {{ Form::text('period', null, ['class' => 'form-control','required','id' => 'editSalaryPeriod' ]) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('description',__('messages.salary_period.description').':') }}<span
                                class="text-danger">*</span>
                        {{ Form::textarea('description', null, ['class' => 'form-control','id' => 'editDescription']) }}
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnEditSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" id="btnEditCancel" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}
                    </button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
