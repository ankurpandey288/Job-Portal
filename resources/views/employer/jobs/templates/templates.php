<script id="jobActionTemplate" type="text/x-jsrender">
   {{if !isJobClosed}}
     {{if !isJobPause && !isJobDraft}}
   <a title="<?php echo __('messages.job_applications') ?>
  " class="btn btn-dark action-btn mb-1 mt-1" href="{{:jobApplicationUrl}}" data-toggle="tooltip" data-placement="bottom">
            <i class="fa fa-users"></i>
   </a>
    {{/if}}
   <a title="<?php echo __('messages.common.edit') ?>
  " class="btn mt-1 mb-1 btn-warning action-btn edit-btn" href="{{:url}}" data-toggle="tooltip" data-placement="bottom">
            <i class="fa fa-edit"></i>
   </a>
   {{/if}}
   <a title="Copy Preview Link" class="btn mt-1 mb-1 btn-success action-btn copy-btn" data-job-id="{{:jobId}}" href="#" data-toggle="tooltip" data-placement="bottom">
            <i class="fa fa-copy"></i>
   </a>
   <a title="<?php echo __('messages.common.delete') ?>
  " class="btn mt-1 mb-1 btn-danger action-btn delete-btn" data-id="{{:id}}" href="#" data-toggle="tooltip" data-placement="bottom">
            <i class="fa fa-trash"></i>
   </a>








</script>

<script id="jobStatusActionTemplate" type="text/x-jsrender">
{{if !isJobClosed}}
 {{if status == 'Drafted'}}
    <button class="btn btn-warning mr-1 badge job-application-status" style="cursor:context-menu"><?php echo __('messages.common.drafted') ?></button>
    {{else}}
    <div class="dropdown d-inline mr-2">
        <button class="btn btn-{{:statusColor}} dropdown-toggle badge job-application-status" type="button" id="actionDropDown"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{:status}}</button>
        <div class="dropdown-menu">
            {{if status == 'Live'}}
            <a class="dropdown-item action-pause change-status" href="#" data-id="{{:id}}"
               data-option="Paused"><?php echo __('messages.common.paused') ?></a>
            <a class="dropdown-item action-close change-status" href="#" data-id="{{:id}}"
               data-option="Closed"><?php echo __('messages.common.closed') ?></a>
            {{else status == 'Paused'}}
            <a class="dropdown-item action-open change-status" href="#" data-id="{{:id}}"
               data-option="Live"><?php echo __('messages.common.live') ?></a>
            <a class="dropdown-item action-close change-status" href="#" data-id="{{:id}}"
               data-option="Closed"><?php echo __('messages.common.closed') ?></a>
            {{/if}}
        </div>
    </div>
    {{/if}}
{{else}}
    <button class="btn btn-danger mr-1 badge job-application-status" style="cursor:context-menu"><?php echo __('messages.common.closed') ?></button>
{{/if}}










</script>

<script id="feauredJobTemplate" type="text/x-jsrender">
{{if isFeaturedEnable}}
  {{if !featured}}
     {{if isFeaturedAvilabal && isJobLive}}
        <a title="Pay to get <?php echo __('messages.front_settings.make_featured') ?>
          " data-toggle="tooltip" data-placement="bottom" class="btn btn-info action-btn w-100 featured-job feature-btn" data-id="{{:id}}" href="#">
                <?php echo __('messages.front_settings.make_featured') ?>
       </a>
     {{/if}}
   {{else}}
    <a title="Expries On {{:expiryDate}}
      " data-toggle="tooltip" data-placement="bottom" class="btn btn-success action-btn w-100" data-id="{{:id}}" href="#">
            <?php echo __('messages.front_settings.featured') ?><i class="far fa-check-circle pl-1 pt-1"></i>
   </a>
  {{/if}}
{{else}}
  <a href="#" class="btn btn-icon btn-danger action-btn"><i class="fas fa-times"></i></a>
{{/if}}




</script>
