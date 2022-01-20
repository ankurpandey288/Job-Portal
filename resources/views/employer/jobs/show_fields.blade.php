<div class="row">
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('job_title', __('messages.job.job_title').':') }}
        <p>{{ $job->job_title }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('job_title', __('messages.job.job_skill').':') }}
        @if($job->jobsSkill->isNotEmpty())
            <td>{{ $job->jobsSkill->pluck('name')->implode(', ') }}</td>
        @endif
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('job_title', __('messages.job_tag.show_job_tag').':') }}
        @if($job->jobsTag->isNotEmpty())
            <td>{{ $job->jobsTag->pluck('name')->implode(', ') }}</td>
        @endif
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('job_type_id', __('messages.job.job_type').':') }}
        <p>{{ $job->jobType->name }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('job_category_id', __('messages.job_category.job_category').':') }}
        <p>{{ $job->jobCategory->name }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('career_level_id', __('messages.job.career_level').':') }}
        <p>{{ $job->careerLevel->level_name }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('job_shift_id', __('messages.job.job_shift').':') }}
        <p>{{ $job->jobShift->shift }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('currency_id', __('messages.job.currency').':') }}
        <p>{{ $job->currency->currency_name }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('salary_period_id', __('messages.job.salary_period').':') }}
        <p>{{ $job->salaryPeriod->period }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('functional_area_id', __('messages.job.functional_area').':') }}
        <p>{{ $job->functionalArea->name }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('degree_level_id', __('messages.job.degree_level').':') }}
        <p>{{ $job->degreeLevel->name }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('position', __('messages.job.position').':') }}
        <p>{{ $job->position }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('country', __('messages.job.country').':') }}
        <p>{{ !empty($job->country_id) ?$job->country_name:__('messages.common.n/a') }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('state', __('messages.job.state').':') }}
        <p>{{ !empty($job->state_id) ?$job->state_name:__('messages.common.n/a') }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('city', __('messages.job.city').':') }}
        <p>{{ !empty($job->city_id) ?$job->city_name:__('messages.common.n/a') }}</p>
    </div>
    <div class="form-group col-xl-12 col-md-12 col-sm-12">
        {{ Form::label('description', __('messages.job.description').':') }}
        @if($job->description)
            <p>{!! nl2br(e($job->description)) !!} </p>
        @else
            <p>{{ __('messages.common.n/a') }}</p>
        @endif
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('salary_from', __('messages.job.salary_from').':') }}
        <p>{{ $job->salary_from }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('salary_to', __('messages.job.salary_to').':') }}
        <p>{{ $job->salary_to }}</p>
    </div>
    <div class="form-group col-xl-3 col-md-3 col-sm-12">
        {{ Form::label('is_freelance', __('messages.job.is_freelance').':') }}
        <p>{{ $job->is_freelance == 1 ? __('messages.common.yes') : __('messages.common.no') }}</p>
    </div>
    <div class="form-group col-xl-3 col-md-3 col-sm-12">
        {{ Form::label('hide_salary', __('messages.job.hide_salary').':') }}
        <p>{{ $job->hide_salary == 1 ? __('messages.common.yes') : __('messages.common.no') }}</p>
    </div>
    <div class="form-group col-xl-3 col-md-3 col-sm-12">
        {{ Form::label('job_expiry_date', __('messages.job.job_expiry_date')) }}
        <p>{{ Carbon\Carbon::parse($job->job_expiry_date)->format('jS M, Y') }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('created_at', __('messages.common.created_on').':') }}
        <p><span data-toggle="tooltip" data-placement="right"
                 title="{{ date('jS M, Y', strtotime($job->created_at)) }}">{{ $job->created_at->diffForHumans() }}</span>
        </p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('updated_at', __('messages.common.last_updated').':') }}
        <p><span data-toggle="tooltip" data-placement="right"
                 title="{{ date('jS M, Y', strtotime($job->updated_at)) }}">{{ $job->updated_at->diffForHumans() }}</span>
        </p>
    </div>
</div>
