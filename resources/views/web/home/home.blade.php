<head>
      <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-space-dynamic.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">
</head>
@extends('web.layouts.app')
@section('title')
    {{ __('web.home') }}
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/web-popular-categories.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('web/backend/css/components.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
   
@endsection
@section('content')
    <!-- ===== Start of Main Search Section ===== -->
    @if($settings->value)
        <div class="item">
            <section class="main overlay-black" style="margin-top:-20px;">
                <!-- Start of Wrapper -->
                <div class="container wrapper">
                    <!-- Start of Form -->
                    <form class="job-search-form row pt40" action="{{ route('front.search.jobs') }}"
                          method="get">
                        <!-- Start of keywords input -->
                        <div class="col-md-4 col-sm-12 search-keywords">
                            <label for="search-keywords">{{ __('web.home_menu.keywords') }}</label>
                            <input type="text" name="keywords" id="search-keywords"
                                   placeholder="Job title, skill or company"
                                   autocomplete="off">
                            <div id="jobsSearchResults" class="position-absolute w100"></div>
                        </div>

                        <!-- Start of category input -->
                        <div class="col-md-3 col-sm-12 search-categories">
                            <label for="search-categories">{{ __('web.home_menu.any_category') }}</label>
                            <select name="categories" class="selectpicker" id="search-categories"
                                    data-live-search="true"
                                    title="Any Category" data-size="5">
                                @foreach($jobCategories as $key => $jobCategory)
                                    <option value="{{ $key }}">{{ html_entity_decode($jobCategory) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Start of location input -->
                        <div class="col-md-3 col-sm-12 search-location">
                            <label for="search-location">{{ __('web.common.location') }}</label>
                            <input type="text" name="location" id="search-location" placeholder="Location">
                        </div>

                        <!-- Start of submit input -->
                        <div class="col-md-2 col-sm-12 search-submit">
                            <button type="submit" class="btn btn-purple btn-effect btn-large"><i
                                        class="fa fa-search"></i>{{ __('web.common.search') }}
                            </button>
                        </div>
                    </form>
                    <!-- End of Form -->

                </div>
                <!-- End of Wrapper -->
                @if(count($headerSliders) > 0)
                    <div class="search-middle-image">

                    </div>
                @endif
                @if(count($headerSliders) > 0)
                    <div class="owl-carousel header-image-slider" id="image-search-carousel">
                        @foreach($headerSliders as $headerSlider)
                            <div class="item">
                                <div class="display-text">
                                    <img src="{{ $headerSlider->header_slider_url }}" alt="" class="full-width-height">
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </section>
        </div>
    @endif
   
    
    @if(count($imageSliders) > 0 && $imageSliderActive->value)
        <div class=" {{ ($slider->value == 0) ? 'container' : ' ' }} ">
            <div class="owl-carousel image-slider mt20" id="image-slider-carousel">
                @foreach($imageSliders as $imageSlider)
                    <div class="item">
                        <span class="bg-image"><img src="{{ $imageSlider->image_slider_url }}" alt=""
                                                    class="image-height"></span>
                        <div class="display-text">
                            <img src="{{ $imageSlider->image_slider_url }}" alt=""
                                 class=" {{ ($slider->value == 0) ? 'image-height' : 'full-width-height' }}">
                            @if($imageSlider->description)
                                <div class="content slider-description">
                                    {!! Str::limit($imageSlider->description, 495, ' ...') !!}
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    <!-- ===== End of Main Search Section ===== -->

    <!-- ===== Start of Popular Categories Section ===== -->
    @if(count($categories) > 0)
    <section class="ptb40 custom-pt-40 {{ (($imageSliderActive->value == 0) && ($settings->value == 0)) ? 'mt80' : ''  }} bg-gray"
             id="categories">
        <div class="container">
            <div class="section-title custom-pb-30">
                <h2>{{ __('popular searches of the week') }}</h2>
            </div>
            <div class="row d-flex flex-wrap justify-content-center">
                @foreach($categories as $category)
                    <div class="col-12 col-lg-3 col-md-4 col-sm-6 col-xs-6 mt30 custom-flex-12">
                        <div class="top-categories">
                            <div align="center" class="margin-top">
                                <h4 class="category-name"><a
                                            href="{{ route('front.search.jobs',array('categories'=> $category->id)) }}">
                                        {{ html_entity_decode($category->name) }} <span class="d-inline-flex"> {{ ($category->jobs_count > 0) ? '( '.$category->jobs_count.' )' : '' }}</span>
                                    </a></h4>
                                <br>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    <!-- ===== End of Popular Categories Section ===== -->



    <!-- ===== Start of Job Post Section ===== -->
    @if(count($latestJobs) > 0)
        <section class="ptb80 bg-gray custom-ptb-60" id="job-post">
        <div class="container">
            <!-- Start of Job Post Main -->
            <div class="col-md-12 col-sm-12 col-xs-12 job-post-main">
                <h2 class="capitalize text-center">{{ __('web.home_menu.latest_jobs') }}</h2>
                <!-- Start of Job Post Wrapper -->
                <div class="job-post-wrapper mt40 custom-mt-40">
                    <div class="row justify-content-center d-flex flex-wrap">
                        @if(count($latestJobs) > 0)
                            @if(\Illuminate\Support\Facades\Auth::check() && isset(auth()->user()->country_name) && $latestJobsEnable->value)
                                @if(in_array(auth()->user()->country_name, array_column($latestJobs->toArray(),'country_name')))
                                    @foreach($latestJobs as $job)
                                        @if($job->country_name == auth()->user()->country_name && $job->status != \App\Models\Job::STATUS_DRAFT && $job->status != \App\Models\Job::STATUS_CLOSED)
                                            @include('web.common.job_card')
                                        @endif
                                    @endforeach
                                    <div class="col-md-12 text-center">
                                        <a href="{{ route('front.search.jobs') }}"
                                           class="btn btn-purple btn-effect mt50">{{ __('web.common.browse_all') }}</a>
                                    </div>
                                @else
                                    <div class="related-job-not-found">
                                        <h5 class="text-center">{{ __('web.home_menu.latest_job_not_available') }}</h5>
                                    </div>
                                @endif
                            @else
                                @foreach($latestJobs as $job)
                                    @if($job->status != \App\Models\Job::STATUS_DRAFT && $job->status != \App\Models\Job::STATUS_CLOSED)
                                        @include('web.common.job_card')
                                    @endif
                                @endforeach
                                <div class="col-md-12 text-center">
                                    <a href="{{ route('front.search.jobs') }}"
                                       class="btn btn-purple btn-effect mt50">{{ __('web.common.browse_all') }}</a>
                                </div>
                            @endif
                        @else
                            <div class="related-job-not-found">
                                <h5 class="text-center">{{ __('web.home_menu.latest_job_not_available') }}</h5>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- End of Job Post Wrapper -->
            </div>
            <!-- End of Job Post Main -->
        </div>
    </section>
    @endif
    <!-- ===== End of Job Post Section ===== -->

    <!-- ===== Start of Job Post Section ===== -->
    @if(count($featuredJobs) > 0)
        <section class="pb80 bg-gray custom-pb-15" id="job-post">
        <div class="container">
            <!-- Start of Job Post Main -->
            <div class="col-md-12 col-sm-12 col-xs-12 job-post-main">
                <h2 class="capitalize text-center">{{ __('web.home_menu.featured_jobs') }}</h2>

                <!-- Start of Job Post Wrapper -->
                <div class="job-post-wrapper mt40">
                    <div class="row justify-content-center d-flex flex-wrap">
                            @foreach($featuredJobs as $job)
                                @if($job->status != \App\Models\Job::STATUS_DRAFT && $job->status != \App\Models\Job::STATUS_CLOSED)
                                    @include('web.common.job_card')
                                @endif
                            @endforeach
                    </div>
                </div>
                <!-- End of Job Post Wrapper -->
            </div>
            <!-- End of Job Post Main -->
        </div>
    </section>
    @endif
    <!-- ===== End of Job Post Section ===== -->

    <!-- ===== Start of Featured Companies Section ===== -->
    @if(count($featuredCompanies) > 0)
        <section class="pt40 pb80 bg-gray custom-pb-40 " id="job-post">
        <div class="container">
            <!-- Start of Job Post Main -->
            <div class="col-md-12 col-sm-12 col-xs-12 job-post-main">
                <h2 class="capitalize text-center">{{ __('web.home_menu.featured_companies') }}
                </h2>

                <!-- Start of Job Post Wrapper -->
                <div class="job-post-wrapper mt40 custom-mt-40">
                    <div class="row">
                            @foreach($featuredCompanies as $company)
                                @include('web.common.company_card')
                            @endforeach
                            <div class="col-md-12 text-center">
                                <a href="{{ route('front.company.lists',['is_featured' => true]) }}"
                                   class="btn btn-purple btn-effect mt50">{{ __('web.common.browse_all') }}</a>
                            </div>
                    </div>
                </div>
                <!-- End of Job Post Wrapper -->
            </div>
            <!-- End of Job Post Main -->
        </div>
    </section>
    @endif
    <!-- ===== End of Featured Companies Section ===== -->
   <style>
       #about-1 {
    /*padding-top: 60px;*/
    padding-bottom: 30px;
    border-bottom: 1px solid #ddd;
                }
   </style>
   
           <section id="about-1">
				<div class="container">	
					<!-- Section Title -->	
					<div class="row">
						<div class="col-md-12 titlebar">
							<h1>Some <strong style="color:#428bca;font-size: 35px;">words</strong> about <strong style="color:#428bca;font-size: 36px;">Bizdeedhrsolutionss</strong></h1>
							<p>Bizcareerhub is a new generation employee experience platform that is focused on user experience and simplifying complex workflows. We focus on employee based systems for human resources, payroll, performance, talent management, time and attendance systems amongst others. We believe that our clients need to be successful for us to be successful. This philosophy is portrayed in our staff’s attitude, in the way we are organized and in our approach to delivering our service.</p>
						</div>
					</div>
					<div class="row">
						<!--  About-1 Text -->	
						<div id="about-1-text" class="col-md-12 animated fadeInLeft">	
							<h1> <strong style="color:#428bca;">What we do?</strong> </h1>
							<p>Bizcareerhub deploy HR software for thousands of users comprising large-scale and mid-size companies such as Max Life Insurance, Sewells Group, ASTER DM Healthcare Pvt Ltd, Jet Privilege, Balaji Telefilms, ZIM Shipping, UK Resorts, BBM Acoustics, Brandscape and many more. We assess our client's needs and then provide the right software solutions that will meet those needs while implementing training options that will grow your bottom line.
							</p>
					</div>		
				</div>
					<div class="row">
						<div class="col-md-12 animated fadeInLeft">	
                         <a href="http://bizdeedhrsolutionss.com/" Target=blank class="btn btn-purple btn-effect" role="button">Read More</a>			
                         </div>		
				</div>
			</section>
   <style>
    .parallaxprods {
    background-attachment: fixed !important;
    background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;
    padding:40px 0px;
     }
   </style>
         <section class="parallaxprods">
				<div class="container">	
					<!-- Section Title -->	
					<div class="row">
						<div class="col-md-12 titlebar" style="text-align:center;">
							<h1>Our  <strong style="color:#428bca;">Services</strong></h1>
							<p>Bizdeedhrsolutionss is a comprehensive HR product that caters to the whole lifecycle of an employee. Our products align with the specific needs of your organization. Bizdeedhrsolutionss products are being used by thousands of users across different industries and help manage different HR processes in these industries. </p>
						</div>
					</div>
					<!-- Features Holder -->
					<div class="row">
                    <div class="col-sm-4">
                        	<img class="imagehover" src="https://emportant.com/hr-payroll-demo/img/recruitment.jpg" alt="" style="width:370;height:196">
                            <div class="text" style="text-align:center;"><b>HR OUTSOURCING</b></div>
                    </div>
                    <div class="col-sm-4">
                        	<img class="imagehover" src="https://emportant.com/hr-payroll-demo/img/HRM.jpg" alt="" style="width:370;height:196">
						    <div class="text"style="text-align:center;"><b>FINEST TALENT</b></div>
                    </div>
                    <div class="col-sm-4">
    						<img class="imagehover" src="https://emportant.com/hr-payroll-demo/img/payroll.jpg" alt="" style="width:370;height:196">
						    <div class="text"style="text-align:center;"><b>PAYROLL MANAGEMENT</b></div>
                    </div>
                    </div><br>
                    <div class="row">
                    <div class="col-sm-4">
            				<img class="imagehover" src="https://emportant.com/hr-payroll-demo/img/assignmenttaskmanagement.png" alt="" style="width:370;height:196">
							<div class="text"style="text-align:center;"><b>STATUTORY COMPLIANCE</b></div>
                    </div>
                    <div class="col-sm-4">
                			<img class="imagehover" src="https://emportant.com/hr-payroll-demo/img/timeandattendance.jpg" alt="" style="width:370;height:196">
                            <div class="text"style="text-align:center;"><b>CUSTOMIZED HR SERVICES</b></div>
                    </div>
                    <div class="col-sm-4">
                    		<img class="imagehover" src="https://emportant.com/hr-payroll-demo/img/leavemanagement.jpg" alt="" style="width:370;height:196">
						    <div class="text"style="text-align:center;"><b>PAYMENT OF GRATUITY ACT</b></div>
                    </div>
                    </div>
		     	</section>
		     	
    <!-- ===== Start of CountUp Section ===== -->
    <section class="ptb40 bg-gray" id="countup">
        <div class="container">
            <!-- 1st Count up item -->
            <div class="col-md-3 col-sm-3 col-xs-12">
                <span class="counter text-purple" data-from="0" data-to="{{ $dataCounts['candidates'] }}"></span>
                <h4>{{ __('messages.front_home.candidates') }}</h4>
            </div>

            <!-- 2nd Count up item -->
            <div class="col-md-2 col-sm-3 col-xs-12">
                <span class="counter text-purple" data-from="0" data-to="{{ $dataCounts['jobs'] }}"></span>
                <h4>{{ __('messages.front_home.jobs') }}</h4>
            </div>

            <!-- 3rd Count up item -->
            <div class="col-md-2 col-sm-3 col-xs-12">
                <span class="counter text-purple" data-from="0" data-to="{{ $dataCounts['resumes'] }}"></span>
                <h4>{{ __('Locations') }}</h4>
            </div>

            <!-- 4th Count up item -->
            <div class="col-md-2 col-sm-3 col-xs-12">
                <span class="counter text-purple" data-from="0" data-to="{{ $dataCounts['companies'] }}"></span>
                <h4>{{ __('messages.front_home.companies') }}</h4>
            </div>
            
             <!-- 5th Count up item -->
            <div class="col-md-3 col-sm-3 col-xs-12">
                <span class="counter text-purple" data-from="0" data-to="{{ $dataCounts['companies'] }}"></span>
                <h4>{{ __('Industries') }}</h4>
            </div>
        </div>
    </section>
    <!-- ===== End of CountUp Section ===== -->

    <!-- ===== Start of Testimonial Section ===== -->
    @if(count($testimonials) > 0)
        @include('web.home.testimonials')
    @endif
    <!-- ===== End of Testimonial Section ===== -->

    <!-- ===== Start of Notices Section ===== -->
    @if(count($notices) > 0)
        @include('web.home.notices')
    @endif
    {{--    {{  getCountries()  }}--}}
    <!-- ===== End of Notices Section ===== -->


    <!-- ===== Start of Branding Slider Section ===== -->
    @if(count($branding) > 0)
        <section class="bg-light">
            <div class="container">
                <div class="row">
                    <div class="container">
                        <div class="d-flex justify-content-center">
                            <h2 class="text-center pt40 pb40">{{ __('Brands We Are Associated With') }}</h2>
                        </div>
                        <div class="container-fluid">
                          <div class="col-sm-2">
                              <img src="https://bizcareerhub.com//uploads/branding-sliders/63/whizconsulting.png" width="115" height="50">
                          </div>
                          <div class="col-sm-2">
                              <img src="https://bizcareerhub.com//uploads/branding-sliders/62/igt-solutions.png" width="115" height="50">
                          </div>
                          <div class="col-sm-2">
                              <img src="https://bizcareerhub.com//uploads/branding-sliders/61/ienigizer.png" width="115" height="50">
                          </div>
                          <div class="col-sm-2">
                              <img src="https://bizcareerhub.com//uploads/branding-sliders/60/groupL.png" width="115" height="50">
                          </div>
                          <div class="col-sm-2">
                              <img src="https://bizcareerhub.com//uploads/branding-sliders/80/download.jpg" width="115" height="50">
                          </div>
                           <div class="col-sm-2">
                              <img src="https://bizcareerhub.com//uploads/branding-sliders/58/cse-india.jpg" width="115" height="50">
                          </div>
                        </div><br>
                        <div class="row">
                          <div class="col-sm-2">
                              <img src="https://bizcareerhub.com//uploads/branding-sliders/78/hashtagproperties.jpg" width="180" height="70">
                          </div>
                          <div class="col-sm-2">
                              <img src="https://bizcareerhub.com//uploads/branding-sliders/75/condeco.png" width="145" height="70">
                          </div>
                          <div class="col-sm-2">
                              <img src="https://bizcareerhub.com//uploads/branding-sliders/70/talkcharge.png" width="115" height="50">
                          </div>
                          <div class="col-sm-2">
                              <img src="https://bizcareerhub.com//uploads/branding-sliders/77/indian-security-services.jpg" width="115" height="70">
                          </div>
                          <div class="col-sm-2">
                              <img src="https://bizcareerhub.com//uploads/branding-sliders/76/ihr-ccc.png" width="115" height="100">
                          </div>
                          <div class="col-sm-2">
                              <img src="https://bizcareerhub.com//uploads/branding-sliders/72/bl-india.png" width="115" height="50">
                          </div>
                        </div><br>
                        <div class="row">
                            <div class="col-sm-2">
                              <img src="https://bizcareerhub.com//uploads/branding-sliders/79/prymus.png" width="115" height="50">
                            </div>
                             <div class="col-sm-2">
                              <img src="https://bizcareerhub.com//uploads/branding-sliders/69/rupeek.png" width="140" height="35">
                            </div>
                             <div class="col-sm-2">
                              <img src="https://bizcareerhub.com//uploads/branding-sliders/66/infobirth.png" width="115" height="50">
                            </div>
                             <div class="col-sm-2">
                              <img src="https://bizcareerhub.com//uploads/branding-sliders/73/pagetraffic.png" width="115" height="50">
                            </div>
                             <div class="col-sm-2">
                              <img src="https://bizcareerhub.com//uploads/branding-sliders/67/righteducation.png" width="115" height="70">
                            </div>
                             <div class="col-sm-2">
                              <img src="https://bizcareerhub.com//uploads/branding-sliders/74/shineablinds.png" width="115" height="50">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-sm-2">
                              <img src="https://bizcareerhub.com//uploads/branding-sliders/65/download.jpg" width="115" height="70">
                            </div>
                            <div class="col-sm-2">
                              <img src="https://bizcareerhub.com//uploads/branding-sliders/81/flipkart.png" width="115" height="70">
                            </div>
                            <div class="col-sm-2">
                              <img src="https://bizcareerhub.com//uploads/branding-sliders/82/ng.jpg" width="115" height="70">
                            </div>
                        </div><br>
                        
                        <div class="owl-carousel" id="brandingSlider">
                            @foreach($branding as $brand)
                                <div class="item">
                                    <div class="branding-item">
                                        <!-- Branding slider -->
                                        <div class="text-center branding-item">
                                            <img src="{{ $brand->branding_slider_url }}" alt="Branding Slider"
                                                 data-toggle="tooltip" data-placement="right"
                                                 title="{{ html_entity_decode($brand->title) }}"/>
                                        </div>
                                        <!-- End Branding slider -->
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- ===== End of Branding Slider Section ===== -->
    @if(count($recentBlog) > 0)
        <section class="section pricing-tables ptb40 custom-ptb-20">
            <div class="section-body">
                <div class="col-12">
                    <div class="container d-flex flex-column">
                        <div class="col-md-12 col-sm-12 col-xs-12 mb40 mt15 custom-mb-20">
                            <h2 class="capitalize text-center">{{ __('messages.recent_blog') }}</h2>
                        </div>
                        <div class="card">
                            <div class="card-body overflow-hidden d-flex justify-content-center flex-wrap">
                                @foreach($recentBlog as $post)
                                    <div class="col-sm-6 col-md-6 col-lg-4 h-100 mb-30px mobile-width-100">
                                        <div class="hover-effect-blog position-relative mb-5 border-hover-primary blog-border">
                                            <div class="blog-card-details">
                                                <img class="article-image"
                                                     src="{{ empty($post->blog_image_url) ? asset('assets/img/article-image.png') : $post->blog_image_url }}"
                                                     alt="Blog Article"/>
                                                <div class="mb-auto w-100 blog-category height-280">
                                                    <div class="post-detail-category-badge mt-5 mb-0 web-post-box mt-mobile-0">
                                                        @foreach($post->postAssignCategories as $counter => $category)
                                                            @if($counter < 1)
                                                                <span class="font-size-13px post-badge white-space-normal badge-pill {{ $counter }} badge-primary">{{html_entity_decode($category->name)}}</span>
                                                            @elseif($counter == (count($post->postAssignCategories )) - 1)
                                                                <label class="badge badge-pill badge-warning font-size-13px">{{ "+" . $counter ." "."more"}}</label>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <div class="card-article-title two-line-ellip m-b-10px">
                                                        <a href="{{ route('front.posts.details',$post->id) }}">
                                                            {{ html_entity_decode($post->title) }}</a>
                                                    </div>

                                                    <div class="text-left line-height-20px blog-post-description four-line-ellip">
                                                        {!! !empty($post->description) ? $post->description : __('messages.common.n/a') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="article-footer position-absolute l-0-r-0">
                                                <div class="d-flex justify-content-between">
                                                    <span><img src="{{ $post->user->avatar }}"
                                                               class="thumbnail-rounded front-thumbnail"/> {{ $post->user->full_name }}</span>
                                                    <small><i class="fa fa-clock-o"></i>&nbsp;{{$post->created_at->diffForHumans()}}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- ===== End of Recent Blog Section ===== -->
@endsection
@section('page_scripts')
    <script>
        var availableLocation = [];
        let jobsSearchUrl = "{{ route('get.jobs.search') }}";
        @foreach(getCountries() as $county)
        availableLocation.push("{{ $county  }}");
        @endforeach
    </script>
    <script src="{{mix('assets/js/home/home.js')}}"></script>
@endsection

