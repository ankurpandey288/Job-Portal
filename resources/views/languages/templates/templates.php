<script id="languageActionTemplate" type="text/x-jsrender">
   <a title="<?php echo __('messages.common.edit') ?>" class="btn btn-warning action-btn edit-btn" data-id="{{:id}}" href="#">
            <i class="fa fa-edit"></i>
   </a>
   <a title="<?php echo __('messages.common.delete') ?>" class="btn btn-danger action-btn delete-btn" data-id="{{:id}}" href="#">
            <i class="fa fa-trash"></i>
   </a>  

</script>


<script id="isActive" type="text/x-jsrender">
   <label class="custom-switch pl-0">
        <input type="checkbox" name="show_to_staff" class="custom-switch-input isActive" data-id="{{:id}}"
         data-class="is_active" {{:checked}}>
        <span class="custom-switch-indicator"></span>
    </label>
</script>

<script id="isRTL" type="text/x-jsrender">
   <label class="custom-switch pl-0">
        <input type="checkbox" name="show_to_staff" class="custom-switch-input rtl" data-id="{{:id}}"
         data-class="rtl" {{:checked}}>
        <span class="custom-switch-indicator"></span>
    </label>
</script>
<script id="isDefault" type="text/x-jsrender">
   <label class="custom-switch pl-0">
        <input type="checkbox" name="show_to_staff" class="custom-switch-input isDefault" data-id="{{:id}}" 
        data-class="is_default" {{:checked}}>
        <span class="custom-switch-indicator"></span>
    </label>
</script>
