@extends('web.layouts.app')
@section('title')
    {{ __('web.contact_us') }}
@endsection
@section('content')
    <!-- =============== Start of Page Header 1 Section =============== -->
    <section class="page-header">
        <div class="container">
            <!-- Start of Page Title -->
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ __('web.contact_us') }}</h2>
                </div>
            </div>
            <!-- End of Page Title -->
        </div>
    </section>
    <!-- =============== End of Page Header 1 Section =============== -->

    <!-- ===== Start of Main Wrapper Section ===== -->
    <section class="ptb80 bg-gray custom-ptb-60-30" id="contact">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-8 col-xs-12 col-md-offset-2">
                    <!-- Start of Contact Form -->
                    <form id="formContact" class="mt30" name="frm-contact" method="post"
                          action="{{ route('send.contact.email') }}">
                    @csrf
                    @include('web.layouts.errors')
                    @include('flash::message')

                    <!-- Form Group -->
                        <div class="form-group">
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}"
                                   placeholder="Your Name" autocomplete="off" required>
                        </div>

                        <!-- Form Group -->
                        <div class="form-group">
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}"
                                   placeholder="your-email@cariera.com" autocomplete="off" required>
                        </div>

                        <!-- Form Group -->
                        <div class="form-group">
                            <input class="form-control" type="tel" name="phone_no" value="{{ old('phone_no') }}"
                                   placeholder="Phone Number" autocomplete="off" pattern="[789][0-9]{9}"
                                   oninvalid="this.setCustomValidity('Phone No format is invalid')"
                                   oninput="this.setCustomValidity('')"
                                   onkeyup='if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")'
                                   minlength="10" maxlength="12">
                        </div>

                        <!-- Form Group -->
                        <div class="form-group">
                            <input class="form-control" type="text" name="subject" value="{{ old('subject') }}"
                                   placeholder="Subject" autocomplete="off" required>
                        </div>

                        <!-- Form Group -->
                        <div class="form-group mb20">
                            <textarea class="form-control" rows="5" name="message" placeholder="Type your message..."
                                      required>{{ trim(old('message')) }}</textarea>
                        </div>
                        <!-- Form Group -->
                        <div class="form-group mt10">
                            <div class="g-recaptcha d-flex justify-content-center"
                                 data-sitekey="{{ config('app.google_recaptcha_site_key') }}" name="g-recaptcha"></div>
                            <div id="g-recaptcha-error"></div>
                        </div>

                        <!-- Form Group -->
                        <div class="form-group text-center">
                            <button class="btn btn-purple btn-effect"
                                    type="submit">{{ __('web.contact_us_menu.send_message') }}</button>
                        </div>
                    </form>
                    <!-- End of Contact Form -->
                </div>
            </div>
        </div>
    </section>
    <!-- ===== End of Main Wrapper Section ===== -->
@endsection

@section('page_scripts')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection
