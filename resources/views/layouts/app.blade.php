<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') | {{config('app.name')}} </title>
    <link rel="shortcut icon" href="{{ getSettingValue('favicon') }}" type="image/x-icon">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- General CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/sweetalert.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">
    <link href="{{ asset('assets/css/sweetalert.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- CSS Libraries -->

{{--    <link rel="stylesheet" href="{{ getBrandTypeUrl("favicon") ?? asset('favicon.ico') }}">--}}
@stack('css')
<!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('web/backend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('web/backend/css/components.css')}}">
    <link href="{{ mix('assets/css/infy-loader.css') }}" rel="stylesheet" type="text/css"/>
    {{--    @yield('css')--}}
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>
<body>
<div id="app">
    <div class="infy-loader" id="overlay-screen-lock">
        @include('loader')
    </div>
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            @include('layouts.header')
            @include('user_profile.edit_profile_modal')
            @include('user_profile.change_password_modal')
        </nav>
        <div class="main-sidebar">
            @include('layouts.sidebar')
        </div>
        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
        <footer class="main-footer">
            @include('layouts.footer')
        </footer>
    </div>
</div>
<script src="{{ asset('messages.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>

<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('web/backend/js/stisla.js') }}"></script>
<script src="{{ asset('web/backend/js/scripts.js') }}"></script>
<script src="{{ mix('assets/js/custom/custom.js') }}"></script>
<script>
    (function ($) {
        let currentLocale = "{{ Config::get('app.locale') }}";
        Lang.setLocale(currentLocale);
        $.fn.button = function (action) {
            if (action === 'loading' && this.data('loading-text')) {
                this.data('original-text', this.html()).html(this.data('loading-text')).prop('disabled', true);
            }
            if (action === 'reset' && this.data('original-text')) {
                this.html(this.data('original-text')).prop('disabled', false);
            }
        };
    }(jQuery));
    $(document).ready(function () {
        $('.alert').delay(5000).slideUp(300);
    });
    $('[data-dismiss=modal]').on('click', function (e) {
        var $t = $(this),
            target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];

        $(target).modal("hide");
    });
</script>
@stack('scripts')
<script>
    let profileUrl = "{{ url('admin/profile') }}";
    let profileUpdateUrl = "{{ url('admin/profile-update') }}";
    let updateLanguageURL = "{{ url('update-language')}}";
    let changePasswordUrl = "{{ url('admin/change-password') }}";
    let loggedInUserId = "{{ getLoggedInUserId() }}";
    let currentUrlName = "{{ Request::url() }}";
    let readAllNotifications = "{{ url('admin/read-all-notification') }}";
    let readNotification = "{{ url('admin/notification') }}";
    let ajaxCallIsRunning = false;
</script>
<script src="{{ mix('assets/js/user_profile/user_profile.js') }}"></script>
<script src="{{ asset('js/currency.js') }}"></script>
</body>
</html>
