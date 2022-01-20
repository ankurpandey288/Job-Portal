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
                    @if(count($favouriteJobs) > 0 || $searchByJob != '' || $filterFavouriteJobs != '')
                        <div class="row mb-2 justify-content-end">
                            <div class="col-md-3">
                                {{ Form::select('favourite-jobs', $jobStatus, null, ['class' => 'form-control ','id'=>'favouriteJobsId','placeholder' => 'All', 'wire:model' => "filterFavouriteJobs"]) }}
                            </div>
                            <div class="col-md-3">
                                <input wire:model.debounce.100ms="searchByJob" type="search" id="searchByJob"
                                       placeholder="{{ __('web.job_menu.search_job') }}" class="form-control">
                            </div>
                        </div>
                    @endif
                    @if(count($favouriteJobs) > 0)
                        <div class="dashboard-box-favoutite-job margin-top-0">
                            <div class="content1 with-padding">
                                @foreach($favouriteJobs as $favouriteJob)
                                    <div class="row hover-effect position-relative">
                                        <div class="ribbon float-right favorite-job-ribbon ribbon-{{ \App\Models\Job::STATUS_COLOR[$favouriteJob->job->status] }}">
                                            {{ \App\Models\Job::STATUS[$favouriteJob->job->status] }}
                                        </div>
                                        <div class="col-12 d-flex favorite-job-details my-4">
                                            <div class="job-listing">
                                                <div class="job-listing-details">
                                                    <div class="job-listing-description">
                                                        <h4 class="job-listing-company d-inline-flex">
                                                            {{ html_entity_decode($favouriteJob->job->company->user->first_name) }}
                                                        </h4>
                                                        <h3 class="job-listing-title margin-bottom-5">
                                                            <a href="{{ route('front.job.details',$favouriteJob->job->job_id) }}"
                                                               target="_blank">{{ $favouriteJob->job->job_title }}</a>
                                                        </h3>
                                                        <div class="job-listing-footer">
                                                            <ul>
                                                                @if(!empty($favouriteJob->job->full_location))
                                                                    <li>
                                                                        <i class="fas fa-map-marker-alt"></i>{{ $favouriteJob->job->full_location }}
                                                                    </li>
                                                                @endif
                                                                <li>
                                                                    <i class="far fa-clock"></i> {{ __('web.job_details.date_posted') }}
                                                                    : {{ ($favouriteJob->job->created_at)->diffForhumans()}}
                                                                </li>
                                                                @if($favouriteJob->job->job_expiry_date < Carbon\Carbon::now())
                                                                    <li>
                                                                        <i class="far fa-calendar-times text-danger"></i>
                                                                        {{ __('messages.job.expires_on') }}
                                                                        : {{($favouriteJob->job->job_expiry_date)->format('d M, Y') }}
                                                                    </li>
                                                                @else
                                                                    <li><i class="far fa-calendar-times"></i>
                                                                        {{ __('messages.job.expires_on') }}
                                                                        : {{($favouriteJob->job->job_expiry_date)->format('d M, Y') }}
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="heart-size removeJob" data-id="{{$favouriteJob->id}}"><i
                                                        class="fas fa-heart" data-toggle="tooltip"
                                                        title="{{ __('messages.job.remove_favourite_jobs') }}"></i></span>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="float-right my-5">
                                    @if($favouriteJobs->count() > 0)
                                        {{$favouriteJobs->links() }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        @else
                            @if($searchByJob == null || empty($searchByJob))
                                <div class="col-lg-12 col-md-12 d-flex justify-content-center mt-4">
                                    <h5>{{ __('messages.job.no_favourite_job_found') }} </h5>
                                </div>
                            @else
                                <div class="col-lg-12 col-md-12 d-flex justify-content-center mt-4">
                                    <h5>{{ __('messages.job.favourite_job_not_found') }} </h5>
                                </div>
                            @endif
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
