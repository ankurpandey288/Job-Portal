<div id="uploadModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.candidate_profile.upload_resume') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'addNewForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="validationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('title', __('messages.candidate_profile.title').':') }}<span class="text-danger">*</span>
                        <input type="text" class="form-control" name="title" required maxlength="150" id="uploadResumeTitle">
                    </div>
                    <div class="form-group col-sm-12">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="file" required>
                            <label class="custom-file-label text-truncate"
                                   for="customFile">{{ __('messages.common.choose_file') }}</label>
                        </div>
                    </div>
                    <div class="form-group col-sm-6 mb-0 pt-1">
                        <label>{{ __('messages.job_experience.is_default') }}</label>
                        <label class="custom-switch pl-0 col-12">
                            <input type="checkbox" name="is_default" class="custom-switch-input"
                                   value="1" id="default">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" id="btnCancel" class="btn btn-light ml-1 text-dark"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
