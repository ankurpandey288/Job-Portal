(()=>{"use strict";$(document).on("click",".schedule-interview",(function(){$("#scheduleInterviewModal").appendTo("body").modal("show")})),$(document).on("click",".batch-slot",(function(e){$("#batchSlotId").val($(e.currentTarget).attr("data-batch")),$("#batchSlotModal").appendTo("body").modal("show")})),$(document).on("submit","#batchSlotForm",(function(e){e.preventDefault(),processingBtn("#batchSlotForm","#batchSlotBtnSave","loading");var t=new FormData($(this)[0]);t.append("job_application_id",JobApplicationId),t.append("batch",$("#batchSlotId").val()),$.ajax({url:batchSlotStoreUrl,type:"POST",data:t,processData:!1,contentType:!1,success:function(e){e.success&&(displaySuccessMessage(e.message),$("#batchSlotModal").modal("hide"),window.livewire.emit("refresh"))},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){processingBtn("#batchSlotForm","#batchSlotBtnSave")}})})),$(document).on("click",".edit-btn",(function(e){if(!ajaxCallIsRunning){ajaxCallInProgress();var t=$(e.currentTarget).attr("data-id");$.ajax({url:jobApplicationUrl+"/slots/"+t+"/edit",type:"GET",success:function(e){e.success&&($("#editSlotId").val(e.data.id),$("#editDate").val(e.data.date),$("#editTime").val(e.data.time),$("#editNotes").val(e.data.notes),$("#editSlotModal").appendTo("body").modal("show"),ajaxCallCompleted())},error:function(e){displayErrorMessage(e.responseJSON.message)}})}})),$(document).on("submit","#editSlotForm",(function(e){e.preventDefault(),processingBtn("#editSlotForm","#editSlotBtnSave","loading");var t=$("#editSlotId").val(),o=new FormData($(this)[0]);o.append("job_application_id",JobApplicationId),$.ajax({url:jobApplicationUrl+"/slots/"+t+"/update",type:"post",data:o,processData:!1,contentType:!1,success:function(e){e.success&&(displaySuccessMessage(e.message),$("#editSlotModal").modal("hide"),window.livewire.emit("refresh"))},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){processingBtn("#editSlotForm","#editSlotBtnSave")}})})),$(document).on("click",".delete-btn",(function(e){var t=$(e.currentTarget).attr("data-id");swal({title:Lang.get("messages.common.delete")+" !",text:Lang.get("messages.common.are_you_sure_want_to_delete")+'"'+Lang.get("messages.job_stage.slot")+'" ?',type:"warning",showCancelButton:!0,closeOnConfirm:!1,showLoaderOnConfirm:!0,confirmButtonColor:"#6777ef",cancelButtonColor:"#d33",cancelButtonText:Lang.get("messages.common.no"),confirmButtonText:Lang.get("messages.common.yes")},(function(){$.ajax({url:jobApplicationUrl+"/slots/"+t,type:"DELETE",success:function(e){e.success&&(displaySuccessMessage(e.message),window.livewire.emit("refresh"),setTimeout((function(){0==$(".slot-data").length&&location.reload()}),3e3)),swal({title:Lang.get("messages.common.deleted")+" !",text:Lang.get("messages.job_stage.slot")+Lang.get("messages.common.has_been_deleted"),type:"success",confirmButtonColor:"#6777ef",timer:2e3})},error:function(e){swal({title:"",text:e.responseJSON.message,type:"error",confirmButtonColor:"#6777ef",timer:2e3})}})}))})),$(document).on("click",".add-slot",(function(){uniqueId++;var n={uniqueId};$(".slot-main-div").append(prepareTemplateRender("#interviewSlotHtmlTemplate",n)),t("time["+uniqueId+"]"),o("date["+uniqueId+"]"),e()})),$(document).on("click",".cancel-slot",(function(e){e.preventDefault();var t=$(this).parent(".choose-slot-textarea").find("textarea.cancel-slot-notes").val().trim();if(""==t)return displayErrorMessage("Cancel Reason field is required"),!1;$.ajax({url:cancelSlotUrl,type:"POST",data:{_token:$('meta[name="csrf-token"]').attr("content"),jobApplicationId:JobApplicationId,cancelSlotNote:t},success:function(e){e.success&&(displaySuccessMessage(e.message),$(".schedule-interview").removeClass("d-none"),$(this).parent(".choose-slot-textarea").find("textarea.cancel-slot-notes").val(""),window.livewire.emit("refresh"))},error:function(e){displayErrorMessage(e.responseJSON.message)}})}));var e=function(){var e={uniqueId},t=1;$(".slot-main-div .slot-box").each((function(){t++})),t-1==0&&$(".slot-main-div").append(prepareTemplateRender("#interviewSlotHtmlTemplate",e))};$(document).on("click",".delete-schedule-slot",(function(){$(this).parents(".slot-box").remove(),e(),t("time["+uniqueId+"]"),o("date["+uniqueId+"]"),1==!uniqueId&&uniqueId--})),$("#scheduleInterviewModal").on("hidden.bs.modal",(function(){$("#historyDiv").html(""),$(".slot-main-div").html(""),$(".add-slot").trigger("click"),processingBtn("#scheduleInterviewForm","#scheduleInterviewBtnSave")})),$("#batchSlotModal").on("hidden.bs.modal",(function(){processingBtn("#batchSlotForm","#batchSlotBtnSave"),resetModalForm("#batchSlotForm","#batchSlotValidationErrorsBox")})),$(document).on("submit","#scheduleInterviewForm",(function(e){e.preventDefault(),processingBtn("#scheduleInterviewForm","#scheduleInterviewBtnSave","loading");var t=new FormData($(this)[0]);t.append("scheduleSlotCount",uniqueId),t.append("job_application_id",JobApplicationId),$.ajax({url:interviewSlotStoreUrl,type:"POST",data:t,processData:!1,contentType:!1,success:function(e){e.success&&(displaySuccessMessage(e.message),$("#scheduleInterviewModal").modal("hide"),$(".schedule-interview").addClass("d-none"),window.livewire.emit("refresh"),e.data&&setTimeout((function(){location.reload()}),3e3))},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){processingBtn("#scheduleInterviewForm","#scheduleInterviewBtnSave")}})}));var t=function(e){console.log(e),$(document.getElementById(e)).datetimepicker(DatetimepickerDefaults({format:"HH:mm",sideBySide:!0}))},o=function(e){$(document.getElementById(e)).datetimepicker(DatetimepickerDefaults({format:"DD-MM-YYYY",useCurrent:!0,sideBySide:!0,minDate:new moment}))};$(document).ready((function(){t("time[1]"),o("date[1]"),t("time"),o("date"),t("editTime"),o("editDate"),$("#stages").select2({width:"110%"});var e=$("#stages").select2("val");$("#stages").on("change",(function(t){e=$("#stages").select2("val"),window.livewire.emit("changeFilter","stage",e)})),window.livewire.emit("changeFilter","stage",e),window.livewire.emit("stageFilter","jobApplicationId",JobApplicationId)}))})();