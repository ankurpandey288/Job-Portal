@extends('employer.layouts.app')
@section('title')
    {{ __('messages.company.followers') }}
@endsection
@push('css')
    @livewireStyles
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.company.followers') }}</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body followers-body">
                    @livewire('followers')
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    @livewireScripts
@endpush

