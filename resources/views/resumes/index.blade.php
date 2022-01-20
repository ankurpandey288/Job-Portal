@extends('layouts.app')
@section('title')
    {{ __('messages.all_resumes') }}
@endsection
@push('css')
    @livewireStyles
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.all_resumes') }}</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @livewire('candidate-resume')
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    @livewireScripts
    <script>
        let resumesUrl = "{{ route('resumes.index') }}/";
        let downloadresumesUrl = "{{ route('download.all-resume') }}";
        let deleteresumesUrl = "{{ route('delete.resume') }}/";
    </script>
    <script src="{{mix('assets/js/candidate/resumes.js')}}"></script>
@endpush
