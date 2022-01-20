<div class="col-md-6 mt30 {{ ($loop->last && $loop->iteration % 2 != 0) ? 'col-md-offset-3' : '' }}">
    <div class="single-job-post row nomargin container-shadow">
        <div class="col-md-2 col-xs-3 nopadding">
            <img src="{{ $company->company_url }}" class="jobs-company-logo" alt="company logo">
        </div>
        <div class="col-md-10 col-xs-6 pt5 nopadding-right ">
            <div class="job-title">
                <h6 class="text-dark"><a
                            href="{{ route('front.company.details', $company->unique_id) }}" class="hover-color">{!! $company->user->first_name !!}</a>
                </h6>
            </div>
            <div class="job-info pt5 pb5 nopadding-right">
                @if(!empty($company->location))
                    <span class="location">
                        <i class="fa fa-map-marker"></i>
                        {{ (isset($company->location)) ? html_entity_decode(Str::limit($company->location,40,'...')) : __('messages.common.n/a') }} 
                    </span>
                @endif
                <br>
                    @if(!empty($company->website))
                <span class="location websiteText">
                        <i class="fa fa-globe"></i>
                        {{ (isset($company->website)) ? Str::limit($company->website,40,'...') : __('messages.common.n/a') }}
                    </span>
                        @endif
            </div>

        </div>
        @if($company->activeFeatured)
            <img src="{{ asset('web/img/icons8-star-64.png') }}" class="featured-img"
                 data-toggle="tooltip" data-placement="bottom" title="Featured">
        @endif
        
        @if($company->jobs_count > 0)
        <span class="job-count pull-right">
                       {{ $company->jobs_count }} {{ __('web.companies_menu.opened_jobs') }}
            </span>
            @endif
    </div>
</div>
