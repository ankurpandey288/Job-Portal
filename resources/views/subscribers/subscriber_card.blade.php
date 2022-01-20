<div class="col-xl-4 col-md-6 candidate-card">
    <div class="hover-effect-border position-relative mb-5 border-hover-primary employee-border">
        <div class="employee-listing-details">
            <div class="d-flex employee-listing-description align-items-center justify-content-center flex-column">
                <div class="mb-2 text-center">
                    <i class="fas fa-envelope-square subscribers-envelope"></i>
                </div>
                <div class="mb-auto w-100 text-center">
                    <label class="text-decoration-none text-color-gray">{{ $subscriber->email }}</label>
                </div>
            </div>
        </div>
        <div class="employee-action-btn">
            <a title="{{ __('messages.common.delete') }}" class="btn btn-danger action-btn delete-btn"
               data-id="{{$subscriber->id}}" href="#">
                <i class="fa fa-trash"></i>
            </a>
        </div>
    </div>
</div>
