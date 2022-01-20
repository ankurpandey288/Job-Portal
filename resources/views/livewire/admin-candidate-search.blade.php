<div class="employee-card">
    <div class="row">
        @if(count($candidates) > 0 || $status != '' || $immediateAvailable != '' || $jobSkills != '' || $searchByAdminCandidate != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchByAdminCandidate" id="searchByAdminCandidate"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($candidates as $candidate)
            @include('candidates.candidate_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if($searchByAdminCandidate)
                        {{__('messages.candidate.no_candidate_found')}}
                    @else
                        {{__('messages.candidate.no_candidate_available')}}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($candidates->count() > 0)
                    {{$candidates->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
