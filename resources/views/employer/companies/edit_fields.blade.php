<div class="row">
    {{ Form::hidden('user_id',$user->id) }}
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('name', __('messages.company.name').':') }}<span class="text-danger">*</span>
        {{ Form::text('name', isset($user)?$user->first_name:null, ['class' => 'form-control','required']) }}
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('email', __('messages.company.email').':') }}<span class="text-danger">*</span>
        {{ Form::email('email', isset($user)?$user->email:null, ['class' => 'form-control', 'required']) }}
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('phone', __('messages.user.phone').':') }}<br>
        {{ Form::tel('phone', isset($user)?$user->phone:null, ['class' => 'form-control','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'phoneNumber']) }}
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
        {{ Form::select('industry_id', $data['industries'],null, ['id'=>'industryId','class' => 'form-control','placeholder' => 'Select Industry','required']) }}
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('ownership_type_id', __('messages.company.ownership_type').':') }}<span
                class="text-danger">*</span>
        {{ Form::select('ownership_type_id', $data['ownerShipTypes'], null, ['id'=>'ownershipTypeId','class' => 'form-control','placeholder' => 'Select OwnerShip Type','required']) }}
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('company_size_id', __('messages.company.company_size').':') }}<span class="text-danger">*</span>
        {{ Form::select('company_size_id', $data['companySize'], null, ['id'=>'companySizeId','class' => 'form-control','placeholder' => 'Select Company Size','required']) }}
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('country', __('messages.company.country').':') }}
        {{ Form::select('country_id', $data['countries'], null, ['id'=>'countryId','class' => 'form-control','placeholder' => 'Select Country']) }}
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('state', __('messages.company.state').':') }}
        {{ Form::select('state_id', (isset($states) && $states!=null?$states:[]), null, ['id'=>'stateId','class' => 'form-control','placeholder' => 'Select State']) }}
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('city', __('messages.company.city').':') }}
        {{ Form::select('city_id', (isset($cities) && $cities!=null?$cities:[]), null, ['id'=>'cityId','class' => 'form-control','placeholder' => 'Select City']) }}
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('established_in', __('messages.company.established_in').':') }}<span class="text-danger">*</span>
        {{ Form::selectYear('established_in', date('Y'), 2000, (isset($company->established_in)) ? $company->established_in : '', ['class' => 'form-control', 'id' => 'establishedIn']) }}
    </div>
    <div class="form-group col-xl-12 col-md-12 col-sm-12">
        {{ Form::label('details', __('messages.company.employer_details').':') }}<span class="text-danger">*</span>
        {{ Form::textarea('details', null, ['class' => 'form-control' , 'id' => 'editDetails', 'rows' => '5']) }}
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label('location', __('messages.company.location').':') }}<span class="text-danger">*</span>
        {{ Form::text('location', null, ['class' => 'form-control']) }}
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
            {{ Form::text('facebook_url', isset($company->user->facebook_url)?$company->user->facebook_url:null, ['class' => 'form-control','id'=>'facebookUrl','placeholder'=>'https://www.facebook.com']) }}
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
            {{ Form::text('twitter_url', isset($company->user->twitter_url)?$company->user->twitter_url:null, ['class' => 'form-control','id'=>'twitterUrl','placeholder'=>'https://www.twitter.com']) }}
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
            {{ Form::text('linkedin_url', isset($company->user->linkedin_url)?$company->user->linkedin_url:null, ['class' => 'form-control','id'=>'linkedInUrl','placeholder'=>'https://www.linkedin.com']) }}
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
            {{ Form::text('google_plus_url', isset($company->user->google_plus_url)?$company->user->google_plus_url:null, ['class' => 'form-control','id'=>'googlePlusUrl','placeholder'=>'https://www.plus.google.com']) }}
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
            {{ Form::text('pinterest_url', isset($company->user->pinterest_url)?$company->user->pinterest_url:null, ['class' => 'form-control','id'=>'pinterestUrl','placeholder'=>'https://www.pinterest.com']) }}
        </div>
    </div>

    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary']) }}
        <a href="{{ route('company.edit.form', \Illuminate\Support\Facades\Auth::user()->owner_id) }}"
           class="btn btn-secondary text-dark">{{__('messages.common.cancel')}}</a>
    </div>

</div>
