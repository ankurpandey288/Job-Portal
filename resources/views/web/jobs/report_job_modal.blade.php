<div class="modal fade" id="reportJobAbuseModal">
    <form name="frm" id="reportJobAbuse">
        @csrf
        <div class="modal-dialog">
            <input type="hidden" name="userId"
                   value="{{ (getLoggedInUserId() !== null) ? getLoggedInUserId() : null }}">
            <input type="hidden" name="jobId" value="{{ $job->id }}">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header m-header">
                    <h4 class="modal-title text-white">{{ __('messages.job.add_note') }}</h4>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                        <textarea rows="5" id="noteForReportAbuse" name="note" class="form-control"
                                  required></textarea>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-purple btn-effect"
                            data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing..."
                            data-toggle="modal" id="btnSave">{{ __('web.job_details.report') }}
                    </button>
                    <button type="button" class="btn btn-red btn-effect"
                            data-dismiss="modal">{{ __('web.common.close') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
