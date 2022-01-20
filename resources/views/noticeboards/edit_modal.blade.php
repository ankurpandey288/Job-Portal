<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.noticeboard.edit_noticeboard') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ Form::open(['id' => 'editForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="editValidationErrorsBox"></div>
                {{ Form::hidden('noticeboardId',null,['id'=>'noticeboardId']) }}
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('title',__('messages.noticeboard.title').':') }}<span
                                class="text-danger">*</span>
                        {{ Form::text('title', null, ['class' => 'form-control','required','id' => 'editTitle' ]) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('description',__('messages.noticeboard.description').':') }}<span
                                class="text-danger">*</span>
                        {{ Form::textarea('description', null, ['class' => 'form-control','id' => 'editDescription']) }}
                    </div>
                    <div class="form-group col-sm-4 mb-0 pt-1">
                        <label>{{ __('messages.common.status').':' }}</label><br>
                        <label class="custom-switch pl-0">
                            <input type="checkbox" name="is_active" class="custom-switch-input"
                                   value="1" id="editIsActive" checked>
                            <span class="custom-switch-indicator"></span>
                        </label>
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
