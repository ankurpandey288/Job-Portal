<div class="row details-page">
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('company', __('messages.company.company_name').':') }}
        <p>{{  html_entity_decode($job->company->user->full_name) }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('job_title', __('messages.job.job_title').':') }}
        <p>{{ html_entity_decode($job->job_title) }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('job_title', __('messages.job.job_skill').':') }}
        @if($job->jobsSkill->isNotEmpty())
            <p>{{ html_entity_decode($job->jobsSkill->pluck('name')->implode(', ')) }}</p>
        @else
            <p>{{ __('messages.common.n/a') }}</p>
        @endif
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('job_title', __('messages.job_tag.show_job_tag').':') }}
        @if($job->jobsTag->isNotEmpty())
            <p>{{ html_entity_decode($job->jobsTag->pluck('name')->implode(', ')) }}</p>
        @else
            <p>{{ __('messages.common.n/a') }}</p>
        @endif
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('job_type_id', __('messages.job.job_type').':') }}
        <p>{{ html_entity_decode($job->jobType->name) }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('job_category_id', __('messages.job_category.job_category').':') }}
        <p>{{ html_entity_decode($job->jobCategory->name) }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('career_level_id', __('messages.job.career_level').':') }}
        <p>{{ (!empty($job->careerLevel)) ? html_entity_decode($job->careerLevel->level_name) : __('messages.common.n/a') }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('job_shift_id', __('messages.job.job_shift').':') }}
        <p>{{ (!empty($job->jobShift)) ? html_entity_decode($job->jobShift->shift) : __('messages.common.n/a') }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('currency_id', __('messages.job.currency').':') }}
        <p>{{ $job->currency->currency_name }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('salary_period_id', __('messages.job.salary_period').':') }}
        <p>{{ html_entity_decode($job->salaryPeriod->period) }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('functional_area_id', __('messages.job.functional_area').':') }}
        <p>{{ html_entity_decode($job->functionalArea->name) }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('degree_level_id', __('messages.job.degree_level').':') }}
        <p>{{ (!empty($job->degreeLevel)) ? html_entity_decode($job->degreeLevel->name) : __('messages.common.n/a') }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('position', __('messages.job.position').':') }}
        <p>{{ $job->position }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('position', __('messages.job_experience.job_experience').':') }}
        <p>{{ $job->experience .' '. __('messages.candidate_profile.year') }} </p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('country', __('messages.job.country').':') }}
        <p>{{ !empty($job->country_id) ?$job->country_name:__('messages.common.n/a') }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('state', __('messages.job.state').':') }}
        <p>{{ !empty($job->state_id)? $job->state_name:__('messages.common.n/a') }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('city', __('messages.job.city').':') }}
        <p>{{ !empty($job->city_id) ?$job->city_name:__('messages.common.n/a') }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('salary_from', __('messages.job.salary_from').':') }}
        <p>{{ formatCurrency($job->salary_from) }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('salary_to', __('messages.job.salary_to').':') }}
        <p>{{ formatCurrency($job->salary_to) }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('is_freelance', __('messages.job.is_freelance').':') }}
        <p>{{ $job->is_freelance == 1 ? __('messages.common.yes') : __('messages.common.no') }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('hide_salary', __('messages.job.hide_salary').':') }}
        <p>{{ $job->hide_salary == 1 ? __('messages.common.yes') : __('messages.common.no') }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('job_expiry_date', __('messages.job.job_expiry_date').':') }}
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
    <div class="form-group col-xl-12 col-md-12 col-sm-12">
        {{ Form::label('description', __('messages.job.description').':') }}
        @if($job->description)
            {!! nl2br($job->description) !!}
        @else
            <p>{{ __('messages.common.n/a') }}</p>
        @endif
    </div>
</div>
