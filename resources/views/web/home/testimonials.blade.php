<section class="ptb80 custom-ptb-60" id="testimonials">
    <div class="container-fluid">
        <!-- Section Title -->
        <div class="section-title custom-pb-40">
            <h2 class="text-white text-center">{{ __('web.home_menu.testimonials') }}</h2>
        </div>
        <!-- Start of Owl Slider -->
        <div class="owl-carousel testimonial">
            <!-- Start of Slide item -->
            @foreach($testimonials as $testimonial)
                <div class="item">
                    <div class="review line-break">
                        <blockquote>{!! !empty(nl2br($testimonial->description))?nl2br($testimonial->description) : __('messages.common.n/a') !!}  </blockquote>
                    </div>
                    <div class="customer">
                        @if(!empty($testimonial->customer_image_url))
                            <img src="{{ $testimonial->customer_image_url }}" class="web-testimonial-customer-img image-stretching"
                                 alt="">
                        @else
                            <img src="{{ asset('assets/img/infyom-logo.png') }}"
                                 class="web-testimonial-customer-img thumbnail-preview" alt="">
                        @endif
                        <h4 class="uppercase pt20">{{ html_entity_decode($testimonial->customer_name) }}</h4>
                    </div>
                </div>
        @endforeach
        <!-- End Slide item -->
        </div>
        <!-- End of Owl Slider -->
    </div>
</section>
