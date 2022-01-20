<div class="modal fade" tabindex="-1" role="dialog" id="scheduleSlotBookModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center mb-1">
                <h5 class="modal-title">{{ __('messages.job_stage.choose_slots') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id' => 'scheduleSlotBookForm']) }}
            <div class="modal-body">
                <div class="alert-slot-msg alert-danger d-none" id="scheduleSlotBookValidationErrorsBox"></div>
                <div class="alert-slot-msg alert-success d-none" id="selectedSlotBookValidationErrorsBox"></div>
                <div class="slot-main-div mt-2">
                    
                </div>
                <div class="row p-3 choose-slot-textarea d-none">
                    <textarea name="choose_slot_notes" class="textarea-sizing" required placeholder="Enter Notes..."></textarea>
                </div>
                <div id="historyMainDiv" class="d-none">
                    <h3>{{ __('messages.job_stage.history') }}</h3>
                    <div id="historyDiv" class="scroll-history-div">

                    </div>
                </div>
                <div class="text-right mt-4">
                    {{ Form::button(__('messages.job_stage.send_slots'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'scheduleInterviewBtnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="submit" value="" class="btn btn-danger rejectSlot" id="rejectSlotBtnSave"
                            name="rejectSlot">{{__('messages.job_stage.reject_all_slot')}}
                    </button>
                    <button type="button" id="scheduleInterviewBtnCancel" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
