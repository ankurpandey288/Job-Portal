<div id="editProfileModal" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content left-margin">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.user.edit_profile') }}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'editProfileForm','files'=>true]) }}
            <div class="modal-body">
                {{ Form::hidden('user_id',null,['id'=>'editUserId']) }}
                {{csrf_field()}}
                <div class="row">
                    <div class="form-group col-sm-6">
                        {{ Form::label('first_name', __('messages.candidate.first_name').':') }}<span class="text-danger">*</span>
                        {{ Form::text('first_name', null, ['id'=>'firstName','class' => 'form-control','required']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('last_name', __('messages.candidate.last_name').':') }}
                        {{ Form::text('last_name', null, ['id'=>'lastName','class' => 'form-control']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('email', __('messages.candidate.email').':') }}<span class="text-danger">*</span>
                        {{ Form::email('email', null, ['id'=>'userEmail','class' => 'form-control','required']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('phone', __('messages.candidate.phone').':') }}
                        {{ Form::text('phone', null, ['id'=>'phone','class' => 'form-control']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="px-3">
                        <span id="profilePictureValidationErrorsBox" class="text-danger d-none"></span>
                        <div class="form-group">
                            {{ Form::label('profile_picture', __('messages.candidate.profile').':') }}
                            <label class="image__file-upload text-white"> {{ __('messages.common.choose') }}
                                {{ Form::file('image',['id'=>'profilePicture','class' => 'd-none']) }}
                            </label>
                        </div>
                    </div>
                    <div class="pl-3 w-auto mt-1">
                        <img id='profilePicturePreview' class="img-thumbnail thumbnail-preview"
                             src="{{ asset('assets/img/infyom-logo.png') }}">
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnPrEditSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-light left-margin"
                            data-dismiss="modal">{{ __('messages.common.cancel') }}
                    </button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

<div id="changeLanguageModal" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content left-margin">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.user_language.change_language')}}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'changeLanguageForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="editProfileValidationErrorsBox"></div>
                {{csrf_field()}}
                <div class="row">
                    <div class="form-group col-12">
                        {{ Form::label('language',__('messages.user_language.language').':') }}<span
                                class="required">*</span>
                        {{ Form::select('language', getUserLanguages(), getLoggedInUser()->language, ['id'=>'language','class' => 'form-control','required']) }}
                    </div>
                </div>
                <div class="text-right">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnLanguageChange','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-light left-margin" data-dismiss="modal"
                            onclick="document.getElementById('language').value = '{{getLoggedInUser()->language}}'">{{ __('messages.common.cancel') }}
                    </button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@push('scripts')
    <script>
        let language = "{{ getLoggedInUser()->language }}";
    </script>
