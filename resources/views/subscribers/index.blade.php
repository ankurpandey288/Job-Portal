@extends('layouts.app')
@section('title')
    {{ __('messages.subscribers') }}
@endsection
@push('css')
    @livewireStyles
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.subscribers') }}</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @livewire('subscriber')
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    @livewireScripts
    <script>
        let subscriberUrl = "{{ route('subscribers.index') }}";
    </script>
    <script src="{{mix('assets/js/subscribers/subscribers.js')}}"></script>
@endpush
