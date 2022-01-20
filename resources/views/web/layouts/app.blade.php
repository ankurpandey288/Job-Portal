@php
    $settings  = settings();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Mobile viewport optimized -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">

    <!-- Meta Tags - Description for Search Engine purposes -->
    <meta name="description" content="{{config('app.name')}}">
    <meta name="keywords"
          content="{{config('app.name')}}">
    <link rel="shortcut icon" href="{{ asset($settings['favicon'])}}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Website Title -->
    <title>BizCareerHub</title>

    <!-- Google Fonts -->
    <link href="//fonts.googleapis.com/css?family=Raleway:300,400,400i,700,800|Varela+Round" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">

    <!-- CSS links -->
    <link rel="stylesheet" type="text/css" href="{{ asset('web/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/css/custom.css') }}">
    <link rel="stylesheet" href="{{ mix('assets/css/flex.css') }}">
    <link rel="stylesheet" href="{{ mix('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ mix('assets/css/custom-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">
    @livewireStyles

@yield('page_css')
@yield('css')

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="{{ asset('web/js/html5shiv.min.js') }}"></script>
    <script src="{{ asset('web/js/respond.min.js') }}"></script>
    <![endif]-->
</head>
<body>
<!-- Header Start -->
@include('web.layouts.header')
<!-- Header End -->

<!-- Main Content Start -->
@yield('content')
<!-- Main Content End -->

<!-- Footer Start -->
@include('web.layouts.footer')
<!-- Footer End -->

<!-- ===== All Javascript at the bottom of the page for faster page loading ===== -->
<script src="{{ asset('messages.js') }}"></script>
<script src="{{ asset('web/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('web/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('web/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('web/js/swiper.min.js') }}"></script>
<script src="{{ asset('web/js/jquery.countTo.js') }}"></script>
<script src="{{ asset('web/js/jquery.inview.min.js') }}"></script>
<script src="{{ asset('web/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('web/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('web/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('web/js/countdown.js') }}"></script>
<script src="{{ asset('web/js/isotope.min.js') }}"></script>
<script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('web/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
<script src="{{ mix('assets/js/custom/custom.js') }}"></script>
<script>
    let currentLocale = "{{ Config::get('app.locale') }}";
    Lang.setLocale(currentLocale);
    (function ($) {
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
            target = $t[0].href || $t.data('target') || $t.parents('.modal') || [];

        $(target).modal('hide');
    });
    let createNewLetterUrl = "{{ route('news-letter.create') }}";
</script>
<script src="{{ mix('assets/js/web/js/news_letter/news_letter.js') }}"></script>
@livewireScripts


@yield('page_scripts')
@yield('scripts')

</body>
</html>
