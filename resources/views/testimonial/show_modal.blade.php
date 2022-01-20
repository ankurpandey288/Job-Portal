<div class="modal fade" tabindex="-1" role="dialog" id="showModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.testimonial.testimonial_detail') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ Form::open(['id' => 'showForm']) }}
            <div class="modal-body">
                <div class="row details-page">
                    <div class="form-group col-sm-12">
                        {{ Form::label('name', __('messages.testimonial.customer_name').':') }}<br>
                        <span id="showCustomerName"></span>
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('customer_image', __('messages.testimonial.customer_image').':') }}<br>
                        {{--                        <a href="#" id="documentUrl" target="_blank"></a>--}}
                        <img src="" id="documentUrl" class="img-thumbnail thumbnail-preview"></img>
                        <label id="noDocument">N/A</label>
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('description',__('messages.testimonial.description').':') }}<br>
                        <div class="reported-note">
                            <span id="showDescription"></span>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
