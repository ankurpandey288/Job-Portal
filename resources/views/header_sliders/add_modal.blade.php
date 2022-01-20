<div id="addModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="HeaderSlider">{{__('messages.header_slider.new_header_slider')}}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'addNewForm','files'=>true]) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="validationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <div class="row">
                            <div class="px-3">
                                {{ Form::label('header_slider', __('messages.image_slider.image').':') }}<span
                                        class="text-danger">*</span>
                                <span><i class="fas fa-question-circle ml-1"
                                         data-toggle="tooltip"
                                         data-placement="top"
                                         title="{{ __('messages.header_slider.image_title_text') }}"></i></span>
                                <label class="image__file-upload"> {{ __('messages.setting.choose') }}
                                    {{ Form::file('header_slider',['id'=>'headerSlider','class' => 'd-none']) }}
                                </label>
                            </div>
                            <div class="col-6 w-auto pl-3 mt-1">
                                <img id='previewImage' class="img-thumbnail thumbnail-preview"
                                     src="{{ asset('assets/img/infyom-logo.png') }}">
                            </div>
                            <div class="form-group col-sm-4 mb-0 pt-1">
                                <label>{{ __('messages.common.status').':' }}</label><br>
                                <label class="custom-switch pl-0">
                                    <input type="checkbox" name="is_active" class="custom-switch-input"
                                           value="1" id="active" checked>
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right mt-2 pt-2">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" id="btnCancel" class="btn btn-light ml-1"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
