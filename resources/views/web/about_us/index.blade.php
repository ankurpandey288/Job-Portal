@extends('web.layouts.app')
@section('title')
    {{ __('messages.about_us') }}
@endsection
@section('content')
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ __('web.about_us') }}</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="about-us ptb80 custom-ptb-60-30">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <h3 class="text-purple">{{ __('web.about_us') }}</h3>
                    <p class="pt30">{!! getSettingValue('about_us') !!}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="about-process ptb80 custom-ptb-60-30">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="section-title custom-pb-40">
                        <h2>{{ __('web.about_us_menu.how_it_works') }}</h2>
                    </div>
                </div>

                <!-- Start of First Column -->
                <div class="col-md-4 col-xs-12 text-center custom-mb-30">
                    <div class="process-icon">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </div>

                    <h5 class="uppercase text-purple pt20 step-no">{{ __('web.about_us_menu.step_1') }}</h5>
                    <h3 class="pb20">{{ __('web.about_us_menu.register') }}</h3>
                    <p>{{ __('web.about_us_menu.start_by_creating_an_account') }}</p>
                </div>
                <!-- End of First Column -->


                <!-- Start of Second Column -->
                <div class="col-md-4 col-xs-12 text-center custom-mb-30">
                    <div class="process-icon">
                        <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                    </div>

                    <h5 class="uppercase text-purple pt20 step-no">{{ __('web.about_us_menu.step_2') }}</h5>
                    <h3 class="pb20">{{ __('web.about_us_menu.submit_resume') }}</h3>
                    <p>{{ __('web.about_us_menu.fill_out_our_forms_and_submit') }}</p>
                </div>
                <!-- End of Second Column -->


                <!-- Start of Third Column -->
                <div class="col-md-4 col-xs-12 text-center custom-mb-30">
                    <div class="process-icon">
                        <i class="fa fa-money" aria-hidden="true"></i>
                    </div>

                    <h5 class="uppercase text-purple pt20 step-no">{{ __('web.about_us_menu.step_3') }}</h5>
                    <h3 class="pb20">{{ __('web.about_us_menu.start_working') }}</h3>
                    <p>{{ __('web.about_us_menu.start_your_new_career_by_working') }}</p>
                </div>
                <!-- End of Third Column -->

            </div>
        </div>
    </section>

    <section class="ptb80 custom-ptb-60-30" id="faq-page">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="section-title custom-pb-40">
                        <h2>{{ __('web.about_us_menu.frequently_asked_questions') }}</h2>
                    </div>
                </div>

                <!-- Start of Topic 1 -->
                @if(count($faqLists) > 0)
                    @foreach($faqLists as $key => $faqList)
                        <div class="col-lg-12 col-md-10 col-sm-10 col-xs-10 col-xs-offset-1 topic">
                            <!-- Question -->
                            <div class="open">
                                <h6 class="question text-dark">{{ $loop->iteration }}
                                    . {{ html_entity_decode($faqList->title) }}</h6>
                                <i class="fa fa-angle-down hidden-xs"></i>
                            </div>

                            <!-- Answer -->
                            <div class="answer ml-3">
                                <p>{!!  nl2br( $faqList->description) !!}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="faq-not-available">
                        <h5 class="text-center">{{__('web.about_us_menu.faq_not_available')}}.</h5>
                    </div>
            @endif
            <!-- End of Topic 1 -->
            </div>
        </div>
    </section>
@endsection
