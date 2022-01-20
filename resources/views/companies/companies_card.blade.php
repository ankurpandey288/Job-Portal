<div class="col-xl-4 col-md-6 candidate-card">
    <div class="hover-effect-employee position-relative mb-5 border-hover-primary employee-border fix-employee-height">
        <div class="employee-listing-details">
            <div class="d-flex employee-listing-description align-items-center justify-content-center flex-column employee-pt-2">
                <div class="pl-0 mb-2 employee-avatar">
                    <img src="{{ $employee['company_url'] }}"
                         class="img-responsive users-avatar-img employee-img mr-2">
                </div>
                <div class="mb-auto w-100 employee-data">
                    <div class="d-flex justify-content-center align-items-center w-100">
                        <div>
                            <a href="{{ route('company.index') }}/{{ $employee['id'] }}"
                               class="employee-listing-title text-decoration-none">{{ $employee['user']['first_name'] }}</a>
                        </div>
                    </div>
                    <div class="text-center">
                        <label class="text-decoration-none text-color-gray">{{ $employee['user']['email'] }}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-0">
            <div class="text-center">
                <label class="custom-switch pl-0">
                    <input type="checkbox" name="Is Active"
                           class="custom-switch-input isActive"
                           data-id="{{ $employee['id']}}" {{$employee['user']['is_active']==0?'':'checked' }}>
                    <span class="custom-switch-indicator"></span>
                    <span class="employee-label ml-1">{{ __('messages.common.status') }}</span>
                </label>
            </div>
            <div class="text-center">
                <label class="custom-switch pl-0">
                    <input type="checkbox" name="Is Active"
                           class="custom-switch-input is-email-verified"
                           data-id="{{ $employee['id'] }}" {{ $employee['user']['email_verified_at']!=null?'checked':'' }}>
                    <span class="custom-switch-indicator"></span>
                    <span class="employee-label ml-1">{{ __('messages.company.email_verified') }}</span>
                </label>
            </div>
            <div class="text-center">
                <a title="{{ __('messages.common.resend_verification_mail') }}"
                   class="btn btn-primary action-btn send-email-verification" data-id="{{ $employee['id'] }}"
                   href="#">
                    <i class="fa fa-sync"></i>
                </a>
                <label class="employee-label ml-1">{{ __('messages.common.resend_verification_mail') }}</label>
            </div>
        </div>

        <div class="employee-action-btn">
            <a title="{{ __('messages.common.edit') }}"
               class="btn btn-warning action-btn edit-action-btn edit-btn"
               href="{{ route('company.index') }}/{{ $employee['id'] }}/edit">
                <i class="fa fa-edit"></i>
            </a>
            <a title="{{ __('messages.common.delete') }}"
               class="btn btn-danger action-btn delete-action-btn delete-btn"
               data-id="{{ $employee['id'] }}" href="#">
                <i class="fa fa-trash"></i>
            </a>
        </div>
        <div class="employee-isFeature">
            @if(!$employee['activeFeatured'])
                <a class="btn btn-info action-btn w-100 dropdown-toggle text-white"
                   type="button" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">{{ __('messages.front_settings.make_feature') }}</a>
                <div class="dropdown-menu w-auto">
                    <a class="dropdown-item adminMakeFeatured"
                       data-id="{{ $employee['id'] }}"
                       href="#">{{ __('messages.front_settings.make_featured') }}</a>
                </div>
            @else
                <div title="Expries On {{ \Carbon\Carbon::parse($employee['activeFeatured']['end_time'])->format('Y/m/d') }}"
                     data-toggle="tooltip" data-placement="top">
                    <a class="btn btn-success action-btn w-100 dropdown-toggle text-white"
                       type="button" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">{{ __('messages.front_settings.featured') }}
                        <i class="far fa-check-circle pl-1 pt-1"></i></a>
                    <div class="dropdown-menu w-auto">
                        <a class="dropdown-item  adminUnFeatured"
                           data-id="{{ $employee['id'] }}"
                           href="#">{{ __('messages.front_settings.remove_featured') }}</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
