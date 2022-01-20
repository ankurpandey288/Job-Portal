<script id="planActionTemplate" type="text/x-jsrender">
   <a title="<?php echo __('messages.common.edit') ?>" class="btn btn-warning action-btn edit-btn" data-id="{{:id}}" href="#">
            <i class="fa fa-edit"></i>
   </a>
   {{if !trial}}
       <a title="<?php echo __('messages.common.delete') ?>
  " class="btn btn-danger action-btn delete-btn {{:isDisabledDelete}}" data-id="{{:id}}" href="#" >
          <i class="fa fa-trash"></i>
       </a>
   {{/if}}



</script>

<script id="trialSwitch" type="text/x-jsrender">
   {{if !trial}}
         <i class="font-20 fas fa-times-circle text-danger"></i>
   {{else}}
         <i class="font-20 fas fa-check-circle text-success"></i>
   {{/if}}


</script>
