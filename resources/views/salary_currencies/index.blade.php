@extends('layouts.app')
@section('title')
    {{ __('messages.salary_currencies') }}
@endsection
@push('css')
    @livewireStyles
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.salary_currencies') }}</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @livewire('salary-currencies')
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    @livewireScripts
    <script>
        let salaryCurrencyUrl = "{{ route('salaryCurrency.index') }}/";
    </script>
    <script src="{{mix('assets/js/salary_currencies/salary_currencies.js')}}"></script>
@endpush
