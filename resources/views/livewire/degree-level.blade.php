<div class="employee-card">
    <div class="row">
        @if(count($degreeLevels) > 0 || $searchByDegreeLevel != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchByDegreeLevel" id="searchByDegreeLevel"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($degreeLevels as $degreeLevel)
            @include('required_degree_levels.required_degree_level_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchByDegreeLevel)
                        {{ __('messages.required_degree_level.no_degree_level_found') }}
                    @else
                        {{ __('messages.required_degree_level.no_degree_level_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($degreeLevels->count() > 0)
                    {{$degreeLevels->links()}}
                @endif
            </div>
        </div>
    </div>
</div>

