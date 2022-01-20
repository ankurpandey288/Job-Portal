@extends('employer.layouts.app')
@section('title')
    {{ __('messages.job_stage.slots') }}
@endsection
@push('css')
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.css') }}">
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.job_stage.slots') }}</h1>
            <div class="section-header-breadcrumb">
                @if(isset($lastStage) && $jobStage->isNotEmpty())
                    <div class="pl-3 pr-md-3 pr-0 py-1 grid-width-100">
                        {{ Form::select('stage_id', $jobStage, $lastStage->stage_id, ['id' => 'stages', 'class' => 'form-control status-filter w-100']) }}
                    </div>
                @endif
                @if($isSelectedRejectedSlot > 0 || $isStageMatch)
                    <a href="javascript:void(0)"
                       class="ml-4 btn btn-primary form-btn float-right schedule-interview">{{ __('messages.common.add') }}</a>
                @endif
                <a href="{{ url('employer/jobs/'.request()->route('jobId').'/applications') }}" 
                   class="ml-3 btn btn-primary form-btn float-right">{{ __('messages.common.back') }}</a>
            </div>
        </div>
        <div class="section-body">
            @include('layouts.errors')
            <div class="card">
                <div class="card-body mt-0 p-4">
                    @livewire('view-slot-screen')
                </div>
            </div>
        </div>
        @include('employer.job_applications.schedule_interview_modal')
        @include('employer.job_applications.templates.templates')
        @include('employer.job_applications.add_batch_slot_modal')
        @include('employer.job_applications.edit_batch_slot_modal')
    </section>
@endsection
@push('scripts')
    @livewireScripts
    <script>
        let interviewSlotStoreUrl = "{{ route('interview.slot.store', ['jobId' => request()->route('jobId')]) }}";
        let batchSlotStoreUrl = "{{ route('batch.slot.store', ['jobId' => request()->route('jobId')]) }}";
        let uniqueId = 1;
        let JobApplicationId = "{{ request()->route('jobApplicationId') }}";
        let getScheduleHistory = "{{ route('get.schedule.history', ['jobId' => request()->route('jobId')]) }}";
        let cancelSlotUrl = "{{ route('cancel.selected.slot', ['jobId' => request()->route('jobId')]) }}";
        let jobApplicationUrl = "{{url('employer/jobs/'.request()->route('jobId').'/applications')}}";
    </script>
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/job_applications/job_slots.js') }}"></script>
@endpush
