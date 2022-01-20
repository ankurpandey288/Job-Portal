<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar mb-0 pb-0">
    <a href="{{ route('front.home') }}" class="navbar-brand sidebar-gone-hide">
        <img src="{{ getLogoUrl() }}" width="70px" class="navbar-brand-full"/>
    </a>
    <div class="navbar-nav">
        <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
    </div>
    @php($notifications = getNotification(\App\Models\Notification::EMPLOYER))
    <ul class="navbar-nav navbar-right ml-auto">
        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                                                     class="nav-link notification-toggle nav-link-lg {{ count($notifications) > 0 ? 'beep' : '' }}"><i
                        class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right notification-div">
                <div class="dropdown-header">{{ __('messages.notification.notifications') }}
                    <div class="float-right">
                        @if(count($notifications) > 0)
                            <a href="#" id="readAllNotification">{{ __('messages.notification.mark_all_as_read') }}
                        @endif
                    </div>
                </div>
                <div class="dropdown-list-content dropdown-list-icons notification-content">
                    @if(count($notifications) > 0)
                        @foreach($notifications as $notification)
                            <a href="#" data-id="{{ $notification->id }}"
                               class="dropdown-item dropdown-item-unread readNotification" id="readNotification">
                                <div class="dropdown-item-icon bg-primary text-white">
                                    <i class="{{ getNotificationIcon($notification->type) }}"></i>
                                </div>
                                <div class="dropdown-item-desc">
                                    {{ $notification->title }}
                                    <div class="time text-primary"><span
                                                class="time notification-for-text badge badge-primary">&nbsp;{{ $notification->notification_for_text }}&nbsp;</span> {{ $notification->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @else
                        <div class="empty-state" data-height="250">
                            <div class="empty-state-icon">
                                <i class="fas fa-question"></i>
                            </div>
                            <h2>{{ __('messages.notification.empty_notifications') }}</h2>
                        </div>
                    @endif
                    <div class="empty-state d-none" data-height="250">
                        <div class="empty-state-icon">
                            <i class="fas fa-question"></i>
                        </div>
                        <h2>{{ __('messages.notification.empty_notifications') }}</h2>
                    </div>
                </div>
            </div>
        </li>
        @if(\Illuminate\Support\Facades\Auth::user())
            <li class="dropdown">
                <a href="#" data-toggle="dropdown"
                   class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <img alt="image" src="{{ getLoggedInUser()->avatar }}"
                         class="rounded-circle mr-1 user-thumbnail">
                    <div class="d-sm-none d-lg-inline-block">
                        {{ __('messages.common.hi') }}, {{\Illuminate\Support\Facades\Auth::user()->first_name}}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-drp">
                    <div class="dropdown-title">
                        {{ __('messages.common.welcome') }}
                        , {{\Illuminate\Support\Facades\Auth::user()->full_name}}</div>
                    <a class="dropdown-item has-icon editProfileModal" href="#" data-id="{{ getLoggedInUserId() }}">
                        <i class="fa fa-user"></i>{{ __('messages.user.edit_profile') }}</a>
                    <a class="dropdown-item has-icon" href="{{ route('front.home') }}">
                        <i class="fa fa-home"></i>{{ __('messages.go_to_homepage') }}</a>
                    <a class="dropdown-item has-icon changePasswordModal" href="#"
                       data-id="{{ getLoggedInUserId() }}"><i
                                class="fa fa-lock"> </i>{{ (Str::limit(__('messages.user.change_password'),20,'...')) }}
                    </a>
                    <a class="dropdown-item has-icon changeLanguageModal" href="#"
                       data-id="{{ getLoggedInUserId() }}"><i
                                class="fa fa-language"> </i>{{ (Str::limit(__('messages.user_language.change_language'),20,'...')) }}
                    </a>
                    <a href="{{ url('logout') }}" class="dropdown-item has-icon text-danger"
                       onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> {{ __('messages.user.logout') }}
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                        {{ csrf_field() }}
                    </form>
                </div>
            </li>
        @else
            <li class="dropdown"><a href="#" data-toggle="dropdown"
                                    class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    {{--                <img alt="image" src="#" class="rounded-circle mr-1">--}}
                    <div class="d-sm-none d-lg-inline-block">{{ __('messages.common.hello') }}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-title">{{ __('messages.common.login') }}
                        / {{ __('messages.common.register') }}</div>
                    <a href="{{ route('login') }}" class="dropdown-item has-icon">
                        <i class="fas fa-sign-in-alt"></i> {{ __('messages.common.login') }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('register') }}" class="dropdown-item has-icon">
                        <i class="fas fa-user-plus"></i> {{ __('messages.common.register') }}
                    </a>
                </div>
            </li>
        @endif
    </ul>
</nav>
<nav class="navbar navbar-secondary navbar-expand-lg">
    <div class="container">
        <ul class="navbar-nav">

            <li class="nav-item {{ Request::is('employer/dashboard*') ? 'active' : ''}}">
                <a href="{{ route('employer.dashboard') }}" class="nav-link"><i
                            class="fab fa-dashcube"></i><span>{{ __('messages.dashboard') }}</span></a>
            </li>
            <li class="nav-item {{ Request::is('employer/company*') ? 'active' : ''}}">
                <a class="nav-link"
                   href="{{ route('company.edit.form', \Illuminate\Support\Facades\Auth::user()->owner_id) }}">
                    <i class="far fa-user-circle"></i>
                    <span>{{ __('messages.employer_menu.employer_profile') }}</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('employer/jobs*') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('job.index') }}">
                    <i class="fas fa-briefcase"></i><span>{{ __('messages.employer_menu.jobs') }}</span></a>
            </li>
            <li class="nav-item {{ Request::is('employer/job-stage*') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('job.stage.index') }}">
                    <i class="fab fa-usps"></i><span>{{ __('messages.job_stages') }}</span></a>
            </li>
            <li class="nav-item {{ Request::is('employer/followers*') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('followers.index') }}">
                    <i class="fab fa-foursquare"></i>
                    <span>{{ __('messages.employer_menu.followers') }}</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('employer/manage-subscriptions*') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('manage-subscription.index') }}">
                    <i class="fa fa-dollar-sign dollar-sign-icon"></i>
                    <span>{{ __('messages.employer_menu.manage_subscriptions') }}</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('employer/transaction*') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('transaction.index') }}">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>{{ __('messages.employer_menu.transactions') }}</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
