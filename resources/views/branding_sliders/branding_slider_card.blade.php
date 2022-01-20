<div class="col-xl-4 col-md-6 candidate-card">
    <div class="hover-effect-employee position-relative mb-5 border-hover-primary employee-border">
        <div class="employee-listing-details">
            <div class="d-flex employee-listing-description align-items-center justify-content-center flex-column">
                <div class="pl-0 mb-2 employee-avatar">
                    <img src="{{ $brandingSlider->branding_slider_url }}"
                         class="img-responsive users-avatar-img employee-img mr-2 image-stretching">
                </div>
                <div class="mb-auto w-100 employee-data">
                    <div class="d-flex justify-content-center align-items-center w-100">
                        <div>
                            <span class="text-decoration-none text-color-gray">
                                {{ $brandingSlider->title }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-0">
            <div class="text-center">
                <label class="custom-switch pl-0">
                    <input type="checkbox" name="Is Active"
                           class="custom-switch-input isActive"
                           data-id="{{ $brandingSlider->id }}" {{ $brandingSlider->is_active == 0 ? '' : 'checked' }}>
                    <span class="custom-switch-indicator"></span>
                    <span class="employee-label ml-1">{{ __('messages.common.status') }}</span>
                </label>
            </div>
        </div>

        <div class="employee-action-btn">
            <a title="{{ __('messages.common.edit') }}" class="btn btn-warning action-btn edit-btn"
               data-id="{{$brandingSlider->id}}" href="javascript:void(0)">
                <i class="fa fa-edit"></i>
            </a>
            <a title="{{ __('messages.common.delete') }}" class="btn btn-danger action-btn delete-btn"
               data-id="{{$brandingSlider->id}}" href="javascript:void(0)">
                <i class="fa fa-trash"></i>
            </a>
        </div>
    </div>
</div>
