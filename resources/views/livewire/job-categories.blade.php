<div class="employee-card">
    <div class="row">
        @if(count($jobCategories) > 0 || $filterFeatured != '' || $searchByJobCategory != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchByJobCategory" id="searchByJobCategory"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($jobCategories as $jobCategory)
            @include('job_categories.job_categories_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchByJobCategory)
                        {{ __('messages.job_category.no_job_category_found') }}
                    @else
                        {{ __('messages.job_category.no_job_category_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($jobCategories->count() > 0)
                    {{$jobCategories->links()}}
                @endif
            </div>
        </div>
    </div>
</div>

