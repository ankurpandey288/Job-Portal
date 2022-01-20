<script id="jobApplicationActionTemplate" type="text/x-jsrender">
 <div class="dropdown d-inline mr-2">
      <button class="btn btn-primary dropdown-toggle" type="button" id="actionDropDown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
      <div class="dropdown-menu">
        {{if !isCompleted}}
            {{if !isShortlisted}}
            <a class="dropdown-item short-list" href="javascript:void(0)" data-id="{{:id}}"><?php echo __('messages.common.shortlist') ?></a>
            {{else}}
            {{if !isJobExpiry}}
            <a class="dropdown-item change-job-stage" href="javascript:void(0)" data-id="{{:id}}"><?php echo __('messages.job_stage.job_stage') ?></a>
            {{/if}}
            {{/if}}
            {{if !isApplied}}
            <a class="dropdown-item action-completed" href="javascript:void(0)" data-id="{{:id}}"><?php echo __('messages.common.selected') ?></a>
            {{/if}}
            <a class="dropdown-item action-decline" href="javascript:void(0)" data-id="{{:id}}"><?php echo __('messages.common.rejected') ?></a>
            {{if isJobStage && !isRejected && !isJobExpiry}}
            <a class="dropdown-item" href="{{:viewSlotsScreen}}"><?php echo __('messages.job_stage.slots') ?></a>
            {{/if}}
        {{/if}}
        <a class="dropdown-item action-delete" href="javascript:void(0)" data-id="{{:id}}"><?php echo __('messages.common.delete') ?></a>
    </div>
 </div>

</script>

<script id="interviewSlotHtmlTemplate" type="text/x-jsrender">
    <div class="slot-box mb-3">
                        <div class="row p-3">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label name="date"><?php echo __('messages.job_stage.date').':' ?></label>
                                    <span class="text-danger">*</span>
                                    <input type="text" class="form-control date" name="date[{{:uniqueId}}]" required id="date[{{:uniqueId}}]">
                                </div>
                                <div class="form-group mb-0">
                                    <label name="time"><?php echo __('messages.job_stage.time').':' ?></label>
                                    <span class="text-danger">*</span>
                                    <input type="text" class="form-control time" name="time[{{:uniqueId}}]" required id="time[{{:uniqueId}}]">
                                </div>
                            </div>
                            <div class="form-group col-sm-6 mb-0">
                                <label name="notes" class="d-flex justify-content-between"><?php echo __('messages.company.notes').':' ?>
                                    <a href="javascript:void(0)" aria-label="Close" class="close text-danger delete-schedule-slot">×</a>
                                </label>
                                <textarea class="form-control textarea-sizing" name="notes[{{:uniqueId}}]" id="notes"></textarea>
                            </div>
                        </div>
                    </div>
</script>

<script id="slotHtmlTemplate" type="text/x-jsrender">
    <div class="slot-box mb-3 {{:status}}">
                        <div class="row p-3">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label name="date"><?php echo __('messages.job_stage.date').':' ?></label>
                                    <span class="text-danger">*</span>
                                    <input type="text" class="form-control" required id="date" value="{{:schedule_date}}" disabled>
                                </div>
                                <div class="form-group mb-0">
                                    <label name="time"><?php echo __('messages.job_stage.time').':' ?></label>
                                    <span class="text-danger">*</span>
                                    <input type="text" class="form-control" required id="time" value="{{:schedule_time}}" disabled>
                                </div>
                            </div>
                            <div class="form-group col-sm-6 mb-0">
                                <label name="notes" class="d-flex justify-content-between"><?php echo __('messages.company.notes').':' ?>

                                </label>
                                <textarea class="form-control textarea-sizing" id="notes" disabled>{{:notes}}</textarea>
                            </div>
                        </div>
                    </div>
</script>

<script id="interviewSlotHistoryHtmlTemplate" type="text/x-jsrender">
     <div class="d-flex justify-content-between">
          <span>{{:companyName}}</span>
          <span>{{:schedule_date}} - {{:schedule_time}}</span>
     </div>
     <span>{{:notes}}</span>
     <hr>
</script>
