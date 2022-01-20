<div class="employee-card">
    <div class="row">
        @if(count($jobTags) > 0 || $searchByJobTags != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchByJobTags" id="searchByJobTags"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($jobTags as $jobTag)
            @include('job_tags.job_tags_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchByJobTags)
                        {{ __('messages.job_tag.no_job_tag_found') }}
                    @else
                        {{ __('messages.job_tag.no_job_tag_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($jobTags->count() > 0)
                    {{$jobTags->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
