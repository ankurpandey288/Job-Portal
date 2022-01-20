@extends('web.layouts.app')
@section('title')
    {{ __('messages.setting.privacy_policy') }}
@endsection
@section('content')
    <!-- =============== Start of Page Header 1 Section =============== -->
    <section class="page-header">
        <div class="container">
            <!-- Start of Page Title -->
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ __('messages.setting.privacy_policy') }}</h2>
                </div>
            </div>
            <!-- End of Page Title -->
        </div>
    </section>
    <!-- =============== End of Page Header 1 Section =============== -->

    <!-- ===== Privacy Policy ===== -->
    <section class="ptb80">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <p>{!! nl2br($privacyPolicy->value) !!} </p>
                        </div>
                    </div>
                </div>
                <!-- End of Tab Content -->
            </div>
        </div>
    </section>
    <!-- ===== End Privacy Policy ===== -->
@endsection

@section('scripts')
    <script>
        let registerSaveUrl = "{{ route('front.save.register') }}";
        let logInUrl = "{{ route('login') }}";
    </script>
    <script src="{{mix('assets/js/front_register/front_register.js')}}"></script>
@endsection
