<div class="row">
    <div class="form-group col-md-3 col-sm-12">
        <label>{{ __('messages.front_settings.featured_jobs_enable') }}</label>
        <label class="custom-switch pl-0 col-12">
            <input type="checkbox" name="featured_jobs_enable" class="custom-switch-input"
                    {{ ($frontSettings['featured_jobs_enable'] == 1) ? 'checked' : '' }} >
            <span class="custom-switch-indicator"></span>
        </label>
    </div>
    <div class="form-group col-md-3 col-sm-12">
        <label name="featured_jobs_price">{{ __('messages.front_settings.featured_jobs_price').':' }}<span
                    class="text-danger">*</span></label>
        {{ Form::number('featured_jobs_price', !empty($frontSettings['featured_jobs_price']) ? $frontSettings['featured_jobs_price'] : 0, ['class' => 'form-control salary', 'required','min' => 0, 'max' => '50000']) }}
    </div>
    <div class="form-group col-md-3 col-sm-12">
        <label name="featured_jobs_days">{{ __('messages.front_settings.featured_jobs_due_days').':' }}<span
                    class="text-danger">*</span></label>
        {{ Form::number('featured_jobs_days', $frontSettings['featured_jobs_days'], ['class' => 'form-control salary', 'required','min' => 0, 'max' => '20']) }}
    </div>
    <div class="form-group col-md-3 col-sm-12">
        <label name="featured_jobs_quota">{{ __('messages.front_settings.featured_jobs_quota').':' }}<span
                    class="text-danger">*</span></label>
        {{ Form::number('featured_jobs_quota', $frontSettings['featured_jobs_quota'], ['class' => 'form-control salary', 'required','min' => 0, 'max' => '20']) }}
    </div>

    <div class="form-group col-xl-3 col-md-3 col-sm-12">
        <label>{{ __('messages.front_settings.featured_companies_enable') }}</label>
        <label class="custom-switch pl-0 col-12">
            <input type="checkbox" name="featured_companies_enable" class="custom-switch-input"
                    {{ ($frontSettings['featured_companies_enable'] == 1) ? 'checked' : '' }}>
            <span class="custom-switch-indicator"></span>
        </label>
    </div>
    <div class="form-group col-md-3 col-sm-12">
        <label name="featured_companies_price">{{ __('messages.front_settings.featured_companies_price').':' }}<span
                    class="text-danger">*</span></label>
        {{ Form::number('featured_companies_price', $frontSettings['featured_companies_price'], ['class' => 'form-control salary', 'required','min' => 0, 'max' => '50000']) }}
    </div>
    <div class="form-group col-md-3 col-sm-12">
        <label name="featured_companies_days">{{ __('messages.front_settings.featured_companies_due_days').':' }}<span
                    class="text-danger">*</span></label>
        {{ Form::number('featured_companies_days', $frontSettings['featured_companies_days'], ['class' => 'form-control salary', 'required','min' => 0, 'max' => '20']) }}
    </div>
    <div class="form-group col-md-3 col-sm-12">
        <label name="featured_companies_quota">{{ __('messages.front_settings.featured_companies_quota').':' }}<span
                    class="text-danger">*</span></label>
        {{ Form::number('featured_companies_quota', $frontSettings['featured_companies_quota'], ['class' => 'form-control salary', 'required','min' => 0, 'max' => '20']) }}
    </div>

    <div class="form-group col-xl-3 col-md-3 col-sm-12">
        <label>{{ __('messages.front_settings.latest_jobs_enable') }}
            <span><i class="fas fa-question-circle ml-1" data-toggle="tooltip" data-placement="top"
                     title="{{ __('messages.front_settings.latest_jobs_enable_message') }}"></i></span></label>
        <label class="custom-switch pl-0 col-12">
            <input type="checkbox" name="latest_jobs_enable" class="custom-switch-input"
                    {{ ($frontSettings['latest_jobs_enable'] == 1) ? 'checked' : '' }}>
            <span class="custom-switch-indicator"></span>
        </label>
    </div>
    <div class="form-group col-md-6 col-sm-12">
        <div class="row">
            <div class="px-3">
                {{ Form::label('favicon', __('web.job_menu.advertise_image').':') }}
                <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip"
                   data-placement="top"
                   title="The image must be of pixel 450 X 630."></i>
                <label class="image__file-upload"> {{ __('messages.setting.choose') }}
                    {{ Form::file('advertise_image',['id'=>'advertiseImage','class' => 'd-none','accept'=>'.jpg, .jpeg, .png']) }}
                </label>
            </div>
            <div class="w-auto pl-3 mt-1">
                <img id='advertisePreview' class="img-thumbnail thumbnail-preview"
                     src="{{($frontSettings['advertise_image'])?asset($frontSettings['advertise_image']):asset('assets/img/infyom-logo.png')}}">
            </div>
        </div>
    </div>

    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary','name' => 'save', 'id' => 'saveJob']) }}
        <a href="{{ route('front.settings.index') }}"
           class="btn btn-secondary text-dark">{{__('messages.common.cancel')}}</a>
    </div>

</div>
