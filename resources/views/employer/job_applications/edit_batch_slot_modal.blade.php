<div class="modal fade" tabindex="-1" role="dialog" id="editSlotModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center mb-1">
                <h5 class="modal-title">{{ __('messages.job_stage.edit_slot') }}</h5>
            </div>
            {{ Form::open(['id' => 'editSlotForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="editSlotValidationErrorsBox"></div>
                <input type="hidden" id="editSlotId">
                <div class="edit-slot-main-div">
                    <div class="slot-box mb-3">
                        <div class="row p-3">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label name="date"><?php echo __('messages.job_stage.date').':' ?></label>
                                    <span class="text-danger">*</span>
                                    <input type="text" class="form-control" name="date" id="editDate" required>
                                </div>
                                <div class="form-group mb-0">
                                    <label name="time"><?php echo __('messages.job_stage.time').':' ?></label>
                                    <span class="text-danger">*</span>
                                    <input type="text" class="form-control" name="time" id="editTime" required>
                                </div>
                            </div>
                            <div class="form-group col-sm-6 mb-0">
                                <label name="notes" class="d-flex justify-content-between"><?php echo __('messages.company.notes').':' ?>
                                </label>
                                <textarea class="form-control textarea-sizing" name="notes" id="editNotes"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right mt-4">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'editSlotBtnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" id="editSlotBtnCancel" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
