<div class="col-xl-4 col-md-6 candidate-card">
    <div class="hover-effect-border position-relative mb-5 border-hover-primary employee-border">
        <div class="employee-listing-details">
            <div class="d-flex employee-listing-description align-items-center justify-content-center flex-column">
                <div class="mb-auto w-100 employee-data mt-4">
                    <div class="text-center">
                        <label class="employee-label">{{ __('messages.country.country_name') }} :</label>
                        <label class="text-decoration-none text-color-gray">{{ $country->name }}</label>
                    </div>
                    <div class="text-center">
                        <label class="employee-label">{{ __('messages.country.short_code') }} :</label>
                        <label class="text-decoration-none text-color-gray">{{ $country->short_code }}</label>
                    </div>
                    <div class="text-center">
                        <label class="employee-label">{{ __('messages.country.phone_code') }} :</label>
                        <label class="text-decoration-none text-color-gray">{{($country->phone_code)? '+'.$country->phone_code:'N/A'}}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="employee-action-btn">

            <a title="{{ __('messages.common.edit') }}" class="btn btn-warning action-btn edit-btn"
               data-id="{{$country->id}}" href="#">
                <i class="fa fa-edit"></i>
            </a>
            <a title="{{ __('messages.common.delete') }}" class="btn btn-danger action-btn delete-btn"
               data-id="{{$country->id}}" href="#">
                <i class="fa fa-trash"></i>
            </a>
        </div>
    </div>
</div>
