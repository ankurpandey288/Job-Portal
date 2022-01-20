@extends('web.layouts.app')
@section('title')
    {{ html_entity_decode($companyDetail->user->full_name) }}
@endsection
@section('content')
    <!-- ===== Start of Candidate Profile Header Section ===== -->
    <section class="profile-header">
    </section>
    <!-- ===== End of Candidate Header Section ===== -->


    <section class="pb80 bg-gray" id="company-profile">
        <div class="container">
            <div class="row company-profile">
                <div class="col-md-3 col-xs-12">
                    <div class="profile-photo company-detail-logo ticket-sender-picture">
                        <img src="{{ (!empty($companyDetail->company_url)) ? $companyDetail->company_url : asset('assets/img/infyom-logo.png') }}"
                             class="img-responsive" alt="">
                    </div>
                    <ul class="social-btns list-inline text-center mt20">
                        @if(isset($companyDetail->user->facebook_url))
                            <li>
                                <a href="{{ (isset($companyDetail->user->facebook_url)) ? $companyDetail->user->facebook_url : 'javascript:void(0)' }}"
                                   class="social-btn-roll facebook transparent" target="_blank">
                                    <div class="social-btn-roll-icons">
                                        <i class="social-btn-roll-icon fa fa-facebook"></i>
                                        <i class="social-btn-roll-icon fa fa-facebook"></i>
                                    </div>
                                </a>
                            </li>
                        @endif
                        @if(isset($companyDetail->user->twitter_url))
                            <li>
                                <a href="{{ (isset($companyDetail->user->twitter_url)) ? $companyDetail->user->twitter_url : 'javascript:void(0)' }}"
                                   class="social-btn-roll twitter transparent" target="_blank">
                                    <div class="social-btn-roll-icons">
                                        <i class="social-btn-roll-icon fa fa-twitter"></i>
                                        <i class="social-btn-roll-icon fa fa-twitter"></i>
                                    </div>
                                </a>
                            </li>
                        @endif
                        @if(isset($companyDetail->user->google_plus_url))
                            <li>
                                <a href="{{ (isset($companyDetail->user->google_plus_url)) ? $companyDetail->user->google_plus_url : 'javascript:void(0)' }}"
                                   class="social-btn-roll google-plus transparent" target="_blank">
                                    <div class="social-btn-roll-icons">
                                        <i class="social-btn-roll-icon fa fa-google-plus"></i>
                                        <i class="social-btn-roll-icon fa fa-google-plus"></i>
                                    </div>
                                </a>
                            </li>
                        @endif
                        @if(isset($companyDetail->user->pinterest_url))
                            <li>
                                <a href="{{ (isset($companyDetail->user->pinterest_url)) ? $companyDetail->user->pinterest_url : 'javascript:void(0)' }}"
                                   class="social-btn-roll pinterest transparent" target="_blank">
                                    <div class="social-btn-roll-icons">
                                        <i class="social-btn-roll-icon fa fa-pinterest"></i>
                                        <i class="social-btn-roll-icon fa fa-pinterest"></i>
                                    </div>
                                </a>
                            </li>
                        @endif
                        @if(isset($companyDetail->user->linkedin_url))
                            <li>
                                <a href="{{ (isset($companyDetail->user->linkedin_url)) ? $companyDetail->user->linkedin_url : 'javascript:void(0)' }}"
                                   class="social-btn-roll linkedin transparent" target="_blank">
                                    <div class="social-btn-roll-icons">
                                        <i class="social-btn-roll-icon fa fa-linkedin"></i>
                                        <i class="social-btn-roll-icon fa fa-linkedin"></i>
                                    </div>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>

                <div class="col-md-9 col-xs-12">
                    <div class="profile-descr">
                        <div class="profile-title">
                            <h2 class="capitalize">{{ html_entity_decode($companyDetail->user->full_name) }}</h2>
                            <h5 class="pt10">{{ $companyDetail->user->email }}</h5>
                        </div>
                        <div class="profile-details mt20">
                            <p>{!! nl2br($companyDetail->details) !!}</p>
                        </div>
                        <ul class="profile-info mt20 nopadding d-flex justify-content-center flex-wrap">
                            @if(!empty($companyDetail->user->city_id) || (!empty($companyDetail->user->state_id)) || (!empty($companyDetail->user->country_id)))
                                <li>
                                    <i class="fa fa-map-marker"></i>
                                    <span>
                                            {{ (!empty($companyDetail->user->city_id)) ? $companyDetail->user->city_name.', ' : '' }}
                                        {{ (!empty($companyDetail->user->state_id)) ? $companyDetail->user->state_name.', ' : '' }}
                                        {{ (!empty($companyDetail->user->country_id)) ? $companyDetail->user->country_name : '' }}
                                        </span>
                                </li>
                            @endif
                            @isset($companyDetail->website)
                                <li>
                                    <i class="fa fa-globe"></i>
                                    <a href="{{ (isset($companyDetail->website)) ?  
                                                    (!str_contains($companyDetail->website,'https://') 
                                                    ? 'https://'.$companyDetail->website
                                                    : $companyDetail->website) 
                                                : 'javascript:void(0)' }}">
                                        {{ (isset($companyDetail->website)) ? preg_replace("(^https?://www.)", "", $companyDetail->website) : 'N/A' }}
                                    </a>
                                </li>
                            @endisset
                            @isset($companyDetail->user->phone)
                                <li>
                                    <i class="fa fa-phone"></i>
                                    <span>{{ (isset($companyDetail->user->phone)) ? $companyDetail->user->phone : 'N/A' }}</span>
                                </li>
                            @endisset
                        </ul>
                        @auth
                            @role('Candidate')
                            <div class="row mt20">
                                <div class="col-md-4">
                                    <div class="company-add-favourite company-web clearfix">
                                        <a href="javascript:void(0)"
                                           class="btn btn-small btn-orange btn-effect"
                                           data-favorite-user-id="{{ (getLoggedInUserId() !== null) ? getLoggedInUserId() : null }}"
                                           data-favorite-company_id="{{ $companyDetail->id }}" id="addToFavourite">
                                            <div class="company-follow-text">
                                                <i class="fa fa-star"></i>
                                                <span class="favouriteText"></span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6 reportJobBtn">
                                    <div class="company-report-web company-web clearfix">
                                        <button class="btn btn-small btn-red btn-effect reportToCompany {{ ($isReportedToCompany) ? 'disabled' : '' }}"
                                                data-toggle="modal"
                                                data-target="#reportToCompanyModal">{{ __('messages.company.report_to_company') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endrole
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt10 pb80 bg-gray" id="job-post">
        <div class="container">
            <div class="row mb30">
                <div class="col-md-12 text-center">
                    <h3 class="pb5">
                        {{ ($jobDetails->count() > 0 ) ? __('web.company_details.our_latest_jobs')  : __('web.home_menu.latest_job_not_available')}}
                    </h3>
                </div>
            </div>
            <!-- Start of Job Post Main -->
            <div class="row nomargin job-post-wrapper mt10">
                @foreach($jobDetails as $job)
                    @if($job->status != \App\Models\Job::STATUS_DRAFT && $job->status != \App\Models\Job::STATUS_CLOSED)
                        @include('web.common.job_card')
                    @endif
                @endforeach
            </div>
            <!-- End of Job Post Main -->
            @if(($jobDetails->count() > 0 ))
                <div class="row mt30">
                    <div class="col-md-12 text-center">
                        <a href="{{ route('front.search.jobs',array('company'=> $companyDetail->id)) }}"
                           class="btn btn-purple btn-effect">{{ __('web.common.show_all') }}</a>
                    </div>
                </div>
            @endif
        </div>
    </section>
    @auth
        @role('Candidate')
        @include('web.company.report_to_company_modal')
        @endrole
    @endauth
@endsection
@section('scripts')
    <script>
        let addCompanyFavouriteUrl = "{{ route('save.favourite.company') }}";
        let isCompanyAddedToFavourite = "{{ $isCompanyAddedToFavourite }}";
        let reportToCompanyUrl = "{{ route('report.to.company') }}";
        let followText = "{{ __('web.company_details.follow') }}";
        let unfollowText = "{{ __('web.company_details.unfollow') }}";

    </script>
    <script src="{{mix('assets/js/custom/input_price_format.js')}}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ mix('assets/js/companies/front/company-details.js') }}"></script>
@endsection
