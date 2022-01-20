@extends('employer.layouts.app')
@section('title')
    {{ __('messages.company.edit_employer') }}
@endsection
@push('css')
    <link href="{{ asset('assets/css/summernote.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/css/inttel/css/intlTelInput.css') }}">
@endpush
@section('content')
    <section class="section">
        <div class="section-header justify-content-between featured-badge-margin">
            <h1>{{ __('messages.company.edit_employer') }}</h1>

            @if($isFeaturedEnable)
                @if($company->activeFeatured)
                    <div class="badge badge-info d-inline-block rounded">
                        {{ __('messages.front_settings.featured') }}
                        {{ __('messages.front_settings.exipre_on') }}
                        {{ (new Carbon\Carbon($company->activeFeatured->end_time))->format('d/m/y') }}</div>
                @else
                    @if($isFeaturedAvilabal)
                        <button class="btn btn-info ml-auto"
                                id="makeFeatured">{{ __('messages.front_settings.make_featured') }}</button>
                    @else
                        <button class="btn btn-info ml-auto disabled" data-toggle="tooltip" data-placement="bottom"
                                title="{{ __('messages.front_settings.featured_employer_not_available') }}"
                                data-toggle="tooltip">{{ __('messages.front_settings.make_featured') }}</button>
                    @endif
                @endif
            @endif
        </div>
        <div class="section-body">
            @include('flash::message')
            @include('layouts.errors')
            <div class="card">
                <div class="card-body">
                    {{ Form::model($company, ['route' => ['company.update.form', $company->id], 'method' => 'put','id'=>'editCompanyForm']) }}

                    @include('employer.companies.edit_fields')

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        let companyStateUrl = "{{ route('states-list') }}";
        let companyCityUrl = "{{ route('cities-list') }}";
        let employerPanel = true;
        let isEdit = true;
        let phoneNo = "{{ old('region_code').old('phone') }}";
        let countryId = '{{$company->user->country_id}}';
        let stateId = '{{$company->user->state_id}}';
        let cityId = '{{$company->user->city_id}}';
        let companyID = '{{ $company->id }}';
        let stripe = Stripe('{{ config('services.stripe.key') }}');
        let companyStripePaymentUrl = '{{ url('company-stripe-charge') }}';
        let utilsScript = "{{asset('assets/js/inttel/js/utils.min.js')}}";
    </script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{mix('assets/js/companies/create-edit.js')}}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/companies/companies_stripe_payment.js') }}"></script>
    <script src="{{ asset('assets/js/inttel/js/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('assets/js/inttel/js/utils.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/phone-number-country-code.js') }}"></script>
@endpush
