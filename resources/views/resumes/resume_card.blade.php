<div class="col-xl-4 col-md-6 candidate-card">
    <div class="hover-effect-employee position-relative mb-5 border-hover-primary employee-border">
        <div class="employee-listing-details">
            <div class="d-flex employee-listing-description align-items-center justify-content-center flex-column">
                <div class="pl-0 mb-2 employee-avatar">
                    <img src="{{ $candidateResume->candidate->candidate_url }}"
                         class="img-responsive users-avatar-img employee-img mr-2">
                </div>
                <div class="mb-auto w-100 employee-data">
                    <div class="d-flex justify-content-center align-items-center w-100">
                        <div>
                            <span class="text-decoration-none text-color-gray one-line-ellip">{{ $candidateResume->candidate->user->full_name}}</span>
                        </div>
                    </div>
                    <div class="text-center one-line-ellip">
                        <label class="employee-label">{{ __('messages.faq.title') }} :</label>
                        <span class="text-decoration-none text-color-gray">{{ $candidateResume->custom_properties['title']}}</span>
                    </div>
                </div>
            </div>
            <div class="download-resume">
                <a href="{{ route('download.all-resume') .'/'. $candidateResume->id}}"
                   class="download-link"><i class="fas fa-download"></i> {{ __('messages.common.download') }}</a>
            </div>
        </div>
    </div>
</div>
