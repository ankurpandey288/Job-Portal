(()=>{"use strict";$(document).on("click",".addSalaryPeriodModal",(function(){$("#addSalaryPeriodModal").appendTo("body").modal("show")})),$(document).on("submit","#addSalaryPeriodForm",(function(e){if(e.preventDefault(),!checkSummerNoteEmpty("#salaryPeriodDescription","Description field is required.",1))return!0;processingBtn("#addSalaryPeriodForm","#salaryPeriodBtnSave","loading"),$.ajax({url:salaryPeriodSaveUrl,type:"POST",data:$(this).serialize(),success:function(e){e.success&&(displaySuccessMessage(e.message),$("#addSalaryPeriodModal").modal("hide"),window.livewire.emit("refresh"))},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){processingBtn("#addSalaryPeriodForm","#salaryPeriodBtnSave")}})})),$(document).on("click",".edit-btn",(function(e){if(!ajaxCallIsRunning){ajaxCallInProgress();var a=$(e.currentTarget).attr("data-id");renderData(a)}})),window.renderData=function(e){$.ajax({url:salaryPeriodUrl+e+"/edit",type:"GET",success:function(e){if(e.success){var a=document.createElement("textarea");a.innerHTML=e.data.period,$("#salaryPeriodId").val(e.data.id),$("#editSalaryPeriod").val(a.value),$("#editDescription").summernote("code",e.data.description),$("#editModal").appendTo("body").modal("show"),ajaxCallCompleted()}},error:function(e){displayErrorMessage(e.responseJSON.message)}})},$(document).on("submit","#editForm",(function(e){if(e.preventDefault(),!checkSummerNoteEmpty("#editDescription","Description field is required.",1))return!0;processingBtn("#editForm","#btnEditSave","loading");var a=$("#salaryPeriodId").val();$.ajax({url:salaryPeriodUrl+a,type:"put",data:$(this).serialize(),success:function(e){e.success&&(displaySuccessMessage(e.message),$("#editModal").modal("hide"),window.livewire.emit("refresh"))},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){processingBtn("#editForm","#btnEditSave")}})})),$(document).on("click",".show-btn",(function(e){if(!ajaxCallIsRunning){ajaxCallInProgress();var a=$(e.currentTarget).attr("data-id");$.ajax({url:salaryPeriodUrl+a,type:"GET",success:function(e){if(e.success){$("#showSalaryPeriod").html(""),$("#showDescription").html(""),$("#showSalaryPeriod").append(e.data.period);var a=document.createElement("textarea");a.innerHTML=e.data.description,$("#showDescription").append(a.value),$("#showModal").appendTo("body").modal("show"),ajaxCallCompleted()}},error:function(e){displayErrorMessage(e.responseJSON.message)}})}})),$(document).on("click",".delete-btn",(function(e){var a=$(e.currentTarget).attr("data-id");swal({title:Lang.get("messages.common.delete")+" !",text:Lang.get("messages.common.are_you_sure_want_to_delete")+'"'+Lang.get("messages.job.salary_period")+'" ?',type:"warning",showCancelButton:!0,closeOnConfirm:!1,showLoaderOnConfirm:!0,confirmButtonColor:"#6777ef",cancelButtonColor:"#d33",cancelButtonText:Lang.get("messages.common.no"),confirmButtonText:Lang.get("messages.common.yes")},(function(){$.ajax({url:salaryPeriodUrl+a,type:"DELETE",success:function(e){e.success&&window.livewire.emit("refresh"),swal({title:Lang.get("messages.common.deleted")+" !",text:Lang.get("messages.job.salary_period")+Lang.get("messages.common.has_been_deleted"),type:"success",confirmButtonColor:"#6777ef",timer:2e3})},error:function(e){swal({title:"",text:e.responseJSON.message,type:"error",confirmButtonColor:"#6777ef",timer:2e3})}})}))})),$("#addSalaryPeriodModal").on("hidden.bs.modal",(function(){resetModalForm("#addSalaryPeriodForm","#salaryPeriodValidationErrorsBox"),$("#salaryPeriodDescription").summernote("code","")})),$("#editModal").on("hidden.bs.modal",(function(){resetModalForm("#editForm","#editValidationErrorsBox")})),$("#salaryPeriodDescription, #editDescription").summernote({minHeight:200,height:200,toolbar:[["style",["bold","italic","underline","clear"]],["font",["strikethrough"]],["para",["paragraph"]]]})})();