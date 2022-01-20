@extends('employer.layouts.app')
@section('title')
    {{ __('messages.job.job_details') }}
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.job.job_details') }}</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('job.edit',$job->id) }}"
                   class="btn btn-warning form-btn float-right mr-2">{{ __('messages.common.edit') }}</a>
                <a href="{{ route('job.index') }}"
                   class="btn btn-primary form-btn float-right">{{ __('messages.common.back') }}</a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('employer.jobs.show_fields')
                </div>
            </div>
        </div>
    </section>
@endsection
