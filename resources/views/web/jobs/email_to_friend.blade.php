<!-- Email job to friend - STARTS -->
<div class="modal fade" id="emailJobToFriendModal">
    <form name="frm" id="emailJobToFriend">
        @csrf
        <div class="modal-dialog">
            <input type="hidden" name="user_id"
                   value="{{ (getLoggedInUserId() !== null) ? getLoggedInUserId() : null }}">
            <input type="hidden" name="job_id" value="{{ $job->id }}">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header m-header">
                    <h4 class="modal-title text-white">{{ __('messages.job.email_to_friend') }}</h4>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="jobUrl">{{ __('messages.job.job_url') }}</label>
                            <input type="text" class="form-control" name="job_url" id="jobUrl" readonly>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="friendName">{{ __('messages.job.friend_name') }}</label>
                            <input type="text" class="form-control" name="friend_name" id="friendName" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="friendEmail">{{ __('messages.job.friend_email') }}</label>
                            <input type="email" class="form-control" name="friend_email" id="friendEmail" required>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-purple btn-effect"
                            data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing..."
                            data-toggle="modal" id="btnSendToFriend">{{ __('web.job_details.send_to_friend') }}
                    </button>
                    <button type="button" class="btn btn-red btn-effect"
                            data-dismiss="modal">{{ __('web.common.close') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Email job to friend - ENDS -->
