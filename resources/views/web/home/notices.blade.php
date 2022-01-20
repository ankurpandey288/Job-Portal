<section class="pt40 pb80" id="job-post">
    <div class="container">
        <div class="col-md-12 col-sm-12 col-xs-12 mb20">
            <h2 class="capitalize text-center">{{ __('web.home_menu.notices') }}</h2>
        </div>
        <div class="col-lg-8 offset-lg-2">
            <div style="height: 360px;">
            <marquee direction="down" scrolldelay="200" id="notices">
                @foreach($notices as $notice)
                    <div class="row line-break">
                        <div class="col-md-2 col-sm-2 col-xs-4">
                            <div class="notice_data">
                                <div class="event-date">
                                    {{ date('jS M, Y', strtotime($notice->created_at)) }},
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-8">
                            <div class="ml-5">
                                <span class="font-weight-bold ml-4">{{ html_entity_decode($notice->title) }} | {{ $notice->created_at->diffForHumans() }}<br></span>
                            </div>
                            {!! nl2br(strip_tags($notice->description)) !!}
                        </div>
                    </div>
                    <br>
                    <br>
                @endforeach
            </marquee>
            </div>
        </div>
    </div>
</section>
