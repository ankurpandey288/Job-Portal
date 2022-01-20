<div class="modal fade" id="reportToCandiateModal">
    <form name="frm" id="reportToCandidate">
        @csrf
        <div class="modal-dialog">
            <input type="hidden" name="userId"
                   value="{{ (getLoggedInUserId() !== null) ? getLoggedInUserId() : null }}">
            <input type="hidden" name="candidateId" value="{{ $candidateDetails->id }}">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header m-header">
                    <h4 class="modal-title text-white">{{ __('messages.job.add_note') }}</h4>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                        <textarea rows="5" id="noteForReportToCompany" name="note" class="form-control"
                                  required></textarea>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-purple btn-effect"
                            data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing..."
                            data-toggle="modal" id="btnSave">{{ __('messages.common.report') }}
                    </button>
                    <button type="button" class="btn btn-red btn-effect"
                            data-dismiss="modal">{{ __('messages.common.close') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
