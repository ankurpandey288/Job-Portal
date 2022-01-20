<div class="employee-card">
    <div class="row">
        @if(count($careerLevels) > 0 || $searchByCareerLevel != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchByCareerLevel" id="searchByCareerLevel"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($careerLevels as $careerLevel)
            @include('career_levels.career_level_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchByCareerLevel)
                        {{ __('messages.career_level.no_career_level_found') }}
                    @else
                        {{ __('messages.career_level.no_career_level_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($careerLevels->count() > 0)
                    {{$careerLevels->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
