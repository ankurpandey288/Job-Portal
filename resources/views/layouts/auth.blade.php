<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- General CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('web/backend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('web/backend/css/components.css')}}">
</head>

<body>
<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="login-brand">
                        <img src="{{ getSettingValue('logo') }}" alt="logo" width="100"
                             class="shadow-light">
                    </div>
                    @yield('content')
                    <div class="row mx-0 text-center">
                        <div class="col-md-12">
                            {{ __('messages.all_rights_reserved') }} &copy;{{ date('Y') }}
                            <a href="{{ getSettingValue('company_url') }}">{{ html_entity_decode(getSettingValue('application_name')) }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- General JS Scripts -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>

<!-- JS Libraies -->

<!-- Template JS File -->
<script src="{{ asset('web/backend/js/stisla.js') }}"></script>
<script src="{{ asset('web/backend/js/scripts.js') }}"></script>
<!-- Page Specific JS File -->
</body>
</html>
