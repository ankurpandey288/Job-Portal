<div class="col-xl-4 col-md-6 candidate-card">
    <div class="hover-effect-border position-relative mb-5 border-hover-primary employee-border">
        <div class="employee-listing-details">
            <div class="d-flex employee-listing-description align-items-center justify-content-center flex-column">
                <div class="mb-auto w-100 employee-data mt-4">
                    <div class="text-center">
                        <label class="employee-label">{{ __('messages.inquiry.name') }} :</label>
                        <label class="text-decoration-none text-color-gray">{{ $inquiry->name }}</label>
                    </div>
                    <div class="text-center">
                        <label class="employee-label">{{ __('messages.inquiry.subject') }} :</label>
                        <label class="text-decoration-none text-color-gray">{{ $inquiry->subject }}</label>
                    </div>
                    <div class="text-center">
                        <label class="employee-label">{{ __('messages.inquiry.inquiry_date') }} :</label>
                        <label class="text-decoration-none text-color-gray">{{ \Carbon\Carbon::parse($inquiry->created_at)->format('d M Y') }}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="employee-action-btn">
            <a title="{{ __('messages.common.view') }}" class="btn btn-info action-btn" href="{{ route('inquires.show', $inquiry->id)}}">
                <i class="fa fa-eye"></i>
            </a>
            <a title="{{ __('messages.common.delete') }}" class="btn btn-danger action-btn delete-btn"
               data-id="{{$inquiry->id}}" href="javascript:void(0)">
                <i class="fa fa-trash"></i>
            </a>
        </div>
    </div>
</div>
