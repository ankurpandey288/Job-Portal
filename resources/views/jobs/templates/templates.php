<script id="jobActionTemplate" type="text/x-jsrender">
   <a title="<?php echo __('messages.common.edit') ?>" class="btn mt-1 mb-1 btn-warning action-btn edit-btn" href="{{:url}}">
            <i class="fa fa-edit"></i>
   </a>
   <a title="<?php echo __('messages.common.delete') ?>" class="btn btn-danger action-btn delete-btn" data-id="{{:id}}" href="#">
            <i class="fa fa-trash"></i>
   </a>  








</script>


<script id="isFeatured" type="text/x-jsrender">
  {{if !featured}}
      <a class="btn btn-info action-btn w-100 dropdown-toggle text-white" type="button" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false"><?php echo __('messages.front_settings.make_feature') ?></a>
    <div class="dropdown-menu w-100px">
        <a class="dropdown-item adminJobMakeFeatured" data-id="{{:id}}" href="#"><?php echo __('messages.front_settings.make_featured') ?></a>
    </div>
   {{else}}
    <div title="Expries On {{:expiryDate}}" data-toggle="tooltip" data-placement="top">
        <a class="btn btn-success action-btn w-100 dropdown-toggle text-white" type="button" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false"><?php echo __('messages.front_settings.featured') ?><i class="far fa-check-circle pl-1 pt-1"></i></a>
      <div class="dropdown-menu w-100px">
          <a class="dropdown-item adminJobUnFeatured" data-id="{{:id}}" href="#"><?php echo __('messages.front_settings.remove_featured') ?></a>
      </div>
    </div>
   {{/if}}





</script>

<script id="isSuspended" type="text/x-jsrender">
   <label class="custom-switch pl-0">
        <input type="checkbox" name="Is Suspended" class="custom-switch-input isSuspended" data-id="{{:id}}" {{:checked}}>
        <span class="custom-switch-indicator"></span>
    </label>


</script>
