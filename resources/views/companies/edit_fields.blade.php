<div class="row">
    {{ Form::hidden('user_id',$user->id) }}
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('name', __('messages.company.employer_name').':') }}<span class="text-danger">*</span>
        {{ Form::text('name', isset($user)?$user->first_name:null, ['class' => 'form-control','required']) }}
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('email', __('messages.company.email').':') }}<span class="text-danger">*</span>
        {{ Form::email('email', isset($user)?$user->email:null, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('phone', __('messages.user.phone').':') }}<br>
        {{ Form::tel('phone', isset($user)?$user->phone:null, ['class' => 'form-control', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'phoneNumber']) }}
        {{ Form::hidden('region_code',null,['id'=>'prefix_code']) }}
        <br>
        <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
        <span id="error-msg" class="hide"></span>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('ceo', __('messages.company.ceo_name').':') }}<span class="text-danger">*</span>
        {{ Form::text('ceo', null, ['class' => 'form-control','required']) }}
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('industry_id', __('messages.company.industry').':') }}<span class="text-danger">*</span>
        <div class="input-group">
            {{ Form::select('industry_id', $data['industries'],null, ['id'=>'industryId','class' => 'form-control','placeholder' => 'Select Industry','required']) }}
            <div class="input-group-append plus-icon-height">
                <div class="input-group-text">
                    <a href="javascript:void(0)" class="addIndustryModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('ownership_type_id', __('messages.company.ownership_type').':') }}<span
                class="text-danger">*</span>
        <div class="input-group">
            {{ Form::select('ownership_type_id', $data['ownerShipTypes'], null, ['id'=>'ownershipTypeId','class' => 'form-control','placeholder' => 'Select OwnerShip Type','required']) }}
            <div class="input-group-append plus-icon-height">
                <div class="input-group-text">
                    <a href="javascript:void(0)" class="addOwnerShipTypeModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('country', __('messages.company.country').':') }}
        <div class="input-group select2-width-input-grp">
            {{ Form::select('country_id', $data['countries'], !empty($company->user->country_id)?$company->user->country_id:null, ['id'=>'countryId','class' => 'form-control','placeholder' => 'Select Country']) }}
            <div class="input-group-append plus-icon-height">
                <div class="input-group-text">
                    <a href="javascript:void(0)" class="addCountryModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('state', __('messages.company.state').':') }}
        <div class="input-group select2-width-input-grp">
            {{ Form::select('state_id', (isset($state) && $state!=null)?$state:[], isset($company->user->state_id)?$company->user->state_id:null, ['id'=>'stateId','class' => 'form-control','placeholder' => 'Select State']) }}
            <div class="input-group-append plus-icon-height">
                <div class="input-group-text">
                    <a href="javascript:void(0)" class="addStateModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('city', __('messages.company.city').':') }}
        <div class="input-group">
            {{ Form::select('city_id', (isset($cities) && $cities!=null) ?$cities:[], isset($company->user->city_id)?$company->user->city_id:null, ['id'=>'cityId','class' => 'form-control','placeholder' => 'Select City']) }}
            <div class="input-group-append plus-icon-height">
                <div class="input-group-text">
                    <a href="javascript:void(0)" class="addCityModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('company_size_id', __('messages.company.company_size').':') }}<span class="text-danger">*</span>
        <div class="input-group">
            {{ Form::select('company_size_id', $data['companySize'], null, ['id'=>'companySizeId','class' => 'form-control','placeholder' => 'Select Employer Size','required']) }}
            <div class="input-group-append plus-icon-height">
                <div class="input-group-text">
                    <a href="javascript:void(0)" class="addCompanySizeModal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('established_in', __('messages.company.established_year').':') }}<span
                class="text-danger">*</span>
        {{ Form::selectYear('established_in', date('Y'), 2000, (isset($company->established_in)) ? $company->established_in : '', ['class' => 'form-control', 'id' => 'establishedIn','placeholder'=>'Select Established Year']) }}
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('location', __('messages.company.location').':') }}<span class="text-danger">*</span>
        {{ Form::text('location', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-xl-12 col-md-12 col-sm-12">
        {{ Form::label('details', __('messages.company.employer_details').':') }}<span class="text-danger">*</span>
        {{ Form::textarea('details', null, ['class' => 'form-control' , 'id' => 'editDetails','rows'=>'5']) }}
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('no_of_offices', __('messages.company.no_of_offices').':') }}<span class="text-danger">*</span>
        {{ Form::number('no_of_offices', null, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('website', __('messages.company.website').':') }}<span class="text-danger">*</span>
        {{ Form::text('website', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('fax', __('messages.company.fax').':') }}
        {{ Form::text('fax',null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('facebook_url', __('messages.company.facebook_url').':') }}
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fab fa-facebook-f facebook-fa-icon"></i>
                </div>
            </div>
            {{ Form::text('facebook_url',isset($company->user->facebook_url) ? $company->user->facebook_url : null, ['class' => 'form-control','id'=>'facebookUrl','placeholder'=>'https://www.facebook.com']) }}
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
            {{ Form::text('twitter_url', isset($company->user->twitter_url) ? $company->user->twitter_url : null, ['class' => 'form-control','id'=>'twitterUrl','placeholder'=>'https://www.twitter.com']) }}
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
            {{ Form::text('linkedin_url', isset($company->user->linkedin_url) ? $company->user->linkedin_url : null, ['class' => 'form-control','id'=>'linkedInUrl','placeholder'=>'https://www.linkedin.com']) }}
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
            {{ Form::text('google_plus_url', isset($company->user->google_plus_url) ? $company->user->google_plus_url : null, ['class' => 'form-control','id'=>'googlePlusUrl','placeholder'=>'https://www.plus.google.com']) }}
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
            {{ Form::text('pinterest_url', isset($company->user->pinterest_url) ? $company->user->pinterest_url : null, ['class' => 'form-control','id'=>'pinterestUrl','placeholder'=>'https://www.pinterest.com']) }}
        </div>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        <span id="validationErrorsBox" class="text-danger"></span>
        <div class="row">
            <div class="pl-3">
                {{ Form::label('company_logo', __('messages.company.company_logo').':') }}
                <label class="image__file-upload text-white"> {{ __('messages.common.choose') }}
                    {{ Form::file('image',['id'=>'logo','class' => 'd-none']) }}
                </label>
            </div>
            <div class="w-auto pl-3 mt-1">
                <img id='logoPreview' class="thumbnail-preview"
                     src="{{ (!empty($company->user->media[0])) ? $company->user->media[0]->getFullUrl() : asset('assets/img/infyom-logo.png') }}">
            </div>
        </div>
    </div>
    <div class="form-group col-xl-2 col-md-2 col-sm-12">
        <label>{{ __('messages.common.status').':' }}</label><br>
        <label class="custom-switch pl-0">
            <input type="checkbox" name="is_active" class="custom-switch-input isActive"
                   value="1"
                   id="active" {{  isset($company)?($company->user->is_active == 1 ?'checked':''):'checked' }}>
            <span class="custom-switch-indicator"></span>
        </label>
    </div>

    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary', 'id' => 'btnSave']) }}
        <a href="{{ route('company.index') }}" class="btn btn-secondary text-dark">{{__('messages.common.cancel')}}</a>
    </div>

</div>
