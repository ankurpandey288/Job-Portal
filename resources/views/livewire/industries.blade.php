<div class="employee-card">
    <div class="row">
        @if(count($industries) > 0 || $searchByIndustryNames != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchByIndustryNames" id="searchByIndustryNames"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($industries as $industry)
            @include('industries.industry_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchByIndustryNames)
                        {{ __('messages.industry.no_industry_found') }}
                    @else
                        {{ __('messages.industry.no_industry_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($industries->count() > 0)
                    {{$industries->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
