<div class="modal fade" tabindex="-1" role="dialog" id="scheduleInterviewModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center mb-1">
                <h5 class="modal-title">{{ __('messages.job_stage.add_slots') }}</h5>
                <a href="javascript:void(0)" class="btn btn-primary form-btn add-slot">
                    {{ __('messages.job_stage.add_slots') }}
                </a>
            </div>
            {{ Form::open(['id' => 'scheduleInterviewForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="rejectSlotValidationErrorsBox"></div>
                <div class="slot-main-div">
                    <div class="slot-box mb-3">
                        <div class="row p-3">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label name="date"><?php echo __('messages.job_stage.date').':' ?></label>
                                    <span class="text-danger">*</span>
                                    <input type="text" class="form-control date" name="date[1]" id="date[1]" required>
                                </div>
                                <div class="form-group mb-0">
                                    <label name="time"><?php echo __('messages.job_stage.time').':' ?></label>
                                    <span class="text-danger">*</span>
                                    <input type="text" class="form-control time" name="time[1]" id="time[1]" required>
                                </div>
                            </div>
                            <div class="form-group col-sm-6 mb-0">
                                <label name="notes" class="d-flex justify-content-between"><?php echo __('messages.company.notes').':' ?>
                                    <a href="javascript:void(0)" aria-label="Close" class="close text-danger delete-schedule-slot">×</a>
                                </label>
                                <textarea class="form-control textarea-sizing" name="notes[1]"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="historyMainDiv" class="d-none">
                    <h3>{{ __('messages.job_stage.history') }}</h3>
                    <div id="historyDiv">
                        
                    </div>
                </div>
                <div class="text-right mt-4">
                    {{ Form::button(__('messages.job_stage.send_slots'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'scheduleInterviewBtnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" id="scheduleInterviewBtnCancel" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
