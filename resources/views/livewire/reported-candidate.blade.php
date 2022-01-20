<div class="employee-card">
    <div class="row">
        @if(count($reportedCandidates) > 0 || $searchByCandidate != '' || $filterByReportedDate != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchByCandidate" id="searchByCandidate"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($reportedCandidates as $reportedCandidate)
            @include('candidate.reported_candidate.reported_candidate_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchByCandidate)
                        {{ __('messages.candidate.no_reported_candidates_found') }}
                    @else
                        {{ __('messages.candidate.no_reported_candidates_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($reportedCandidates->count() > 0)
                    {{$reportedCandidates->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
