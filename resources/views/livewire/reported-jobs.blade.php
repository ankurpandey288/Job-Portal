<div class="employee-card">
    <div class="row">
        @if(count($reportedJobs) > 0 || $searchByReportedJob != '' || $filterReportedDate != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchByReportedJob" id="searchByReportedJob"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($reportedJobs as $reportedJob)
            @include('employer.jobs.reportedJobs_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchByReportedJob)
                        {{ __('messages.job.no_reported_job_found') }}
                    @else
                        {{ __('messages.job.no_job_reported_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($reportedJobs->count() > 0)
                    {{$reportedJobs->links()}}
                @endif
            </div>
        </div>
    </div>
</div>

