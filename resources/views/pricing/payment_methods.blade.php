@extends('employer.layouts.app')
@section('title')
    {{ __('messages.employer_menu.manage_subscriptions') }}
@endsection
@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 offset-0 offset-md-2 col-md-8">
                        <img src="{{ asset('assets/img/payment.png') }}" class="img-fluid">
                    </div>
                    <div class="col-12">
                        <div class="row justify-content-lg-around">
                            <a class="btn btn-primary btn-lg mt-2 col-md-4 col-12 subscribe" href="javascript:void(0)"
                               data-id="{{ $plan->id }}">
                                <h5 class="mb-0">{{ __('messages.plan.pay_with_stripe') }}</h5>
                            </a>
                            <a class="btn btn-primary btn-lg mt-2 col-md-4 col-12 pay-with-paypal"
                               href="{{ route('paypal-payment', $plan->id) }}">
                                <h5 class="mb-0">{{ __('messages.plan.pay_with_paypal') }}</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        let stripe = Stripe('{{ config('services.stripe.key') }}');
        let subscribeText = "{{ __('messages.plan.purchase') }}";
        let cancelSubscriptionUrl = "{{ route('cancel-subscription') }}";
        let purchaseTriaalSubscriptionUrl = "{{ route('purchase-trial-subscription') }}";
    </script>
    <script src="{{ mix('assets/js/subscription/subscription.js') }}"></script>
@endpush
