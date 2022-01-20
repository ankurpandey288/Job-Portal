<div class="employee-card">
    <div class="row">
        @if(count($countries) > 0 || $searchCountries != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchCountries" id="searchCountries"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($countries as $country)
            @include('countries.country_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchCountries)
                        {{ __('messages.country.no_country_found') }}
                    @else
                        {{ __('messages.country.no_country_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($countries->count() > 0)
                    {{$countries->links()}}
                @endif
            </div>
        </div>
    </div>
</div>

