<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.country.edit_country') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ Form::open(['id' => 'editForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="editValidationErrorsBox"></div>
                {{ Form::hidden('countryId',null,['id'=>'countryId']) }}
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('name',__('messages.common.name').':') }}<span class="text-danger">*</span>
                        {{ Form::text('name', null, ['class' => 'form-control','required', 'id'=>'editName']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('short_code',__('messages.country.short_code').':') }}<span
                                class="text-danger">*</span>
                        {{ Form::text('short_code', null, ['class' => 'form-control','required', 'id'=>'editShortCode']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('phone_code',__('messages.country.phone_code').':') }}
                        {{ Form::text('phone_code', null, ['class' => 'form-control', 'id'=>'editPhoneCode', 'maxlength' => '4', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
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
