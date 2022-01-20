@extends('web.layouts.app')
@section('title')
    {{ __('web.job_details.job_details') }}
@endsection
@section('content')


    <!-- ===== Start of Main Wrapper Job Section ===== -->
    <section class="ptb15 bg-gray" id="job-page">
        <div class="container mTop">

            <!-- Start of Row -->
            <div class="row">
                <div class="col-md-12 col-lg-12 pl-0">
                    @if($job->is_suspended || !$isActive)
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="alert alert-warning text-warning bg-transparent" role="alert">
                                    {{ __('web.job_details.job_is') }}
                                    <strong> {{\App\Models\Job::STATUS[$job->status]}}
                                        .</strong>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(Session::has('warning'))
                        <div class="alert alert-warning" role="alert">
                            {{ Session::get('warning') }}
                            <a href="{{ route('candidate.profile',['section'=> 'resumes']) }}"
                               class="alert-link ml-2 ">{{ __('web.job_details.click_here') }}</a> {{ __('web.job_details.to_upload_resume') }}
                            .
                        </div>
                    @endif
                </div>

                <!-- ===== Start of Job Details ===== -->
                <div class="col-md-8 col-xs-12">

                    <!-- Start of Company Info -->
                    <div class="row company-info job-d-info container-shadow">

                        <!-- Jobjob-page Company Image -->
                        <div class="col-md-3">
                            <div class="job-company">
                                <a href="#">
                                    <img src="{{ $job->company->company_url }}" alt="">
                                </a>
                            </div>
                        </div>

                        <!-- Job Company Info -->
                        <div class="col-md-9">
                            <div class="job-company-info mt10">
                                <h3 class="capitalize">{{ html_entity_decode(Str::limit($job->job_title,50,'...')) }}</h3>
                                @auth
                                    @role('Candidate')
                                    <ul class="social-btns list-inline mt5">
                                        <li class="j-detail-social-btn">
                                            <button class="btn btn-success btn-effect emailJobToFriend"
                                                    data-toggle="modal"
                                                    data-target="#emailJobToFriendModal">{{ __('web.job_details.email_to_friend') }}
                                            </button>
                                        </li>
                                        <li class="j-detail-social-btn">
                                            <button class="btn btn-red btn-effect reportJobAbuse {{ ($isJobReportedAsAbuse) ? 'disabled' : '' }}"
                                                    data-toggle="modal"
                                                    data-target="#reportJobAbuseModal">{{ __('web.job_details.report_abuse') }}
                                            </button>
                                        </li>
                                        @if(!$isJobApplicationRejected)
                                            <li class="j-detail-social-btn">
                                                <button class="btn btn-orange btn-effect"
                                                        data-favorite-user-id="{{ (getLoggedInUserId() !== null) ? getLoggedInUserId() : null }}"
                                                        data-favorite-job-id="{{ $job->id }}" id="addToFavourite">
                                                    <span class="favouriteText"></span>
                                                </button>
                                            </li>
                                        @endif
                                    </ul>
                                    @endrole
                                @endauth
                                <div class="pt10">
                                    @if($job->description)
                                        <p>{!! nl2br($job->description) !!} </p>
                                    @else
                                        <p>N/A</p>
                                    @endif
                                </div>

                            </div>
                        </div>


                    </div>
                    <div class="row mt40">
                        <div class="col-md-12">
                            <h4 class="font-weight-bold">{{ __('web.job_details.job_details') }}</h4>
                            <hr/>
                        </div>
                        <div class="col-md-8 mt15">

                            <div class="row mt15">
                                <div class="col-md-5">
                                    <h6>{{ Form::label('job_category_id', __('messages.job_category.job_category').':') }}</h6>
                                </div>
                                <div class="col-md-7"><h6>{{ html_entity_decode($job->jobCategory->name) }}</h6></div>
                            </div>
                            @if($job->careerLevel)
                                <div class="row mt15">
                                    <div class="col-md-5">
                                        <h6>{{ Form::label('career_level_id', __('messages.job.career_level').':') }}</h6>
                                    </div>
                                    <div class="col-md-7">
                                        <h6>{{ html_entity_decode($job->careerLevel->level_name) }}</h6></div>
                                </div>
                            @endif
                            @if(count($job->jobsTag) > 0)
                                <div class="row mt15">
                                    <div class="col-md-5">
                                        <h6>{{ Form::label('job_shift_id', __('messages.job_tag.show_job_tag').':') }}</h6>
                                    </div>
                                    <div class="col-md-7">
                                        <h6>{{ ($job->jobsTag->isNotEmpty()) ? html_entity_decode($job->jobsTag->pluck('name')->implode(', ')) : __('messages.common.n/a') }}</h6>
                                    </div>
                                </div>
                            @endif
                            <div class="row mt15">
                                <div class="col-md-5">
                                    <h6>{{ Form::label('job_type', __('messages.job.job_type').':') }}</h6>
                                </div>
                                <div class="col-md-7">
                                    <h6>{{ ($job->jobType) ? html_entity_decode($job->jobType->name) : __('messages.common.n/a') }}</h6>
                                </div>
                            </div>
                            @if($job->jobShift)
                                <div class="row mt15">
                                    <div class="col-md-5">
                                        <h6>{{ Form::label('job_shift_id', __('messages.job.job_shift').':') }}</h6>
                                    </div>
                                    <div class="col-md-7"><h6>{{ html_entity_decode($job->jobShift->shift) }}</h6></div>
                                </div>
                            @endif
                            <div class="row mt15">
                                <div class="col-md-5">
                                    <h6>{{ Form::label('functional_area_id', __('messages.job.functional_area').':') }}</h6>
                                </div>
                                <div class="col-md-7"><h6>{{ html_entity_decode($job->functionalArea->name) }}</h6>
                                </div>
                            </div>
                            @if($job->degreeLevel)
                                <div class="row mt15">
                                    <div class="col-md-5">
                                        <h6>{{ Form::label('degree_level_id', __('messages.job.degree_level').':') }}</h6>
                                    </div>
                                    <div class="col-md-7"><h6>{{ html_entity_decode($job->degreeLevel->name) }}</h6>
                                    </div>
                                </div>
                            @endif
                            <div class="row mt15">
                                <div class="col-md-5">
                                    <h6>{{ Form::label('position', __('messages.positions').':') }}</h6>
                                </div>
                                <div class="col-md-7"><h6>{{ isset($job->position)?$job->position:'0' }}</h6>
                                </div>
                            </div>
                            <div class="row mt15">
                                <div class="col-md-5">
                                    <h6>{{ Form::label('position', __('messages.job_experience.job_experience').':') }}</h6>
                                </div>
                                <div class="col-md-7"><h6>
                                        {{ isset($job->experience) ? $job->experience .' '. __('messages.candidate_profile.year') :'No experience' }}</h6>
                                </div>
                            </div>
                            <div class="row mt15">
                                <div class="col-md-5">
                                    <h6>{{ Form::label('salary_period_id', __('messages.job.salary_period').':') }}</h6>
                                </div>
                                <div class="col-md-7"><h6>{{ $job->salaryPeriod->period }}</h6></div>
                            </div>
                            <div class="row mt15">
                                <div class="col-md-5">
                                    <h6>{{ Form::label('is_freelance', __('messages.job.is_freelance').':') }}</h6>
                                </div>
                                <div class="col-md-7">
                                    <h6>{{ $job->is_freelance == 1 ? __('messages.common.yes') : __('messages.common.no') }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Company Info -->

                </div>
                <!-- ===== End of Job Details ===== -->

                <!-- ===== Start of Job Sidebar ===== -->
                <div class="col-md-4 col-xs-12">

                    <!-- Start of Job Sidebar -->
                    <div class="job-sidebar">
                        <ul class="job-overview nopadding mt5 mb5">
                            <li>
                                <h5><i class="fa fa-calendar"></i>{{ __('web.job_details.date_posted') }}:</h5>
                                <span>{{ date('jS M, Y', strtotime($job->created_at)) }}</span>
                            </li>

                            <li>
                                <h5><i class="fa fa-map-marker"></i>{{ __('web.common.location') }}:</h5>
                                <span>
                                    @if (!empty($job->city_id))
                                        {{$job->city_name}} ,
                                    @endif

                                    @if (!empty($job->state_id))
                                        {{$job->state_name}},
                                    @endif

                                    @if (!empty($job->country_id))
                                        {{$job->country_name}}
                                    @endif

                                    @if(empty($job->country_id))
                                        Location Information not available.
                                    @endif
                                </span>
                            </li>
                            <li>
                                <h5><i class="fa fa-calendar"></i>{{ __('messages.job.expires_on') }}:</h5>
                                <span>{{ date('jS M, Y', strtotime($job->job_expiry_date)) }}</span>
                            </li>

                            <li>
                                <h5><i class="fa fa-cogs"></i> {{ __('web.job_details.job_skills') }}:</h5>
                                @if($job->jobsSkill->isNotEmpty())
                                    <span>{{html_entity_decode($job->jobsSkill->pluck('name')->implode(', ')) }}</span>
                                @else
                                    <p>N/A</p>
                                @endif
                            </li>

                            @if(!$job->hide_salary)
                                <li>
                                    <h5><i class="fa fa-money"></i> {{ __('web.job_details.salary') }}:</h5>
                                    <span>{{ $job->currency->currency_icon }}</span>
                                    <span>{{ formatCurrency($job->salary_from) . '-' . formatCurrency($job->salary_to) }}</span>
                                    <b>({{ $job->currency->currency_name }})</b>
                                </li>
                            @endif
                        </ul>
                        <h5>{{ __('web.apply_for_job.share_this_job') }}</h5>
                        <ul class="social-btns list-inline mt10">
                            <li>
                                <a href="{{ $url['facebook'] }}"
                                   class="social-btn-roll facebook transparent border-22px" target="_blank">
                                    <div class="social-btn-roll-icons">
                                        <i class="social-btn-roll-icon fa fa-facebook"></i>
                                        <i class="social-btn-roll-icon fa fa-facebook"></i>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $url['gmail'] }}"
                                   class="social-btn-roll google transparent border-22px" target="_blank">
                                    <div class="social-btn-roll-icons">
                                        <i class="social-btn-roll-icon fa fa-google"></i>
                                        <i class="social-btn-roll-icon fa fa-google"></i>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $url['pinterest'] }}"
                                   class="social-btn-roll pinterest transparent border-22px" target="_blank">
                                    <div class="social-btn-roll-icons">
                                        <i class="social-btn-roll-icon fa fa-pinterest"></i>
                                        <i class="social-btn-roll-icon fa fa-pinterest"></i>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $url['twitter'] }}" class="social-btn-roll twitter transparent border-22px"
                                   target="_blank">
                                    <div class="social-btn-roll-icons">
                                        <i class="social-btn-roll-icon fa fa-twitter"></i>
                                        <i class="social-btn-roll-icon fa fa-twitter"></i>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/shareArticle/?url={{ rawurlencode(URL::to('/job-details/'.$job->job_id ))}}"
                                   class="social-btn-roll linkedin transparent border-22px" target="_blank">
                                    <div class="social-btn-roll-icons">
                                        <i class="social-btn-roll-icon fa fa-linkedin"></i>
                                        <i class="social-btn-roll-icon fa fa-linkedin"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        @auth
                            @role('Candidate')
                            @if(!$isApplied && !$isJobApplicationRejected && ! $isJobApplicationCompleted)
                                <div class="mt20">
                                    @if($isActive && !$job->is_suspended && \Carbon\Carbon::today()->toDateString() < $job->job_expiry_date->toDateString())
                                        <button
                                            class="btn {{ $isJobDrafted ? 'btn-red' : 'btn-purple' }} btn-block btn-effect"
                                            onclick="window.location='{{ route('show.apply-job-form', $job->job_id) }}'">
                                            {{ $isJobDrafted ? __('web.job_details.edit_draft') : __('web.job_details.apply_for_job') }}
                                        </button>
                                    @endif
                                </div>
                            @else
                                <div class="mt20">
                                    <p>
                                        <button class="btn btn-green btn-block btn-effect">{{ __('web.job_details.already_applied') }}</button>
                                    </p>
                                </div>
                            @endif
                            @endrole
                        @else
                            @if($isActive && !$job->is_suspended && \Carbon\Carbon::today()->toDateString() < $job->job_expiry_date->toDateString())
                                <div class="mt20">
                                    <button class="btn btn-purple btn-block"
                                            onclick="window.location='{{ route('front.register') }}'">{{ __('web.job_details.register_to_apply') }}
                                    </button>
                                    <button class="btn btn-purple btn-block btn-effect"
                                            onclick="window.location='{{ route('front.candidate.login') }}'">
                                        {{ __('web.job_details.apply_for_job') }}
                                    </button>
                                </div>
                            @endif
                        @endauth
                    </div>
                    <!-- Start of Job Sidebar -->

                    <!-- ===== Start of Company Overview ===== -->
                    <div>
                        <div class="job-sidebar mt20">
                            <h5>{{ __('web.job_details.company_overview') }}</h5>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <a href="{{ route('front.company.details', $job->company->unique_id) }}">
                                        <img src="{{ $job->company->company_url }}"
                                             class="c-company-image company-image"/>
                                    </a>

                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 mt10">
                                    <a href="{{ route('front.company.details', $job->company->unique_id) }}">
                                        <h5 class="text-primary">{{ html_entity_decode($job->company->user->first_name) }}</h5>
                                    </a>
                                    <div class="text-dark c-company-p pt10 pb10">
                                        <i class="fa fa-map-marker"></i>
                                        <span>
                                            @if (!empty($job->company->city_name))
                                                {{$job->company->city_name}} ,
                                            @endif

                                            @if (!empty($job->company->state_name))
                                                {{$job->company->state_name}},
                                            @endif

                                            @if (!empty($job->company->country_name))
                                                {{$job->company->country_name}}
                                            @endif

                                            @if(empty($job->company->country_name))
                                                {{ __('web.job_details.location_information_not_available') }}
                                            @endif
                                        </span>
                                    </div>
                                    <h6>
                                        <a href="{{ route('front.company.details', $job->company->unique_id) }}"><span
                                                    class="label label-info mt20">{{ $jobsCount }} {{ __('web.companies_menu.opened_jobs') }}</span></a>
                                    </h6>
                                    <hr/>
                                    <p>
                                        {!! nl2br($job->company->details) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ===== End of Company Overview ===== -->
                </div>
            </div>
                <!-- End of Row -->

                @auth
                    @role('Candidate')
                    @include('web.jobs.email_to_friend')
                    @include('web.jobs.report_job_modal')
                    @endrole
                @endauth

            @if(count($getRelatedJobs)>0)
                <div class="row mt40 mb30">
                    <div class="col-md-12 text-center">
                        <h3 class="pb5">{{ __('web.job_details.related_jobs') }}</h3>
                    </div>
                </div>
                <!-- Start of Row -->
                <div class="row nomargin job-post-wrapper mt10 d-flex justify-content-center flex-wrap">
                    <!-- Start of Job Post Wrapper -->
                    @if(count($getRelatedJobs)>0)
                        @foreach($getRelatedJobs as $job)
                            @if($job->status != \App\Models\Job::STATUS_DRAFT)
                                @include('web.common.job_card')
                            @endif
                        @endforeach
                        <div class="row full-width-li">
                            <div class="col-md-12 text-center pt30">
                                <a href="{{ route('front.search.jobs') }}"
                                   class="btn btn-purple btn-effect">{{ __('web.common.show_all') }}</a>
                            </div>
                        </div>
                    @else
                        <div class="related-job-not-found">
                            <h5 class="text-center">{{ __('web.job_details.related_job_not_available') }}</h5>
                        </div>
                    @endif
                </div>
            @endif
                    <!-- End of Job Post Wrapper -->
            <!-- End of Row -->

        </div>
    </section>
@endsection
@section('scripts')
    <script>
        let addJobFavouriteUrl = "{{ route('save.favourite.job') }}";
        let reportAbuseUrl = "{{ route('report.job.abuse') }}";
        let emailJobToFriend = "{{ route('email.job') }}";
        let isJobAddedToFavourite = "{{ $isJobAddedToFavourite }}";
        let removeFromFavorite = "{{ __('web.job_details.remove_from_favorite') }}";
        let addToFavorites = "{{ __('web.job_details.add_to_favorite') }}";
    </script>
    <script src="{{ mix('assets/js/jobs/front/job_details.js') }}"></script>
@endsection
