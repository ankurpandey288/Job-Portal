<div>
    <div class="section gray padding-bottom-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
                <div class="col-lg-12 col-md-12">
                    @if(count($appliedJobs) > 0 || $searchByAppliedJob != '' || $jobApplicationStatus != '')
                        <div class="row mb-3 justify-content-end">
                            <div class="col-md-3">
                                {{ Form::select('job-application-status', $jobApplicationStatusArr, null, ['class' => 'form-control','id'=>'jobApplicationStatus','placeholder' => 'All', 'wire:model' => "jobApplicationStatus"]) }}
                            </div>
                            <div class="col-md-3">
                                <input wire:model.debounce.100ms="searchByAppliedJob" type="search"
                                       id="searchByAppliedJob"
                                       placeholder="{{ __('web.job_menu.search_applied_job') }}"
                                       class="form-control search-box-placeholder">
                            </div>
                        </div>
                    @endif
                    @if(count($appliedJobs) > 0)
                        <div class="content1 with-padding">
                            <div class="row  position-relative">
                                @foreach($appliedJobs as $appliedJob)
                                    <div class="col-12 col-sm-6 col-md-6 col-xl-6 favorite-job-details">
                                        <div class="hover-effect-applied-jobs position-relative mb-4 custom-h-85">
                                            <div class="ribbon float-right favorite-companies-ribbon ribbon-{{ \App\Models\JobApplication::STATUS_COLOR[$appliedJob->status] }}">
                                                {{ \App\Models\JobApplication::STATUS[$appliedJob->status] }}
                                            </div>
                                            <div class="job-listing-details">
                                                <div class="d-flex job-listing-description">
                                                    <div class="mb-auto w-100 favorite-company-data">
                                                        <h3 class="job-listing-title-applied-jobs margin-bottom-5">
                                                            <i class="fas fa-briefcase"></i> &nbsp;<a
                                                                    href="{{ route('front.job.details',$appliedJob->job->job_id) }}"
                                                                    target="_blank">{{ $appliedJob->job->job_title }}</a>
                                                        </h3>
                                                        <h3 class="job-listing-title-applied-jobs margin-bottom-5">
                                                            <i class="far fa-clock"></i>
                                                            &nbsp;{{ __('messages.common.applied_on') }} :
                                                            {{ (!empty($appliedJob->created_at)) ? $appliedJob->created_at->format('dS M ,Y')  : __('messages.common.n/a') }}
                                                        </h3>
                                                        <h3 class="job-listing-title-applied-jobs margin-bottom-5">
                                                            <i class="fas fa-money-check-alt"></i>
                                                            &nbsp;{{ (!empty($appliedJob->expected_salary)) ? number_format($appliedJob->expected_salary)   : __('messages.common.n/a') }} {{ $appliedJob->job->currency->currency_icon }}
                                                        </h3>
                                                        @isset($appliedJob->jobStage->name)
                                                            <h3 class="job-listing-title-applied-jobs margin-bottom-5">
                                                                <i class="fab fa-usps"></i>
                                                                &nbsp;{{ $appliedJob->jobStage->name }}
                                                            </h3>
                                                        @endisset
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="#" data-toggle="dropdown"
                                               class="notification-toggle action-dropdown position-xs-bottom"
                                               aria-expanded="false">
                                                <i class="fas fa-ellipsis-v action-toggle-mr"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <div class="dropdown-list-content dropdown-list-icons">
                                                    <a href="#" class="dropdown-item dropdown-item-desc apply-job-note"
                                                       data-id="{{ $appliedJob->id }}"><i
                                                                class="fas fa-eye mr-2 btn btn-primary action-btn"></i>{{ __('messages.common.view') }}
                                                    </a>
                                                    @if(\App\Models\JobApplicationSchedule::whereJobApplicationId($appliedJob->id)->exists() && !($appliedJob->status == \App\Models\JobApplication::REJECTED) && !($appliedJob->status == \App\Models\JobApplication::STATUS_APPLIED) && !($appliedJob->status == \App\Models\JobApplication::COMPLETE))
                                                        <a href="javascript:void(0)"
                                                           class="dropdown-item dropdown-item-desc schedule-slot-book"
                                                           data-id="{{ $appliedJob->id }}">
                                                            <i class="fas fa-user-clock mr-2 btn btn-dark action-btn"></i>
                                                            {{ __('messages.job_stage.slots') }}
                                                        </a>
                                                    @endif
                                                    <a href="#"
                                                       class="dropdown-item dropdown-item-desc delete-btn remove-applied-jobs"
                                                       data-id="{{ $appliedJob->id }}"><i
                                                                class="fas fa-trash mr-2 btn btn-danger action-btn delete-btn"></i>{{ __('messages.common.delete') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="float-right my-2">
                                @if($appliedJobs->count() > 0)
                                    {{ $appliedJobs->links() }}
                                @endif
                            </div>
                        </div>
                        @else
                            @if($searchByAppliedJob == null || empty($searchByAppliedJob))
                                <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                                    <h5>{{ __('messages.job.no_applied_job_found') }} </h5>
                                </div>
                            @else
                                <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                                    <h5>{{ __('messages.job.applies_job_not_found') }} </h5>
                                </div>
                            @endif
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
