@extends('layouts.app')
@section('title')
    {{ __('messages.inquires') }}
@endsection
@push('css')
    @livewireStyles
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.inquires') }}</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @livewire('inquires')
                </div>
            </div>
        </div>
    </section>
    @include('inquires.templates.templates')
@endsection
@push('scripts')
    @livewireScripts
    <script>
        let inquiresUrl = "{{ route('inquires.index') }}/";
    </script>
    <script src="{{mix('assets/js/inquires/inquires.js')}}"></script>
@endpush
