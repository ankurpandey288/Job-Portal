<div class="col-xl-4 col-md-6 candidate-card">
    <div class="hover-effect-border position-relative mb-5 border-hover-primary employee-border custom-h-auto">
        <div class="employee-listing-details">
            <div class="d-flex employee-listing-description align-items-center justify-content-center flex-column">
                <div class="w-100">
                    <div class="text-left employee-data text-limit">
                        <span class="text-decoration-none text-color-gray">{{ Str::limit($degreeLevel->name,30) }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="employee-action-btn">

            <a title="{{ __('messages.common.edit') }}" class="btn btn-warning action-btn edit-btn"
               data-id="{{$degreeLevel->id}}" href="#">
                <i class="fa fa-edit"></i>
            </a>
            <a title="{{ __('messages.common.delete') }} " class="btn btn-danger action-btn delete-btn"
               data-id="{{$degreeLevel->id}}" href="#">
                <i class="fa fa-trash"></i>
            </a>
        </div>
    </div>
</div>
