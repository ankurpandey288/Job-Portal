<div class="employee-card">
    <div class="row">
        @if(count($jobTypes) > 0 || $searchByJobTypes != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchByJobTypes" id="searchByJobTypes"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($jobTypes as $jobType)
            @include('job_types.job_type_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchByJobTypes)
                        {{ __('messages.job_type.no_job_type_found') }}
                    @else
                        {{ __('messages.job_type.no_job_type_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($jobTypes->count() > 0)
                    {{$jobTypes->links()}}
                @endif
            </div>
        </div>
    </div>
</div>

