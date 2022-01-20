<div class="employee-card">
    <div class="row">
        @forelse($imageSliders as $imageSlider)
            @include('image_sliders.image_slider_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    {{ __('messages.image_slider.no_image_slider_available') }}
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($imageSliders->count() > 0)
                    {{$imageSliders->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
