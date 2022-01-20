<div class="col-md-8 col-xs-12 job-post-main">
    <div class="search-location pb20 d-flex flex-row">
        <input wire:model.debounce.100ms="searchByLocation" type="text" class="search-job-location p-2 form-control"
               placeholder="Location + Job title" id="searchByLocation" autocomplete="off">
        <button class="p-2 flex-shrink-1 btn btn-orange  btn-medium reset-filter" style="line-height: 42px;">{{ __('web.reset_filter') }}</button>
    </div>
    @if(!empty($searchByLocation))
        <div id="jobsSearchResults" class="position-absolute w100">
            <ul class="d-block position-relative w-100">
                @forelse($jobs as $job)
                    <li>{{ $job->job_title }}</li>
                @empty
                    <li>{{ __('messages.no_keyword_found') }}</li>
                @endforelse
            </ul>
        </div>
    @endif
    @if($jobs->total() > 0)
    <h4>{{ __('web.job_menu.we_found') }} {{ ($jobs->total()) }} {{ __('web.jobs') }}.</h4>
    @endif
    <div class="job-post-wrapper mt20">
        @forelse($jobs as $job)
            <div class="single-job-post row mt20 container-shadow m-sm-2">
                <div class="col-md-1 col-xs-3 nopadding mt5">
                    <div class="job-company">
                        <a href="{{ route('front.company.details',$job->company->unique_id) }}"
                           title="View Company Details">
                            <img src="{{ $job->company->company_url }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-md-8 col-xs-6 ptb5 ml20">
                    <div class="job-title">
                        <a href="{{ route('front.job.details',$job['job_id']) }}" class="hover-color">{{ html_entity_decode($job['job_title']) }} </a>
                        <label class="text-muted">- {{ $job->company->user->first_name }}</label>
                    </div>

                    <div class="job-info">
                        <span class="location nomargin pt10"><i class="fa fa-map-marker"></i>
                            {{ (!empty($job->full_location)) ? $job->full_location : 'Location Info. not available.'}}
                        </span>
                        <br>
                        <span class="company pt10">
                            {!! nl2br(Str::limit($job['description'],120,'...')) !!}  
                        </span>
                    </div>

                </div>
                <div class="col-md-2 col-xs-3 ptb5">
                    <div class="job-category">

                        <div class="job-category pull-left j-category-type">
                            <small class="text-muted font-weight-bolder">{{ __('messages.job.expires_on') }}</small>
                            <br>
                            <span class="font-weight-bolder">{{ date('jS M, Y', strtotime($job->job_expiry_date)) }}</span>
                        </div>
                        @if(!empty($job->jobShift))
                            <div class="job-category pull-left j-category-type">
                                <a href="javascript:void(0)"
                                   class="mt15 btn btn-orange btn-small btn-effect">{{ html_entity_decode($job->jobShift->shift) }}</a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12 text-center">{{ __('web.job_menu.no_results_found') }}</div>
        @endforelse

        @if($jobs->count() > 0)
            {{$jobs->links() }}
        @endif
    </div>
</div>

