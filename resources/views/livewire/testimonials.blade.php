<div class="employee-card">
    <div class="row">
        @if(count($testimonials) > 0 || $searchByTestimonial != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchByTestimonial" id="searchByTestimonial"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($testimonials as $testimonial)
            @include('testimonial.testimonial-card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchByTestimonial)
                        {{ __('messages.testimonial.no_testimonial_found') }}
                    @else
                        {{ __('messages.testimonial.no_testimonial_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($testimonials->count() > 0)
                    {{$testimonials->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
