<div class="col-xl-4 col-md-6 candidate-card">
    <div class="hover-effect-border position-relative mb-5 border-hover-primary employee-border">
        <div class="employee-listing-details">
            <div class="d-flex employee-listing-description align-items-center justify-content-center flex-column">
                <div class="mb-auto w-100 employee-data mt-4">
                    <div class="text-center">
                        <label class="employee-label">{{ __('messages.salary_currency.currency_name') }} :</label>
                        <label class="text-decoration-none text-color-gray">{{ $salaryCurrency->currency_name }}</label>
                    </div>
                    <div class="text-center">
                        <label class="employee-label">{{ __('messages.salary_currency.currency_code') }} :</label>
                        <label class="text-decoration-none text-color-gray">{{ $salaryCurrency->currency_code }}</label>
                    </div>
                    <div class="text-center">
                        <label class="employee-label">{{ __('messages.salary_currency.currency_icon') }} :</label>
                        <label class="text-decoration-none text-color-gray">{{$salaryCurrency->currency_icon}}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
