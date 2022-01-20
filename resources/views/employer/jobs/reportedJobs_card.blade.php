<div class="col-xl-4 col-md-6 candidate-card">
    <div class="hover-effect-employee position-relative mb-5 border-hover-primary employee-border">
        <div class="employee-listing-details">
            <div class="d-flex employee-listing-description align-items-center justify-content-center flex-column">
                <div class="pl-0 mb-2 employee-avatar">
                    <img src="{{ $reportedJob->job->company->company_url }}"
                         class="img-responsive users-avatar-img employee-img mr-2">
                </div>
                <div class="mb-auto w-100 employee-data">
                    <div class="d-flex justify-content-center align-items-center w-100">
                        <div>
                            <label class="text-decoration-none text-color-gray">
                                <a href=" {{ route('front.job.details') }}/{{ $reportedJob->job->job_id}}"
                                   class="text-decoration-none text-color-gray"
                                   target="_blank"> {{ $reportedJob->job->job_title }}</a>
                            </label>
                        </div>
                    </div>
                    <div class="text-center">
                        <label class="employee-label">{{ __('messages.company.reported_by') }} :</label>
                        <label class="text-decoration-none text-color-gray">
                            <a href="{{ url('candidate-details') }}/{{$reportedJob->user->candidate->unique_id}}"
                               class="text-decoration-none text-color-gray"
                               target="_blank">{{ $reportedJob->user->full_name }}</a>
                        </label>
                    </div>
                    <div class="text-center">
                        <label class="employee-label">{{ __('messages.company.reported_on') }} :</label>
                        <label class="text-decoration-none text-color-gray">{{ \Carbon\Carbon::parse($reportedJob->created_at)->formatLocalized('%d %b, %Y') }}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="employee-action-btn">
            <button title="{{ __('messages.common.view') }}" class="btn btn-info action-btn view-note"
               data-id="{{$reportedJob->id}}">
                <i class="fas fa-eye"></i>
            </button>
            <a title="{{ __('messages.common.delete') }}" class="btn btn-danger action-btn delete-btn"
               data-id="{{$reportedJob->id}}" href="javascript:void(0)">
                <i class="fa fa-trash"></i>
            </a>
        </div>
    </div>
</div>
