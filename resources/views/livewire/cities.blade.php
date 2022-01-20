<div class="employee-card">
    <div class="row">
        @if(count($cities) > 0 || $searchByCity != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchByCity" id="searchByCity"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($cities as $city)
            @include('cities.city_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchByCity)
                        {{ __('messages.city.no_city_found') }}
                    @else
                        {{ __('messages.candidate.no_city_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($cities->count() > 0)
                    {{$cities->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
