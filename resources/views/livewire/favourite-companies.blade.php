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
                    @if(count($favouriteCompanies) > 0 || $searchByFavouriteCompanies != '')
                        <div class="row mb-2 justify-content-end">
                            <div class="col-md-3">
                                <input wire:model.debounce.100ms="searchByFavouriteCompanies" type="search"
                                       id="searchByFavouriteCompanies"
                                       placeholder="{{ __('web.job_menu.search_followings') }}"
                                       class="form-control search-box-placeholder">
                            </div>
                        </div>
                    @endif
                    @if(count($favouriteCompanies) > 0)
                        <div class="favorite-company-dashboard-box">
                            <div class="row  position-relative">
                                @foreach($favouriteCompanies as $favouriteCompany)
                                    <div class="col-12 col-sm-6 col-md-6 col-xl-4 favorite-job-details mb-5">
                                        <div class="hover-effect-favorite-company min-height-200 position-relative {{ $loop->odd ? 'blue-color' : 'black-color' }}">
                                            @if(!empty($favouriteCompany->company->no_of_offices))
                                            <div class="ribbon float-right ribbon-primary favorite-companies-ribbon">
                                                {{  $favouriteCompany->company->no_of_offices .' '. __('messages.company.offices') }}
                                            </div>
                                            @endif
                                            <div class="job-listing-details nopadding">
                                                <div class="d-flex job-listing-description ">
                                                    <div class="pl-0 mb-auto float-left favourite-companies-avatar">
                                                        <img src="{{ $favouriteCompany->company->user->avatar }}"
                                                             class="img-responsive favorite-company-image mr-2">
                                                    </div>
                                                    <div class="mb-auto w-100 favorite-company-data favourite-companies-data">
                                                        <h4 class="job-listing-favorite-company d-inline-flex mb-2">
                                                            {{ (!empty($favouriteCompany->company->user->first_name)) ? $favouriteCompany->company->user->first_name : __('messages.common.n/a')  }}
                                                        </h4>
                                                        <h3 class="job-listing-title-favorite-company margin-bottom-5">
                                                            <i class="fas fa-phone-alt"></i>
                                                            {{ (!empty($favouriteCompany->company->user->phone)) ? '+'.$favouriteCompany->company->user->region_code.' '.$favouriteCompany->company->user->phone  : __('messages.common.n/a') }}
                                                        </h3>
                                                        <h3 class="job-listing-title-favorite-company margin-bottom-5">
                                                            <i class="fas fa-envelope"></i>
                                                            <span data-toggle="tooltip" data-placement="bottom"
                                                                  title="{{$favouriteCompany->company->user->email}}">
                                            {{ (!empty($favouriteCompany->company->user->email)) ? Str::limit($favouriteCompany->company->user->email, 20) : __('messages.common.n/a')}}</span>
                                                        </h3>
                                                        <h3 class="job-listing-title-favorite-company favourite-companies-margin mb-5 two-line-ellip">
                                                            <i class="fas fa-industry"></i> {{ (!empty($favouriteCompany->company->industry->name)) ? $favouriteCompany->company->industry->name : __('messages.common.n/a') }}
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <a title="Delete"
                                               class="btn btn-danger action-btn delete-btn favorite-companies-delete"
                                               data-id="{{$favouriteCompany->id}}"
                                               href="#">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="float-right my-2">
                                @if($favouriteCompanies->count() > 0)
                                    {{ $favouriteCompanies->links() }}
                                @endif
                            </div>
                        </div>
                        @else
                            @if($searchByFavouriteCompanies == null || empty($searchByFavouriteCompanies))
                                <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                                    <h5>{{ __('messages.job.no_following_companies_found') }} </h5>
                                </div>
                            @else
                                <div class="col-lg-12 col-md-12 d-flex justify-content-center mt-4">
                                    <h5>{{ __('messages.job.following_company_not_found') }} </h5>
                                </div>
                            @endif
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
