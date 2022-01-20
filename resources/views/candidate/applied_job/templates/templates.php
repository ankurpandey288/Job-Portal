<script id="scheduleSlotBookHtmlTemplate" type="text/x-jsrender">
    <div class="slot-box mb-3">
                        <div class="row p-3">
                            <div class="form-group col-sm-12 mb-2">
                                <span>{{:schedule_date}} - {{:schedule_time}}</span>
                            </div>
                            <div class="form-group col-sm-12 mb-2">
                                <span>{{:notes}}</span>
                            </div>
                            <div class="form-group col-sm-12 mb-0">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="slot_book" data-schedule="{{:schedule_id}}" id="{{:index}}" class="custom-control-input slot-book" value="<?php echo \App\Models\JobApplicationSchedule::STATUS_SEND ?>">
                                    <label class="custom-control-label" for="{{:index}}"><?php echo __('messages.job_stage.slot_preference') ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
</script>
<script id="chooseSlotHistoryHtmlTemplate" type="text/x-jsrender">
    <div class="d-flex justify-content-between">
          <span>{{:companyName}}</span>
          <span>{{:schedule_created_at}}</span>
     </div>
     <span>{{:notes}}</span>
     <hr>
</script>

<script id="selectedSlotBookHtmlTemplate" type="text/x-jsrender">
    <div class="slot-box mb-3 slot-box-success">
                        <div class="row p-3">
                            <div class="form-group col-sm-12">
                                <span>{{:schedule_date}} - {{:schedule_time}}</span>
                            </div>
                            <div class="form-group col-sm-12">
                                <span>{{:notes}}</span>
                            </div>
                        </div>
                    </div>
</script>
