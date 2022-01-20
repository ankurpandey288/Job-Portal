<div class="container">
    <!-- Start of Form -->
    <div class="row mt30 w-75">
        <div class="col-md-offset-3 col-9 col-lg-8 job-seeker-search">
            <div class="row">
                <div class="col-md-6 col-xs-12 mt10">
                    <input wire:model.debounce.100ms="searchByCandidate" type="text"
                           id="searchByCandidate"
                           placeholder="Search" class="form-control">
                </div>
                <div class="col-md-4 col-xs-6 mt10">
                    <select class="form-control" id="searchBy" wire:model="searchBy">
                        <option value="byJobTitle">By Job Title</option>
                        <option value="byName">By Name</option>
                    </select>
                </div>
                <div class="col-md-2 col-xs-2 mt10">
                    <button type="button" wire:click="resetFilter()" class="btn btn-orange btn-effect" style="line-height: 37px;"
                            id="btnReset">{{ __('web.reset_filter') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Start of Row -->
    <div class="row mt30 w-75">
        <div class="col-3 col-lg-3">
            <div class="sidebar-widget">
                <div class="range-inputs">
                    <input class="form-control search-by-location" type="text" placeholder="Search By Location"
                           name="min"
                           wire:model="location">
                </div>
            </div>
            <div class="sidebar-widget mt20">
                <h3>{{ __('messages.candidate.expected_salary') }}</h3>
                <div class="range-widget">
                    <div class="range-inputs">
                        <input type="text" placeholder="Min" name="min" wire:model="min">
                        <input type="text" placeholder="Max" name="max" wire:model="max">
                    </div>
                </div>
                <small>{{ __('messages.candidate.salary_per_month') }}</small>
            </div>
            <div class="sidebar-widget mt30">
                <h3>{{ __('messages.candidate.gender') }}</h3>
                <div class="radio ml20">
                    <input class="with-gap" type="radio" name="gender" id="All" value="all" 
                           wire:click="changeFilter('gender','all')" wire:model="gender">
                    <label for="All"><span class="radio-label"></span>{{ __('messages.common.all') }}</label>
                </div>
                <div class="radio ml20">
                    <input class="with-gap" type="radio" name="gender" id="Male" value="male" 
                           wire:click="changeFilter('gender','male')" wire:model="gender">
                    <label for="Male"><span class="radio-label"></span>{{ __('messages.common.male') }}</label>
                </div>
                <div class="radio ml20">
                    <input class="with-gap" type="radio" name="gender" id="Female" value="female" 
                           wire:click="changeFilter('gender','female')" wire:model="gender">
                    <label for="Female"><span class="radio-label"></span>{{ __('messages.common.female') }}</label>
                </div>
            </div>
        </div>

        <!-- Start of Candidate Main -->

        <div class="col-9 col-lg-8 candidate-main">

            <div wire:loading wire:loading.class="col-md-12 text-center  font-weight-blod proceesing">
                {{ __('web.company_details.processing') }}
            </div>
            <!-- Start of Candidates Wrapper -->
            <div class="candidate-wrapper">

                <!-- ===== Start of Single Candidate 1 ===== -->
                <div class="row mt10">
                    @forelse($candidates as $candidate)
                        <div class="single-candidate  col-md-6 col-xs-12 mb20 ">
                            <div class="d-flex">
                                <!-- Candidate Image -->
                                <div class="candidate-img">
                                    <a href="{{ route('front.candidate.details',$candidate->unique_id) }}">
                                        <img src="{{ $candidate->candidate_url }}" class="img-responsive" alt="">
                                    </a>
                                </div>
                                <!-- Start of Candidate Name & Info -->
                                <div class="pl-1">
                                    <!-- Candidate Name -->
                                    <div class="candidate-name">
                                        <a href="{{ route('front.candidate.details',$candidate->unique_id) }}" class="hover-color">
                                            <h5>{{ html_entity_decode($candidate->user->full_name) }}</h5></a>
                                    </div>
                                    <div>
                                        <span>
                                            @if(!empty($candidate->expected_salary))
                                                <i class="fa fa-money"></i> {{ $candidate->expected_salary }}
                                            @endif
                                        </span>
                                    </div>
                                    <div>
                                        <span>
                                            @if($candidate->full_location != 'N/A' &&  !empty($candidate->full_location))
                                                <i class="fa fa-map-marker"></i> {{ Str::limit($candidate->full_location,25,'..') }}
                                            @endif
                                        </span>
                                    </div>
                                    <div>
                                         <span>
                                        @if(!empty($candidate->industry))
                                                 <i class="fa fa-briefcase"></i> {{ $candidate->industry->name }}
                                             @endif
                                        </span>
                                    </div>
                                </div>
                                <!-- End of Candidate Name & Info -->
                            </div>

                        </div>
                    @empty
                        <div class="col-md-12">
                            <h5 class="text-black text-center">{{ __('web.candidates_menu.no_candidates_found') }}</h5>
                        </div>
                    @endforelse
                </div>


                <!-- ===== End of Single Candidate 1 ===== -->

            </div>
            @if($candidates->count() > 0)
                {{$candidates->links()}}
            @endif
        </div>

        <!-- End of Candidate Main -->

    </div>
    <!-- End of Row -->

</div>
