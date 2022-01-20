<div class="employee-card">
    <div class="row">
        @if(count($brandingSliders) > 0 || $searchByBrandingSlider != '' || $status != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchByBrandingSlider" id="searchByBrandingSlider"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($brandingSliders as $brandingSlider)
            @include('branding_sliders.branding_slider_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchByBrandingSlider)
                        {{ __('messages.branding_slider.no_branding_slider_found') }}
                    @else
                        {{ __('messages.branding_slider.no_branding_slider_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($brandingSliders->count() > 0)
                    {{$brandingSliders->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
