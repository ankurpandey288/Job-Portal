    @extends('web.layouts.app')
@section('title')
    {{ __('web.job_menu.search_job') }}
@endsection
@section('css')
    <link href="{{ asset('assets/css/ion.rangeSlider.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('page_css')
    @if(\Illuminate\Support\Facades\App::getLocale() == 'ar')
        <style>
            .job-post-wrapper ul.pagination {
                direction: rtl;
            }
        </style>
    @endif
    <style>
        .job-post-wrapper ul.pagination {
            margin-top: 30px !important;
        }
    </style>
@endsection
@section('content')
    <!-- =============== Start of Page Header 1 Section =============== -->
    <section class="page-header">
        <div class="container">
            <!-- Start of Page Title -->
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ __('web.job_menu.search_job') }}</h2>
                </div>
            </div>
            <!-- End of Page Title -->
        </div>
    </section>
    <section class="search-jobs ptb60 bg-gray custom-pb-40" id="version2">
        <div class="container">

            <!-- Start of Row -->
            <div class="row">

                <!-- ===== Start of Job Sidebar ===== -->
                <div class="col-sm-12">
                    <a class="btn btn-primary mb-2" data-toggle="collapse" href="#search-jobs-filter" role="button"
                       id="collapseBtn" aria-expanded="false" aria-controls="search-jobs-filter">
                        <i class="fa fa-filter"></i>
                    </a>
                </div>
                <div class="collapse" id="search-jobs-filter">
                    <!-- Search Location -->
                    <div class="col-md-4 col-xs-12 job-post-sidebar">
                        <!-- Job Types -->
                        <div class="job-types">
                            @if($jobTypes->isNotEmpty())
                                <h4>{{ __('web.job_menu.type') }}</h4>
                                <ul class="mt20">
                                    @foreach($jobTypes as $jobType)
                                        @if($jobType->jobs_count > 0)
                                            <li>
                                                <input type="checkbox" class="jobType" name="job-type"
                                                       id="{{ $jobType->id }}"
                                                       value="{{ $jobType->id }}">
                                                @if(Str::length($jobType->name) < 50)
                                                    <label for="{{ $jobType->id }}">{{ html_entity_decode($jobType->name)}} {{ ($jobType->jobs_count > 0)? '('.$jobType->jobs_count.')':'' }}</label>
                                                @else
                                                    <label for="{{ $jobType->id }}" data-toggle="tooltip"
                                                           data-placement="bottom"
                                                           title="{{$jobType->name}}">{{ html_entity_decode(Str::limit($jobType->name,50,'...')) }}</label>
                                                @endif
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                      
                        <!-- Job Types -->
                        <div class="job-categories mt30">
                            <h4 class="pb20">{{ __('web.post_menu.categories') }}</h4>
                            @if($jobCategories->isNotEmpty())
                                <select id="searchCategories" class="selectpicker" name="search-categories"
                                        title="Any Category" data-size="5" data-live-search="true">
                                    <option value="" class="select-dropdown-option">{{ __('web.job_menu.none') }}</option>
                                    @foreach($jobCategories as $key => $value)
                                        <option class="select-dropdown-option" value="{{ $key }}" {{ (request()->get('categories') == $key) ? 'selected' : '' }}>
                                            {{ html_entity_decode($value) }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                        </div>

                        <div class="job-categories mt30">
                            <h4 class="pb20">{{ __('messages.candidate.candidate_skill') }}</h4>
                            @if($jobSkills->isNotEmpty())
                                <select id="searchSkill" class="selectpicker" name="search-skills"
                                        title="Any Skill" data-size="5" data-live-search="true">
                                    <option value="" class="select-dropdown-option">{{ __('web.job_menu.none') }}</option>
                                    @foreach($jobSkills as $key => $value)
                                        <option value="{{ $key }}" class="select-dropdown-option">{{ html_entity_decode($value) }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>

                        <div class="job-categories mt30">
                            <h4 class="pb20">{{ __('messages.candidate.gender') }}</h4>
                            <select id="searchGender" class="form-control selectpicker" name="search-gender"
                                    title="Any Gender" data-size="5" data-live-search="true">
                                <option value="" class="select-dropdown-option">{{ __('web.job_menu.none') }}</option>
                                @foreach($genders as $key => $value)
                                    <option value="{{ $key }}" class="select-dropdown-option">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="job-categories mt30">
                            <h4 class="pb20">{{ __('messages.job.career_level') }}</h4>
                            @if($careerLevels->isNotEmpty())
                                <select id="searchCareerLevel" class="form-control selectpicker"
                                        name="search-career-level"
                                        title="Any Career Level" data-size="5" data-live-search="true">
                                    <option value="" class="select-dropdown-option">{{ __('web.job_menu.none') }}</option>
                                    @foreach($careerLevels as $key => $value)
                                        <option class="select-dropdown-option" value="{{ $key }}">{{ html_entity_decode($value) }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>

                        <div class="job-categories mt30">
                            <h4 class="pb20">{{ __('messages.job.functional_area') }}</h4>
                            @if($functionalAreas->isNotEmpty())
                                <select id="searchFunctionalArea" class="form-control selectpicker"
                                        name="search-functional-area"
                                        title="Any Functional Area" data-size="5" data-live-search="true">
                                    <option value="" class="select-dropdown-option">{{ __('web.job_menu.none') }}</option>
                                    @foreach($functionalAreas as $key => $value)
                                        <option value="{{ $key }}" class="select-dropdown-option">{{ html_entity_decode($value) }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>

                        <!-- Job Types -->
                        <div class="job-types mt30">
                            <ul>
                                <label class="text-dark">{{ __('web.job_menu.salary_from') }}:</label>
                                <li class="full-width-li">
                                    <input type="text" id="salaryFrom">
                                </li>
                                <label class="text-dark mt10">{{ __('web.job_menu.salary_to') }}:</label>
                                <li class="full-width-li">
                                    <input type="text" id="salaryTo">
                                </li>
                                <label class="text-dark mt10">{{ __('messages.candidate.experience') }}:</label>
                                <li class="full-width-li">
                                    <input type="text" id="jobExperience">
                                </li>
                            </ul>
                        </div>

                        <!-- Advertisment -->
                        <div class="job-advert mt30">
                            <img src="{{ isset($advertise_image->value)?$advertise_image->value: asset('assets/img/infyom-logo.png')}}"
                                 class="img-responsive" alt="">
                        </div>
                    </div>
                </div>
                @livewire('job-search')
            </div>
            <!-- End of Row -->

        </div>
    </section>

@endsection
@section('page_scripts')
@endsection
@section('scripts')
    <script>
        $('.selectpicker').selectpicker({
            dropupAuto: false,
        });
        let input = JSON.parse('@json($input)');
    </script>
    <script src="{{ asset('assets/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ mix('assets/js/jobs/front/job_search.js') }}"></script>
@endsection
