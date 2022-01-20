<div class="row">
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('company_id', __('messages.company.company_name').':') }}<span class="text-danger">*</span>
        {{ Form::select('company_id', $data['companies'],null, ['id'=>'companyId','class' => 'form-control','placeholder' => 'Select Company','required']) }}
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('job_title', __('messages.job.job_title').':') }}<span class="text-danger">*</span>
        {{ Form::text('job_title', null, ['class' => 'form-control','required']) }}
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('job_type_id', __('messages.job.job_type').':') }}<span class="text-danger">*</span>
        <div class="input-group">
            {{ Form::select('job_type_id', $data['jobType'],null, ['id'=>'jobTypeId','class' => 'form-control','placeholder' => 'Select Job Type','required']) }}
            <div class="input-group-append plus-icon-height">
                <div class="input-group-text">
                    <a href="javascript:void(0)" class="addJobTypeModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('job_category_id', __('messages.job_category.job_category').':') }}<span
                class="text-danger">*</span>
        <div class="input-group">
            {{ Form::select('job_category_id', $data['jobCategory'],null, ['id'=>'jobCategoryId','class' => 'form-control','placeholder' => 'Select Job Category','required']) }}
            <div class="input-group-append plus-icon-height">
                <div class="input-group-text">
                    <a href="javascript:void(0)" class="addJobCategoryModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('skill_id', __('messages.job.job_skill').':') }} <span class="text-danger">*</span>
        <div class="input-group">
            {{Form::select('jobsSkill[]',$data['jobSkill'], null, ['class' => 'form-control','id'=>'SkillId','multiple'=>true,'required'])}}
            <div class="input-group-append plus-icon-height">
                <div class="input-group-text">
                    <a href="javascript:void(0)" class="addSkillModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('no_preference', __('messages.candidate.gender').':') }}
        {{ Form::select('no_preference', $data['preference'], null, ['id'=>'preferenceId','class' => 'form-control','placeholder' => 'Select Gender']) }}
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12 custom-datepicker">
        {{ Form::label('job_expiry_date', __('messages.job.job_expiry_date').':') }} <span class="text-danger">*</span>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
            {{ Form::text('job_expiry_date', isset($job->job_expiry_date) ? $job->job_expiry_date : null, ['class' => 'form-control expiryDatepicker', 'required', 'autocomplete' => 'off']) }}
        </div>
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('salary_from', __('messages.job.salary_from').':') }}<span class="text-danger">*</span>
        {{ Form::text('salary_from', null, ['class' => 'form-control salary', 'id' => 'fromSalary', 'required', 'autocomplete' => 'off']) }}
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('salary_to', __('messages.job.salary_to').':') }}<span class="text-danger">*</span>
        {{ Form::text('salary_to', null, ['class' => 'form-control salary', 'id' => 'toSalary', 'required', 'autocomplete' => 'off']) }}
        <span id="salaryToErrorMsg" class="text-danger"></span>
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('currency_id', __('messages.job.currency').':') }}<span class="text-danger">*</span>
        {{ Form::select('currency_id', $data['currencies'],null,['id'=>'currencyId','class' => 'form-control','placeholder' => 'Select Currency','required']) }}
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('salary_period_id', __('messages.job.salary_period').':') }}<span class="text-danger">*</span>
        <div class="input-group">
            {{ Form::select('salary_period_id', $data['salaryPeriods'], null, ['id'=>'salaryPeriodsId','class' => 'form-control','placeholder' => 'Select Salary Period','required']) }}
            <div class="input-group-append plus-icon-height">
                <div class="input-group-text">
                    <a href="javascript:void(0)" class="addSalaryPeriodModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('country', __('messages.company.country').':') }}<span class="text-danger">*</span>
        <div class="input-group">
            {{ Form::select('country_id', $data['countries'], null, ['id'=>'countryId','class' => 'form-control','placeholder' => 'Select Country','required']) }}
            <div class="input-group-append plus-icon-height">
                <div class="input-group-text">
                    <a href="javascript:void(0)" class="addCountryModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('state', __('messages.company.state').':') }}<span class="text-danger">*</span>
        <div class="input-group">
            {{ Form::select('state_id', [], null, ['id'=>'stateId','class' => 'form-control','placeholder' => 'Select State','required']) }}
            <div class="input-group-append plus-icon-height">
                <div class="input-group-text">
                    <a href="javascript:void(0)" class="addStateModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('city', __('messages.company.city').':') }}<span class="text-danger">*</span>
        <div class="input-group">
            {{ Form::select('city_id', [], null, ['id'=>'cityId','class' => 'form-control','placeholder' => 'Select City','required']) }}
            <div class="input-group-append plus-icon-height">
                <div class="input-group-text">
                    <a href="javascript:void(0)" class="addCityModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('career_level_id', __('messages.job.career_level').':') }}
        <div class="input-group">
            {{ Form::select('career_level_id', $data['careerLevels'],null, ['id'=>'careerLevelsId','class' => 'form-control','placeholder' => 'Select Career Level']) }}
            <div class="input-group-append plus-icon-height">
                <div class="input-group-text">
                    <a href="javascript:void(0)" class="addCareerLevelModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('job_shift_id', __('messages.job.job_shift').':') }}
        <div class="input-group">
            {{ Form::select('job_shift_id', $data['jobShift'], null, ['id'=>'jobShiftId','class' => 'form-control','placeholder' => 'Select Job Shift']) }}
            <div class="input-group-append plus-icon-height">
                <div class="input-group-text">
                    <a href="javascript:void(0)" class="addJobShiftModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('tagId', __('messages.job_tag.show_job_tag').':') }}
        <div class="input-group">
            {{Form::select('jobTag[]',$data['jobTag'], null, ['class' => 'form-control','id'=>'tagId','multiple'=>true])}}
            <div class="input-group-append plus-icon-height">
                <div class="input-group-text">
                    <a href="javascript:void(0)" class="addJobTagModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('degree_level_id', __('messages.job.degree_level').':') }}
        <div class="input-group">
            {{ Form::select('degree_level_id', $data['requiredDegreeLevel'], null, ['id'=>'requiredDegreeLevelId','class' => 'form-control','placeholder' => 'Select Degree Level']) }}
            <div class="input-group-append plus-icon-height">
                <div class="input-group-text">
                    <a href="javascript:void(0)" class="addRequiredDegreeLevelTypeModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('functional_area_id', __('messages.job.functional_area').':') }}<span
                class="text-danger">*</span>
        <div class="input-group">
            {{ Form::select('functional_area_id', $data['functionalArea'], null, ['id'=>'functionalAreaId','class' => 'form-control','placeholder' => 'Select Functional Area','required']) }}
            <div class="input-group-append plus-icon-height">
                <div class="input-group-text">
                    <a href="javascript:void(0)" class="addFunctionalAreaModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('position', __('messages.job.position').':') }}<span class="text-danger">*</span>
        {{ Form::number('position',  null, ['id'=>'positionId','class' => 'form-control','placeholder' => 'Select Position','required', 'min' => 0, 'max' => 255]) }}
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('experience', __('messages.job_experience.job_experience').':') }}<span
                class="text-danger">*</span>
        {{ Form::number('experience',  null, ['id'=>'experienceId','class' => 'form-control','placeholder' => 'Enter experience In Year','required', 'min' => 0, 'max' => 255]) }}
    </div>
    <div class="form-group col-xl-12 col-md-12 col-sm-12">
        {{ Form::label('description', __('messages.job.description').':') }}<span class="text-danger">*</span>
        {{ Form::textarea('description', null, ['class' => 'form-control' , 'id' => 'details', 'rows' => '5']) }}
    </div>
    <div class="form-group col-xl-3 col-md-3 col-sm-12">
        <label>{{ __('messages.job.hide_salary').':' }}</label>
        <label class="custom-switch pl-0 col-12">
            <input type="checkbox" name="hide_salary" class="custom-switch-input"
                   id="salary">
            <span class="custom-switch-indicator"></span>
        </label>
    </div>
    <div class="form-group col-xl-3 col-md-3 col-sm-12">
        <label>{{ __('messages.job.is_freelance').':' }}</label>
        <label class="custom-switch pl-0 col-12">
            <input type="checkbox" name="is_freelance" class="custom-switch-input"
                   id="freelance">
            <span class="custom-switch-indicator"></span>
        </label>
    </div>

    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary','name' => 'save', 'id' => 'saveJob']) }}
        <a href="{{ route('admin.jobs.index') }}"
           class="btn btn-secondary text-dark">{{__('messages.common.cancel')}}</a>
    </div>

</div>
