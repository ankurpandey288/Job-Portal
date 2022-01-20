<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('messages.testimonial.edit_testimonial')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ Form::open(['id' => 'editForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="editValidationErrorsBox"></div>
                {{ Form::hidden('testimonialId',null,['id'=>'testimonialId']) }}
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('customer_name', __('messages.testimonial.customer_name').':') }}<span
                            class="text-danger">*</span>
                        {{ Form::text('customer_name', null, ['class' => 'form-control','required' , 'id' => 'editCustomerName']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        <div class="row">
                            <div class="pl-3">
                                {{ Form::label('customer_image', __('messages.testimonial.customer_image').':') }}<span
                                    class="text-danger">*</span>
                                <label class="image__file-upload"> {{ __('messages.setting.choose') }}
                                    {{ Form::file('customer_image',['id'=>'editCustomerImage','class' => 'd-none']) }}
                                </label>
                            </div>
                            <div class="w-auto pl-3 mt-1">
                                <img id='editPreviewImage' class="img-thumbnail thumbnail-preview"
                                     src=""/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('description', __('messages.testimonial.description').':') }}<span
                                class="text-danger">*</span>
                        {{ Form::textarea('description', null, ['class' => 'form-control','id' => 'editDescription', 'rows' => '5']) }}
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
