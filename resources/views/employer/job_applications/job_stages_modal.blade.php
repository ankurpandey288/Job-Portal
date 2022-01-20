<div class="modal fade" tabindex="-1" role="dialog" id="changeJobStageModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.job_stage.job_stage_detail') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ Form::open(['id' => 'changeJobStageForm']) }}
            <div class="modal-body">
                <input type="hidden" name="job_application_id" value="" id="jobApplicationId">
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('job_stage',__('messages.job_stage.job_stage').':') }}<span
                                class="text-danger">*</span>
                        {{ Form::select('job_stage', $jobStage, null, ['class' => 'form-control','required', 'id' => 'jobStageId', 'placeholder' => 'Select Job Stage']) }}
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'changeJobStageBtnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" id="jobStageBtnCancel" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
