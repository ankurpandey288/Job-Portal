<div class="employee-card">
    <div class="row">
        @if(count($functionalAreas) > 0 || $searchByFunctionalAreaName != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchByFunctionalAreaName"
                                   id="searchByFunctionalAreaName"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($functionalAreas as $functionalArea)
            @include('functional_areas.functional_area_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchByFunctionalAreaName)
                        {{ __('messages.functional_area.no_functional_area_found') }}
                    @else
                        {{ __('messages.functional_area.no_functional_area_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($functionalAreas->count() > 0)
                    {{$functionalAreas->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
