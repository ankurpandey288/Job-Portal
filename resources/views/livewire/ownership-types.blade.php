<div class="employee-card">
    <div class="row">
        @if(count($ownershipTypes) > 0 || $searchByOwnershipType != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchByOwnershipType" id="searchByOwnershipType"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($ownershipTypes as $ownershipType)
            @include('ownership_types.ownership_type_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchByOwnershipType)
                        {{ __('messages.ownership_type.no_ownership_type_found') }}
                    @else
                        {{ __('messages.ownership_type.no_ownership_type_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($ownershipTypes->count() > 0)
                    {{$ownershipTypes->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
