<script id="jobNotificationTemplate" type="text/x-jsrender">
<li class="media mt-4 notification">
  <input type="checkbox" name="job_id[]" class="form-group mr-2 notification__checkbox jobCheck" value="{{:job_id}}">
  <div class="media-body">
    <a href="{{:jobDetails }}" target="_blank" class="media-title mb-1 notification__title">{{:job_title}}</a>
    <div class="text-time">{{:created_by}}</div>
  </div>
</li>
<hr>




</script>
