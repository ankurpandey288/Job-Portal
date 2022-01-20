<div class="employee-card">
    <div class="row">
        @if(count($jobShifts) > 0 || $searchByJobShifts != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchByJobShifts" id="searchByJobShifts"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($jobShifts as $jobShift)
            @include('job_shifts.job_shifts_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchByJobShifts)
                        {{ __('messages.job_shift.no_job_shifts_found') }}
                    @else
                        {{ __('messages.job_shift.no_job_shifts_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($jobShifts->count() > 0)
                    {{$jobShifts->links()}}
                @endif
            </div>
        </div>
    </div>
</div>

