<aside id="sidebar-wrapper">
    <div class="sidebar-brand admin-sidebar-brand">
        <a href="{{ url('/') }}">
            <img src="{{ getLogoUrl() }}" width="100px" class="navbar-brand-full"/>
        </a>
        <div class="input-group px-3">
            <input type="text" class="form-control searchTerm" id="searchText" placeholder="Search Menu"
                   autocomplete="off">
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fas fa-search search-sign"></i>
                    <i class="fas fa-times close-sign"></i>
                </div>
            </div>
            <div class="no-results mt-3 ml-1">No matching records found</div>
        </div>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ url('/') }}" class="small-sidebar-text">
            <img class="navbar-brand-full" src="{{ getLogoUrl() }}" alt="{{config('app.name')}}"/>
        </a>
    </div>
    <ul class="sidebar-menu mt-3">
{{--        <ul class="sidebar-menu ">--}}
            <li class="side-menus {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa fa-digital-tachograph"></i>
                    <span>{{ __('messages.dashboard') }}</span></a></li>
{{--        </ul>--}}
        <li class="nav-item dropdown side-menus">
            <a class="nav-link has-dropdown" href="#"><i class="fas fa-user-tie"></i>
                <span>{{ __('messages.employers') }}</span>
            </a>
            <ul class="dropdown-menu side-menus">
                <li class="side-menus {{ Request::is('admin/companies*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('company.index') }}">
                        <i class="fas fa-user-friends"></i>
                        <span>{{ __('messages.employers') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/reported-company*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('reported.companies') }}">
                        <i class="fas fa-file-signature"></i>
                        <span> {{ __('messages.company.reported_employers') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item dropdown side-menus">
            <a class="nav-link has-dropdown" href="#"><i class="fas fa-users"></i>
                <span>{{ __('messages.candidates') }}</span>
            </a>
            <ul class="dropdown-menu side-menus">
                <li class="side-menus {{ Request::is('admin/candidates*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('candidates.index') }}">
                        <i class="fas fa-user-circle"></i>
                        <span>{{ __('messages.candidates') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/required-degree-level*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('requiredDegreeLevel.index') }}">
                        <i class="fas fa-user-graduate"></i>
                        <span>{{ __('messages.required_degree_levels') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/reported-candidate*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('reported.candidates') }}">
                        <i class="fas fa-file-signature"></i>
                        <span>{{ __('messages.candidate.reported_candidates') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/resumes*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('resumes.index') }}">
                        <i class="fas fa-file-pdf"></i>
                        <span>{{ __('messages.all_resumes') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/selected-candidate*') ? 'active' : ''  }}">
                    <a class="nav-link" href="{{ route('selected.candidate') }}">
                        <i class="fas fa-user-check"></i>
                        <span>{{ __('messages.selected_candidate') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item side-menus dropdown">
            <a class="nav-link has-dropdown" href="#"><i class="fas fa-briefcase"></i>
                <span>{{ __('messages.jobs') }}</span>
            </a>
            <ul class="dropdown-menu side-menus">
                <li class="side-menus {{ Request::is('admin/jobs*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.jobs.index') }}">
                        <i class="fas fa-briefcase"></i>
                        <span>{{ __('messages.jobs') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/job-categories*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('job-categories.index') }}">
                        <i class="fas fa-sitemap"></i>
                        <span>{{ __('messages.job_categories') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/job-types*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('jobType.index') }}">
                        <i class="fas fa-list-alt"></i>
                        <span>{{ __('messages.job_types') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/job-tags*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('jobTag.index') }}">
                        <i class="fas fa-tags"></i>
                        <span>{{ __('messages.job_tags') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/job-shifts*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('jobShift.index') }}">
                        <i class="fas fa-clock"></i>
                        <span>{{ __('messages.job_shifts') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/reported-jobs*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('reported.jobs') }}">
                        <i class="fab fa-r-project"></i>
                        <span>{{ __('messages.reported_jobs') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/job-notification*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('job-notification.index') }}">
                        <i class="fas fa-envelope-open-text"></i>
                        <span>{{ __('messages.job_notification.job_notifications') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item side-menus dropdown">
            <a class="nav-link has-dropdown" href="#"><i class="fab fa-usps"></i>
                <span>{{ __('messages.post.blog') }}</span>
            </a>
            <ul class="dropdown-menu side-menus">
                <li class="side-menus {{ Request::is('admin/post-categories*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('post-categories.index') }}">
                        <i class="far fa-list-alt"></i>
                        <span> {{ __('messages.post_category.post_categories') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/posts*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('posts.index') }}">
                        <i class="fas fa-blog"></i>
                        <span> {{ __('messages.post.posts') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item side-menus dropdown">
            <a class="nav-link has-dropdown" href="#"><i class="fas fa-solar-panel"></i>
                <span>{{ __('messages.plan.subscriptions') }}</span>
            </a>
            <ul class="dropdown-menu side-menus">
                <li class="side-menus {{ Request::is('admin/plans*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('plans.index') }}">
                        <i class="fab fa-bandcamp"></i>
                        <span>{{ __('messages.subscriptions_plans') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/transactions*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('transactions.index') }}">
                        <i class="fas fa-money-bill-wave"></i>
                        <span>{{ __('messages.transactions') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="side-menus {{ Request::is('admin/subscribers*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('subscribers.index') }}">
                <i class="fas fa-bell"></i>
                <span>{{ __('messages.subscribers') }}</span>
            </a>
        </li>
        <li class="nav-item side-menus dropdown">
            <a class="nav-link has-dropdown" href="#"><i class="fas fa-globe-americas"></i>
                <span>{{ __('messages.country.countries') }}</span>
            </a>
            <ul class="dropdown-menu side-menus">
                <li class="side-menus {{ Request::is('admin/countries*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('countries.index') }}">
                        <i class="fas fa-globe-americas"></i>
                        <span>{{ __('messages.country.countries') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/states*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('states.index') }}">
                        <i class="fas fa-flag"></i>
                        <span>{{ __('messages.state.states') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/cities*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('cities.index') }}">
                        <i class="fas fa-city"></i>
                        <span>{{ __('messages.city.cities') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item dropdown side-menus">
            <a class="nav-link has-dropdown" href="#"><i class="fas fa-cogs"></i>
                <span>{{ __('messages.general') }}</span>
            </a>
            <ul class="dropdown-menu side-menus">
                <li class="side-menus {{ Request::is('admin/marital-status*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('maritalStatus.index') }}">
                        <i class="fas fa-life-ring"></i>
                        <span>{{ __('messages.marital_statuses') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/skills*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('skills.index') }}">
                        <i class="fas fa-clipboard-list"></i>
                        <span>{{ __('messages.skills') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/salary-periods*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('salaryPeriod.index') }}">
                        <i class="fas fa-calendar-alt"></i>
                        <span>{{ __('messages.salary_periods') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/industries*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('industry.index') }}">
                        <i class="fas fa-landmark"></i>
                        <span>{{ __('messages.industries') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/company-sizes*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('companySize.index') }}">
                        <i class="fas fa-list-ol"></i>
                        <span>{{ __('messages.company_sizes') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/functional-area*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('functionalArea.index') }}">
                        <i class="fas fa-chart-pie"></i>
                        <span>{{ __('messages.functional_areas') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/career-levels*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('careerLevel.index') }}">
                        <i class="fas fa-level-up-alt"></i>
                        <span>{{ __('messages.career_levels') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/salary-currencies*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('salaryCurrency.index') }}">
                        <i class="fas fa-money-bill"></i>
                        <span>{{ __('messages.salary_currencies') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/ownership-types*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('ownerShipType.index') }}">
                        <i class="fas fa-universal-access"></i>
                        <span>{{ __('messages.ownership_types') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/languages*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('languages.index') }}">
                        <i class="fas fa-language"></i>
                        <span>{{ __('messages.languages') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item dropdown side-menus">
            <a class="nav-link has-dropdown" href="#"><i class="fas fa-users-cog"></i>
                <span>{{ __('messages.cms') }}</span>
            </a>
            <ul class="dropdown-menu side-menus">
                <li class="side-menus {{ Request::is('admin/testimonials*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('testimonials.index') }}">
                        <i class="fas fa-sticky-note"></i>
                        <span>{{ __('messages.testimonials') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/branding-sliders*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('branding.sliders.index') }}">
                        <i class="far fa-clone"></i>
                        <span>{{ __('messages.branding_sliders') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/header-sliders*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('header.sliders.index') }}">
                        <i class="far fa-image"></i>
                        <span>{{ __('messages.header_sliders') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/image-sliders*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('image-sliders.index') }}">
                        <i class="far fa-images"></i>
                        <span>{{ __('messages.image_sliders') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/noticeboards*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('noticeboards.index') }}">
                        <i class="fas fa-clipboard"></i>
                        <span>{{ __('messages.noticeboards') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/faqs*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('faqs.index') }}">
                        <i class="fas fa-question-circle"></i>
                        <span> {{ __('messages.faq.faq') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/inquires*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('inquires.index') }}">
                        <i class="fab fa-linkedin"></i>
                        <span> {{ __('messages.inquires') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/notification-settings*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('notification.settings.index') }}">
                        <i class="fas fa-compass"></i>
                        <span>{{ __('messages.setting.notification_settings') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/privacy-policy*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('privacy.policy.index') }}">
                        <i class="fas fa-user-secret"></i>
                        <span>{{ __('messages.setting.privacy_policy') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/front-settings*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('front.settings.index') }}">
                        <i class="fas fa-cog"></i>
                        <span>{{ __('messages.setting.front_settings') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/translation-manager*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('translation-manager.index') }}">
                        <i class="fas fa-language"></i>
                        <span>{{ __(__('messages.translation_manager')) }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/email-template*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('email.template.index') }}">
                        <i class="fas fa-envelope"></i>
                        <span>{{ __(__('messages.email_templates')) }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/settings*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('settings.index') }}">
                        <i class="fas fa-sliders-h"></i>
                        <span>{{ __('messages.settings') }}</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ mix('assets/js/sidebar_menu_search/sidebar_menu_search.js') }}"></script>
