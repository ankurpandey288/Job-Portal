@php
    $settings = settings();
@endphp

        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') | {{config('app.name')}} </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Add favicon -->
    <link rel="shortcut icon" href="{{ asset($settings['favicon']) }}" type="image/x-icon">

    <!-- General CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link href="{{ asset('assets/css/sweetalert.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

@stack('css')

<!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('web/backend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('web/backend/css/components.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link href="{{ mix('assets/css/infy-loader.css') }}" rel="stylesheet" type="text/css"/>

</head>
<body class="layout-3">
<div id="app">
    <div class="infy-loader" id="overlay-screen-lock">
        @include('loader')
    </div>
    <div class="main-wrapper container">
    @include('candidate.layouts.header')
    @include('candidate_profile.edit_profile_modal')
    @include('candidate_profile.change_password_modal')

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
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
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
        $('.alert').delay(4000).slideUp(300);
    });
    $('[data-dismiss=modal]').on('click', function (e) {
        var $t = $(this),
            target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];

        $(target).modal("hide");
    });
</script>
@stack('scripts')
<script>
    let profileUrl = "{{ url('candidate/edit-profile') }}";
    let profileUpdateUrl = "{{ url('candidate/edit-profile-update') }}";
    let updateLanguageURL = "{{ url('update-language')}}";
    let changePasswordUrl = "{{ url('candidate/edit-change-password') }}";
    let loggedInUserId = "{{ getLoggedInUserId() }}";
    let readAllNotifications = "{{ url('candidate/read-all-notification') }}";
    let readNotification = "{{ url('candidate/notification') }}";
</script>
<script src="{{ mix('assets/js/candidate_profile/candidate_profile.js') }}"></script>
<script src="{{ asset('js/currency.js') }}"></script>
</body>
</html>
