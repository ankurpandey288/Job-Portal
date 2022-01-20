<div>
    <div class="section gray padding-bottom-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    @if(count($followers) > 0 || $searchByFollowers != '')
                        <div class="row mb-2 justify-content-end">
                            <div class="col-md-3 mx-width">
                                <input wire:model.debounce.100ms="searchByFollowers" type="search"
                                       id="searchByFollowers"
                                       placeholder="{{ __('web.job_menu.search_followers') }}" class="form-control">
                            </div>
                        </div>
                    @endif
                    @if(count($followers) > 0)
                        <div class="favorite-company-dashboard-box">
                            <div class="row  position-relative">
                                @foreach($followers as $follower)
                                    <div class="col-12 col-sm-6 col-md-6 col-xl-4 favorite-job-details">
                                        <div class="hover-effect-favorite-company position-relative {{ $loop->odd ? 'blue-color' : 'black-color' }} mb-5">
                                            <div class="ribbon float-right {{ ($follower->user->candidate->immediate_available == 1) ? 'ribbon-primary' : 'ribbon-danger' }} favorite-companies-ribbon">
                                                {{ ($follower->user->candidate->immediate_available == 1) ? __('messages.candidate.immediate_available') : __('messages.candidate.not_immediate_available') }}
                                            </div>
                                            <div class="job-listing-details nopadding">
                                                <div class="d-flex job-listing-description position-relative">
                                                    <div class="pl-0 mb-auto float-left follower-avatar">
                                                        <img src="{{ $follower->user->avatar }}"
                                                             class="img-responsive favorite-company-image mr-2">
                                                    </div>
                                                    <div class="mb-auto w-100 favorite-company-data followers-data">
                                                        <h4 class="job-listing-favorite-company d-inline-flex mb-2">
                                                            <a href="{{ route('front.candidate.details', $follower->user->candidate->unique_id) }}"
                                                               class="text-decoration-none" target="_blank">
                                                                {{ (!empty($follower->user->first_name)) ? html_entity_decode($follower->user->full_name) : __('messages.common.n/a')  }}
                                                            </a>
                                                        </h4>
                                                        <h3 class="job-listing-title-favorite-company margin-bottom-5">
                                                            <i class="fas fa-phone-alt"></i>
                                                            @if(!empty($follower->user->phone))
                                                                @if(!empty( $follower->user->region_code.$follower->user->phone))
                                                                    {{ '+'.$follower->user->region_code.' '.$follower->user->phone }}
                                                                @endif
                                                            @else
                                                                {{__('messages.common.n/a')}}
                                                            @endif
                                                        </h3>
                                                        <h3 class="job-listing-title-favorite-company followers-margin job-listing-follower">
                                                            <i class="fas fa-envelope">&nbsp;&nbsp;</i>
                                                            <span data-toggle="tooltip" data-placement="bottom"
                                                                  title="{{$follower->user->email}}">
                                            {{ (!empty($follower->user->email)) ? Str::limit($follower->user->email,19,'...') : __('messages.common.n/a')}}</span>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="float-right my-2">
                                @if($followers->count() > 0)
                                    {{ $followers->links() }}
                                @endif
                            </div>
                        </div>
                        @else
                            <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                                <h5>
                                    @if($searchByFollowers)
                                        {{ __('messages.job.no_followers_found') }}
                                    @else
                                        {{ __('messages.job.no_followers_available') }}
                                    @endif
                                </h5>
                            </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
