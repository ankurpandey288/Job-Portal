<div class="row">
    <div class="form-group col-sm-6">
        {{ Form::label('first_name',__('messages.candidate.first_name').':') }}<span class="text-danger">*</span>
        {{ Form::text('first_name', null, ['class' => 'form-control','required']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('last_name',__('messages.candidate.last_name').':') }}<span class="text-danger">*</span>
        {{ Form::text('last_name', null, ['class' => 'form-control','required']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('email',__('messages.candidate.email').':') }}<span class="text-danger">*</span>
        {{ Form::text('email', null, ['class' => 'form-control','required']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('father_name',__('messages.candidate.father_name').':') }}
        {{ Form::text('father_name', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('password',__('messages.candidate.password').':') }}<span class="text-danger">*</span>
        {{ Form::password('password', ['class' => 'form-control','required','min' => '6','max' => '10']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('password_confirmation',__('messages.candidate.conform_password').':') }}<span
                class="text-danger">*</span>
        {{ Form::password('password_confirmation', ['class' => 'form-control','required','min' => '6','max' => '10']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('dob', __('messages.candidate.birth_date').':') }}
        {{ Form::text('dob', null, ['class' => 'form-control','id' => 'birthDate','autocomplete' => 'off']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('gender', __('messages.candidate.gender').':') }}<span class="text-danger">*</span><br>
        {{ Form::radio('gender', '0', true) }} {{ __('messages.common.male') }} &nbsp;&nbsp;&nbsp;
        {{ Form::radio('gender', '1') }} {{ __('messages.common.female') }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('skill_id', __('messages.candidate.candidate_skill').':') }}
        <span class="text-danger">*</span>
        <div class="input-group">
            {{Form::select('candidateSkills[]',$data['skills'], null, ['class' => 'form-control','id'=>'skillId','multiple'=>true,'required'])}}
            <div class="input-group-append plus-icon-height">
                <div class="input-group-text">
                    <a href="javascript:void(0)" class="addSkillModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('language_id', __('messages.candidate.candidate_language').':') }}
        <span class="text-danger">*</span>
        <div class="input-group">
            {{Form::select('candidateLanguage[]',$data['language'], null, ['class' => 'form-control','id'=>'languageId','multiple'=>true,'required'])}}
            <div class="input-group-append plus-icon-height">
                <div class="input-group-text">
                    <a href="javascript:void(0)" class="addLanguageModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('marital_status', __('messages.candidate.marital_status').':') }}<span
                class="text-danger">*</span>
        <div class="input-group">
            {{ Form::select('marital_status_id', $data['maritalStatus'], null, ['class' => 'form-control','required','id' => 'maritalStatusId','placeholder'=>'Select Marital Status']) }}
            <div class="input-group-append plus-icon-height">
                <div class="input-group-text">
                    <a href="javascript:void(0)" class="addMaritalStatusModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('nationality', __('messages.candidate.nationality').':') }}
        {{ Form::text('nationality', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('national_id_card', __('messages.candidate.national_id_card').':') }}
        {{ Form::text('national_id_card', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('country', __('messages.company.country').':') }}
        <div class="input-group">
            {{ Form::select('country_id', $data['countries'], null, ['id'=>'countryId','class' => 'form-control','placeholder' => 'Select Country']) }}
            <div class="input-group-append plus-icon-height">
                <div class="input-group-text">
                    <a href="javascript:void(0)" class="addCountryModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('state', __('messages.company.state').':') }}
        <div class="input-group">
            {{ Form::select('state_id', [], null, ['id'=>'stateId','class' => 'form-control','placeholder' => 'Select State']) }}
            <div class="input-group-append plus-icon-height">
                <div class="input-group-text">
                    <a href="javascript:void(0)" class="addStateModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('city', __('messages.company.city').':') }}
        <div class="input-group">
            {{ Form::select('city_id', [], null, ['id'=>'cityId','class' => 'form-control','placeholder' => 'Select City']) }}
            <div class="input-group-append plus-icon-height">
                <div class="input-group-text">
                    <a href="javascript:void(0)" class="addCityModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('phone', __('messages.candidate.phone').':') }}<br>
        {{ Form::tel('phone', null, ['class' => 'form-control', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'phoneNumber'])}}
        {{ Form::hidden('region_code',null,['id'=>'prefix_code']) }}
        <br>
        <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
        <span id="error-msg" class="hide"></span>
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('experience', __('messages.candidate.experience').':') }} <span>({{ __('messages.candidate.in_years') }})</span>
        {{ Form::number('experience', null, ['class' => 'form-control','min' => '0', 'max' => '15']) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('career_level', __('messages.candidate.career_level').':') }}
        <div class="input-group">
            {{ Form::select('career_level_id', $data['careerLevel'], null, ['class' => 'form-control','id' => 'careerLevelId','placeholder'=>'Select Career Level']) }}
            <div class="input-group-append plus-icon-height">
                <div class="input-group-text">
                    <a href="javascript:void(0)" class="addCareerLevelModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('industry', __('messages.candidate.industry').':') }}
        <div class="input-group">
            {{ Form::select('industry_id', $data['industry'], null, ['class' => 'form-control','id' => 'industryId','placeholder'=>'Select Industry']) }}
            <div class="input-group-append plus-icon-height">
                <div class="input-group-text">
                    <a href="javascript:void(0)" class="addIndustryModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('functional_area', __('messages.candidate.functional_area').':') }}
        <div class="input-group">
            {{ Form::select('functional_area_id', $data['functionalArea'], null, ['class' => 'form-control','id' => 'functionalAreaId','placeholder'=>'Select Functional Area']) }}
            <div class="input-group-append plus-icon-height">
                <div class="input-group-text">
                    <a href="javascript:void(0)" class="addFunctionalAreaModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('current_salary', __('messages.candidate.current_salary').':') }}
        {{ Form::text('current_salary', null, ['class' => 'form-control price-input', 'min' => 0, 'max' => 999999999]) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('expected_salary', __('messages.candidate.expected_salary').':') }}
        {{ Form::text('expected_salary', null, ['class' => 'form-control price-input', 'min' => 0, 'max' => 999999999]) }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('salary_currency', __('messages.candidate.salary_currency').':') }}
        {{ Form::select('salary_currency', $data['currency'],null, ['class' => 'form-control', 'id' => 'salaryCurrencyId']) }}
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('facebook_url', __('messages.company.facebook_url').':') }}
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fab fa-facebook-f facebook-fa-icon"></i>
                </div>
            </div>
            {{ Form::text('facebook_url',null, ['class' => 'form-control','id'=>'facebookUrl','placeholder'=>'https://www.facebook.com']) }}
        </div>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('twitter_url', __('messages.company.twitter_url').':') }}
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fab fa-twitter twitter-fa-icon"></i>
                </div>
            </div>
            {{ Form::text('twitter_url', null, ['class' => 'form-control','id'=>'twitterUrl','placeholder'=>'https://www.twitter.com']) }}
        </div>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('linkedin_url', __('messages.company.linkedin_url').':') }}
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fab fa-linkedin-in linkedin-fa-icon"></i>
                </div>
            </div>
            {{ Form::text('linkedin_url', null, ['class' => 'form-control','id'=>'linkedInUrl','placeholder'=>'https://www.linkedin.com']) }}
        </div>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('google_plus_url', __('messages.company.google_plus_url').':') }}
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fab fa-google-plus-g google-plus-fa-icon"></i>
                </div>
            </div>
            {{ Form::text('google_plus_url', null, ['class' => 'form-control','id'=>'googlePlusUrl','placeholder'=>'https://www.plus.google.com']) }}
        </div>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('pinterest_url', __('messages.company.pinterest_url').':') }}
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fab fa-pinterest-p pinterest-fa-icon"></i>
                </div>
            </div>
            {{ Form::text('pinterest_url', null, ['class' => 'form-control','id'=>'pinterestUrl','placeholder'=>'https://www.pinterest.com']) }}
        </div>
    </div>
    <div class="form-group col-sm-6">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                {{ Form::label('immediate_available', __('messages.candidate.immediate_available').':') }}<span
                        class="text-danger">*</span><br>
                {{ Form::radio('immediate_available', '1', true) }} {{ __('messages.candidate.immediate_available') }}
                <br>
                {{ Form::radio('immediate_available', '0') }} {{ __('messages.candidate.not_immediate_available') }}
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="row">
                    <div class="form-group col-md-4 col-sm-12 mb-0 pt-1">
                        <label>{{ __('messages.common.status').':' }}</label><br>
                        <label class="custom-switch pl-0">
                            <input type="checkbox" name="is_active" class="custom-switch-input isActive"
                                   value="1" id="active" checked>
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </div>
                    <div class="form-group col-md-8 col-sm-12 mb-0 pt-1">
                        <div class="custom-control custom-checkbox pl-0">
                            <label>{{ __('messages.candidate.is_verified').':' }}</label><br>
                            <label class="custom-switch pl-0">
                                <input type="checkbox" name="is_verified" class="custom-switch-input"
                                       value="1" id="verified" checked>
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-sm-6 available-at">
        {{ Form::label('available_at', __('messages.candidate.available_at').':') }}
        {{ Form::text('available_at', null, ['class' => 'form-control', 'id' => 'availableAt','autocomplete' => 'off']) }}
    </div>
    <div class="form-group col-sm-12 col-md-6">
        {{ Form::label('address', __('messages.candidate.address').':') }}
        {{ Form::textarea('address', null, ['class' => 'form-control address-height', 'rows' => '5']) }}
    </div>
    <div class="form-group col-sm-12 pt-4">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary']) }}
        <a href="{{ route('candidates.index') }}"
           class="btn btn-secondary text-dark">{{__('messages.common.cancel')}}</a>
    </div>
</div>
