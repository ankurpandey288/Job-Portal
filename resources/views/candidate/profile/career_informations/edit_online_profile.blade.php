{{ Form::open(['id'=>'editOnlineProfileForm']) }}
<div class="row">
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label(__('messages.company.facebook_url'), __('messages.company.facebook_url').':') }}
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fab fa-facebook-f facebook-fa-icon"></i>
                </div>
            </div>
            {{ Form::text('facebook_url',$user->facebook_url, ['class' => 'form-control','id'=>'facebookId','placeholder'=>'https://www.facebook.com']) }}
        </div>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label(__('messages.company.twitter_url'), __('messages.company.twitter_url').':') }}
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fab fa-twitter twitter-fa-icon"></i>
                </div>
            </div>
            {{ Form::text('twitter_url', $user->twitter_url , ['class' => 'form-control','id'=>'twitterId','placeholder'=>'https://www.twitter.com']) }}
        </div>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label(__('messages.company.linkedin_url'), __('messages.company.linkedin_url').':') }}
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fab fa-linkedin-in linkedin-fa-icon"></i>
                </div>
            </div>
            {{ Form::text('linkedin_url', $user->linkedin_url, ['class' => 'form-control','id'=>'linkedinId','placeholder'=>'https://www.linkedin.com']) }}
        </div>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label(__('messages.company.google_plus_url'), __('messages.company.google_plus_url').':') }}
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fab fa-google-plus-g google-plus-fa-icon"></i>
                </div>
            </div>
            {{ Form::text('google_plus_url', $user->google_plus_url, ['class' => 'form-control','id'=>'googlePlusId','placeholder'=>'https://www.plus.google.com']) }}
        </div>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ Form::label(__('messages.company.pinterest_url'), __('messages.company.pinterest_url').':') }}
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fab fa-pinterest-p pinterest-fa-icon"></i>
                </div>
            </div>
            {{ Form::text('pinterest_url', $user->pinterest_url, ['class' => 'form-control','id'=>'pinterestId','placeholder'=>'https://www.pinterest.com']) }}
        </div>
    </div>
</div>
<div class="text-right">
    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary mb-2','id'=>'btnOnlineProfileSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
    <button type="button" id="btnOnlineProfileCancel"
            class="btn btn-light ml-1 text-dark mb-2">{{ __('messages.common.cancel') }}</button>
</div>
{{ Form::close() }}
