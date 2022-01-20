<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.language.edit_language') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ Form::open(['id' => 'editForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="editValidationErrorsBox"></div>
                {{ Form::hidden('languageId',null,['id'=>'languageId']) }}
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('language',__('messages.language.language').':') }}<span
                                class="text-danger">*</span>
                        {{ Form::text('language', null, ['class' => 'form-control','required','id' => 'editLanguage']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('iso_code',__('messages.language.iso_code').':') }}<span
                                class="text-danger">*</span>
                        {{ Form::text('iso_code', null, ['class' => 'form-control','required','id' => 'editIso']) }}
                    </div>
                </div>
                <div class="text-right mt-2 pt-2">
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
