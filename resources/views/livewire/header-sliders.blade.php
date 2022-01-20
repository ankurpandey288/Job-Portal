<div class="employee-card">
    <div class="row">
        @forelse($headerSliders as $headerSlider)
            @include('header_sliders.header_sliders_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    {{ __('messages.header_slider.no_header_slider_available') }}
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($headerSliders->count() > 0)
                    {{$headerSliders->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
