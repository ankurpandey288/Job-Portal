<div class="col-xl-4 col-md-6 candidate-card">
    <div class="hover-effect-employee position-relative mb-5 border-hover-primary employee-border">
        <div class="employee-listing-details">
            <div class="d-flex employee-listing-description align-items-center justify-content-center flex-column">
                <div class="w-100">
                    <div class="text-left employee-data text-limit">
                        <span class="text-decoration-none text-color-gray">
                            <a href="javascript:void(0)" class="show-btn"
                               data-id="{{$noticeboard->id}}">{{ Str::limit($noticeboard->title,30) }}</a>
                            </span>
                    </div>
                    <div class="text-left employee-data mt-2">
                        <label class="custom-switch pl-0">
                            <input type="checkbox" name="Is Active"
                                   class="custom-switch-input isActive"
                                   data-id="{{ $noticeboard->id }}" {{ $noticeboard->is_active == 0 ? '' : 'checked' }}>
                            <span class="custom-switch-indicator"></span>
                            <span class="employee-label ml-1">{{ __('messages.common.status') }}</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="employee-action-btn">
            <a title="{{ __('messages.common.edit') }}" class="btn btn-warning action-btn edit-btn"
               data-id="{{$noticeboard->id}}" href="javascript:void(0)">
                <i class="fa fa-edit"></i>
            </a>
            <a title="{{ __('messages.common.delete') }}" class="btn btn-danger action-btn delete-btn"
               data-id="{{$noticeboard->id}}" href="javascript:void(0)">
                <i class="fa fa-trash"></i>
            </a>
        </div>
    </div>
</div>
