<form class="form-inline mr-auto" action="#">
    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
</form>
@php($notifications = getNotification(\App\Models\Notification::ADMIN))
<ul class="navbar-nav navbar-right">
    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                                                 class="nav-link notification-toggle nav-link-lg {{ count($notifications) > 0 ? 'beep' : '' }}"><i
                    class="far fa-bell"></i></a>
        <div class="dropdown-menu dropdown-list dropdown-menu-right" id="notification">
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
                    <div class="empty-state" data-height="250" style="height: 400px;">
                        <div class="empty-state-icon">
                            <i class="fas fa-question"></i>
                        </div>
                        <h2>{{ __('messages.notification.empty_notifications') }}</h2>
                    </div>
                @endif
                <div class="empty-state d-none" data-height="250" style="height: 400px;">
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
                     class="rounded-circle mr-1 thumbnail-rounded user-thumbnail ">
                <div class="d-sm-none d-lg-inline-block">
                    Hi, {{\Illuminate\Support\Facades\Auth::user()->first_name}}</div>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">
                    {{ __('messages.common.welcome') }}, {{\Illuminate\Support\Facades\Auth::user()->full_name}}</div>
                <a class="dropdown-item has-icon editProfileModal" href="#" data-id="{{ getLoggedInUserId() }}">
                    <i class="fa fa-user"></i>{{ __('messages.user.edit_profile') }}</a>
                <a class="dropdown-item has-icon changePasswordModal" href="#" data-id="{{ getLoggedInUserId() }}"><i
                            class="fa fa-lock"> </i>{{ (Str::limit(__('messages.user.change_password'),20,'...')) }}</a>
                <a class="dropdown-item has-icon changeLanguageModal" href="#" data-id="{{ getLoggedInUserId() }}"><i
                            class="fa fa-language"> </i>{{ __('messages.user_language.change_language') }}</a>
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
