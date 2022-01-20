<div id="addJobCategoryModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="JobCategoryHeader">{{ __('messages.job_category.new_job_category') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'addJobCategoryForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="jobCategoryValidationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('name',__('messages.job_category.name').':') }}<span class="text-danger">*</span>
                        {{ Form::text('name', null, ['class' => 'form-control','required']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('description',__('messages.job_category.description').':') }}
                        {{ Form::textarea('description', null, ['class' => 'form-control','id' => 'jobCategoryDescription', 'rows' => '5']) }}
                    </div>
                    <div class="form-group col-sm-4 mb-0 pt-1">
                        <label>{{ __('messages.job_category.is_featured').':' }}</label>
                        <label class="custom-switch pl-0 col-12">
                            <input type="checkbox" name="is_featured" class="custom-switch-input"
                                   value="1" id="featured">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'jobCategoryBtnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" id="jobCategoryBtnCancel" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
