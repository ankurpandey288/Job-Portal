@extends('candidate.profile.index')
@push('page-css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/inttel/css/intlTelInput.css') }}">
@endpush
@section('section')
    {{ Form::open(['route' => 'candidate-profile.update', 'files' => true,'id'=>'candidateProfileUpdate']) }}
    <div class="alert alert-danger d-none" id="validationErrors"></div>
    <div class="row">
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-sm-6 col-xs-6 col-md-6 col-xl-3 col-6">
                    {{ Form::label('profile', __('messages.candidate.profile').':', ['class' => 'font-weight-bolder']) }}
                    <label class="image__file-upload text-white"> {{ __('messages.common.choose') }}
                        {{ Form::file('image',['id'=>'profile','class' => 'd-none']) }}
                    </label>
                </div>
                <div class="col-sm-6 col-xs-6 col-6 col-md-6 col-xl-6 pl-2 mt-1">
                    <img id='profilePreview' class="img-thumbnail thumbnail-preview"
                         src="{{ (!empty($user->media[0])) ? $user->media[0]->getFullUrl() : asset('assets/img/infyom-logo.png') }}">
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('first_name',__('messages.candidate.first_name').':', ['class' => 'font-weight-bolder']) }}<span class="text-danger">*</span>
            {{ Form::text('first_name', $user->first_name, ['class' => 'form-control','required']) }}
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('last_name',__('messages.candidate.last_name').':', ['class' => 'font-weight-bolder']) }}<span class="text-danger">*</span>
            {{ Form::text('last_name', $user->last_name, ['class' => 'form-control','required']) }}
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('email',__('messages.candidate.email').':', ['class' => 'font-weight-bolder']) }}<span class="text-danger">*</span>
            {{ Form::text('email', $user->email, ['class' => 'form-control','required']) }}
        </div>

        <div class="form-group col-sm-6">
            {{ Form::label('father_name',__('messages.candidate.father_name').':', ['class' => 'font-weight-bolder']) }}
            {{ Form::text('father_name', $user->candidate->father_name, ['class' => 'form-control']) }}
        </div>
        <div class="form-group col-sm-6 custom-candidate-datepicker">
            {{ Form::label('dob', __('messages.candidate.birth_date').':', ['class' => 'font-weight-bolder']) }}
            {{ Form::text('dob', $user->dob, ['class' => 'form-control','id' => 'birthDate','autocomplete' => 'off']) }}
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('gender', __('messages.candidate.gender').':', ['class' => 'font-weight-bolder']) }}<span class="text-danger">*</span>
            <div class="form-group mb-1">
                <div class="custom-control custom-radio">
                    <input type="radio" id="male" name="gender" class="custom-control-input" value="0"
                            {{ isset($user->gender) ? ($user->gender == 0 ? 'checked' : '') : '' }} required>
                    <label class="custom-control-label" for="male">{{ __('messages.common.male') }}</label>
                </div>
            </div>
            <div class="form-group mb-1">
                <div class="custom-control custom-radio">
                    <input type="radio" id="female" name="gender" class="custom-control-input" value="1"
                            {{ isset($user->gender) ? ($user->gender == 1 ? 'checked' : '') : '' }}>
                    <label class="custom-control-label" for="female">{{ __('messages.common.female') }}</label>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6 ">
            {{ Form::label('skill_id', __('messages.candidate.candidate_skill').':', ['class' => 'font-weight-bolder']) }}
            <span
                    class="text-danger">*</span>
            <div class="w-100">
                {{Form::select('candidateSkills[]',$data['skills'], (count($candidateSkills) > 0)?$candidateSkills:null, ['class' => 'form-control  ','id'=>'skillId','multiple'=>true,'required'])}}
            </div>
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('language_id', __('messages.candidate.candidate_language').':', ['class' => 'font-weight-bolder']) }}
            <span
                    class="text-danger">*</span>
            {{Form::select('candidateLanguage[]',$data['language'], (count($candidateLanguage) > 0) ? $candidateLanguage : null, ['class' => 'form-control','id'=>'languageId','multiple'=>true,'required'])}}
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('marital_status', __('messages.candidate.marital_status').':', ['class' => 'font-weight-bolder']) }}
            <span
                    class="text-danger">*</span>
            {{ Form::select('marital_status_id', $data['maritalStatus'], isset($user->candidate->marital_status_id) ? $user->candidate->marital_status_id : null, ['class' => 'form-control','required','id' => 'maritalStatusId','placeholder'=>'Select marital status']) }}
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('nationality', __('messages.candidate.nationality').':', ['class' => 'font-weight-bolder']) }}
            {{ Form::text('nationality', isset($user->candidate->nationality) ? $user->candidate->nationality : null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('national_id_card', __('messages.candidate.national_id_card').':', ['class' => 'font-weight-bolder']) }}
            {{ Form::text('national_id_card', isset($user->candidate->national_id_card) ? $user->candidate->national_id_card : null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('country', __('messages.company.country').':', ['class' => 'font-weight-bolder']) }}
            {{ Form::select('country_id', $data['countries'], !empty($user->country_id) ? $user->candidate->country_name : null, ['id'=>'countryId','class' => 'form-control','placeholder' => 'Select Country']) }}
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('state', __('messages.company.state').':', ['class' => 'font-weight-bolder']) }}
            {{ Form::select('state_id', (isset($states) && $states!=null?$states:[]), isset($user->state_id) ? $user->state_name : null, ['id'=>'stateId','class' => 'form-control','placeholder' => 'Select State']) }}
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('city', __('messages.company.city').':', ['class' => 'font-weight-bolder']) }}
            {{ Form::select('city_id', (isset($cities) && $cities!=null?$cities:[]), isset($user->city_id) ? $user->city_name : null, ['id'=>'cityId','class' => 'form-control','placeholder' => 'Select City']) }}
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('phone', __('messages.candidate.phone').':', ['class' => 'font-weight-bolder']) }}</br>
            {{ Form::tel('phone', isset($user->phone) ? $user->phone : null, ['class' => 'form-control', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'phoneNumber']) }}
            {{ Form::hidden('region_code',null,['id'=>'prefix_code']) }}
            <br>
            <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
            <span id="error-msg" class="hide"></span>
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('experience', __('messages.candidate.experience').':', ['class' => 'font-weight-bolder']) }}
            <span>({{ __('messages.candidate.in_years') }})</span>
            {{ Form::number('experience', isset($user->candidate->experience) ? $user->candidate->experience : null, ['class' => 'form-control','min' => '0', 'max' => '15']) }}
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('career_level', __('messages.candidate.career_level').':', ['class' => 'font-weight-bolder']) }}
            {{ Form::select('career_level_id', $data['careerLevel'], isset($user->candidate->career_level_id) ? $user->candidate->career_level_id : null, ['class' => 'form-control','id' => 'careerLevelId','placeholder'=>'Select career level']) }}
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('industry', __('messages.candidate.industry').':', ['class' => 'font-weight-bolder']) }}
            {{ Form::select('industry_id', $data['industry'], isset($user->candidate->industry_id) ? $user->candidate->industry_id : null, ['class' => 'form-control','id' => 'industryId','placeholder'=>'Select industry']) }}
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('functional_area', __('messages.candidate.functional_area').':', ['class' => 'font-weight-bolder']) }}
            {{ Form::select('functional_area_id', $data['functionalArea'], isset($user->candidate->functional_area_id) ? $user->candidate->functional_area_id : null, ['class' => 'form-control','id' => 'functionalAreaId','placeholder'=>'Select functional area']) }}
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('current_salary', __('messages.candidate.current_salary').':', ['class' => 'font-weight-bolder']) }}
            {{ Form::text('current_salary', isset($user->candidate->current_salary) ? $user->candidate->current_salary : null, ['class' => 'form-control price-input']) }}
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('expected_salary', __('messages.candidate.expected_salary').':', ['class' => 'font-weight-bolder']) }}
            {{ Form::text('expected_salary', isset($user->candidate->expected_salary) ? $user->candidate->expected_salary : null, ['class' => 'form-control price-input']) }}
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('salary_currency', __('messages.candidate.salary_currency').':', ['class' => 'font-weight-bolder']) }}
            {{ Form::select('salary_currency', $data['currency'], isset($user->candidate->salary_currency) ? $user->candidate->salary_currency : null, ['class' => 'form-control', 'id' => 'salaryCurrencyId']) }}
        </div>
        <div class="form-group col-sm-6">
            {{ Form::label('immediate_available', __('messages.candidate.immediate_available').':', ['class' => 'font-weight-bolder']) }}
            <div class="form-group mb-1">
                <div class="custom-control custom-radio">
                    <input type="radio" id="available" name="immediate_available" class="custom-control-input" value="1"
                            {{ isset($user->candidate->immediate_available) ? ($user->candidate->immediate_available == 1 ? 'checked' : '') : 'checked' }}>
                    <label class="custom-control-label"
                           for="available">{{ __('messages.candidate.immediate_available') }}</label>
                </div>
            </div>
            <div class="form-group mb-1">
                <div class="custom-control custom-radio">
                    <input type="radio" id="not_available" name="immediate_available" class="custom-control-input"
                           value="0"
                            {{ isset($user->candidate->immediate_available) ? ($user->candidate->immediate_available == 0 ? 'checked' : '') : '' }}>
                    <label class="custom-control-label"
                           for="not_available">{{ __('messages.candidate.not_immediate_available') }}</label>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6 available-at">
            {{ Form::label('available_at', __('messages.candidate.available_at').':', ['class' => 'font-weight-bolder']) }}
            {{ Form::text('available_at', isset($user->candidate->available_at) ? $user->candidate->available_at : null, ['class' => 'form-control','id' => 'availableAt','autocomplete' => 'off']) }}
        </div>
        <div class="form-group col-xl-6 col-md-6 col-sm-12">
            {{ Form::label('facebook_url', __('messages.company.facebook_url').':', ['class' => 'font-weight-bolder']) }}
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fab fa-facebook-f facebook-fa-icon"></i>
                    </div>
                </div>
                {{ Form::text('facebook_url',$user->facebook_url, ['class' => 'form-control','id'=>'facebookUrl','placeholder'=>'https://www.facebook.com']) }}
            </div>
        </div>
        <div class="form-group col-xl-6 col-md-6 col-sm-12">
            {{ Form::label('twitter_url', __('messages.company.twitter_url').':', ['class' => 'font-weight-bolder']) }}
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fab fa-twitter twitter-fa-icon"></i>
                    </div>
                </div>
                {{ Form::text('twitter_url', $user->twitter_url , ['class' => 'form-control','id'=>'twitterUrl','placeholder'=>'https://www.twitter.com']) }}
            </div>
        </div>
        <div class="form-group col-xl-6 col-md-6 col-sm-12">
            {{ Form::label('linkedin_url', __('messages.company.linkedin_url').':', ['class' => 'font-weight-bolder']) }}
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fab fa-linkedin-in linkedin-fa-icon"></i>
                    </div>
                </div>
                {{ Form::text('linkedin_url', $user->linkedin_url, ['class' => 'form-control','id'=>'linkedInUrl','placeholder'=>'https://www.linkedin.com']) }}
            </div>
        </div>
        <div class="form-group col-xl-6 col-md-6 col-sm-12">
            {{ Form::label('google_plus_url', __('messages.company.google_plus_url').':', ['class' => 'font-weight-bolder']) }}
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fab fa-google-plus-g google-plus-fa-icon"></i>
                    </div>
                </div>
                {{ Form::text('google_plus_url', $user->google_plus_url, ['class' => 'form-control','id'=>'googlePlusUrl','placeholder'=>'https://www.plus.google.com']) }}
            </div>
        </div>
        <div class="form-group col-xl-6 col-md-6 col-sm-12">
            {{ Form::label('pinterest_url', __('messages.company.pinterest_url').':', ['class' => 'font-weight-bolder']) }}
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fab fa-pinterest-p pinterest-fa-icon"></i>
                    </div>
                </div>
                {{ Form::text('pinterest_url', $user->pinterest_url, ['class' => 'form-control','id'=>'pinterestUrl','placeholder'=>'https://www.pinterest.com']) }}
            </div>
        </div>
        <div class="form-group col-sm-12">
            {{ Form::label('address', __('messages.candidate.address').':', ['class' => 'font-weight-bolder']) }}
            {{ Form::textarea('address', isset($user->candidate->address) ? $user->candidate->address : null, ['class' => 'form-control address-height','rows'=>'5']) }}
        </div>
    </div>

    <div class="row mt-4">
        <!-- Submit Field -->
        <div class="form-group col-sm-12">
            {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary btnSave']) }}
            <a href="" class="btn btn-secondary hover-text-dark text-dark">Cancel</a>
        </div>
    </div>
    {{ Form::close() }}
@endsection
<script>
    let countryId = '{{$user->country_id}}';
    let stateId = '{{$user->state_id}}';
    let cityId = '{{$user->city_id}}';
    let isEdit = true;
    let phoneNo = "{{ old('region_code').old('phone') }}";
    let utilsScript = "{{asset('assets/js/inttel/js/utils.min.js')}}";
</script>
@push('page-scripts')
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{mix('assets/js/custom/input_price_format.js')}}"></script>
    <script src="{{mix('assets/js/candidate-profile/candidate-general.js')}}"></script>
    <script src="{{ asset('assets/js/inttel/js/intlTelInput.min.js') }}"></script>
    <script src="{{ asset('assets/js/inttel/js/utils.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/phone-number-country-code.js') }}"></script>
@endpush
