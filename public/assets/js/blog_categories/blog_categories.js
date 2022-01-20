(()=>{"use strict";$(document).on("click",".addBlogCategoryModal",(function(){$("#addModal").appendTo("body").modal("show")})),$(document).on("submit","#addNewForm",(function(e){if(e.preventDefault(),!checkSummerNoteEmpty("#description","Description field is required."))return!0;processingBtn("#addNewForm","#btnSave","loading"),$.ajax({url:blogCategorySaveUrl,type:"POST",data:$(this).serialize(),success:function(e){e.success&&(displaySuccessMessage(e.message),$("#addModal").modal("hide"),window.livewire.emit("refresh"))},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){processingBtn("#addNewForm","#btnSave")}})})),$(document).on("click",".edit-btn",(function(e){if(!ajaxCallIsRunning){ajaxCallInProgress();var t=$(e.currentTarget).data("id");renderData(t)}})),window.renderData=function(e){$.ajax({url:blogCategoryUrl+e+"/edit",type:"GET",success:function(e){if(e.success){var t=document.createElement("textarea");t.innerHTML=e.data.name,$("#blogCategoryId").val(e.data.id),$("#editName").val(t.value),$("#editDescription").summernote("code",e.data.description),$("#editModal").appendTo("body").modal("show"),ajaxCallCompleted()}},error:function(e){displayErrorMessage(e.responseJSON.message)}})},$(document).on("submit","#editForm",(function(e){if(e.preventDefault(),!checkSummerNoteEmpty("#editDescription","Description field is required."))return!0;processingBtn("#editForm","#btnEditSave","loading");var t=$("#blogCategoryId").val();$.ajax({url:blogCategoryUrl+t,type:"put",data:$(this).serialize(),success:function(e){e.success&&(displaySuccessMessage(e.message),$("#editModal").modal("hide"),window.livewire.emit("refresh"))},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){processingBtn("#editForm","#btnEditSave")}})})),$(document).on("click",".show-btn",(function(e){if(!ajaxCallIsRunning){ajaxCallInProgress();var t=$(e.currentTarget).data("id");$.ajax({url:blogCategoryUrl+t,type:"GET",success:function(e){if(e.success){$("#showName").html(""),$("#showDescription").html(""),$("#showName").append(e.data.name);var t=document.createElement("textarea");isEmpty(e.data.description)?t.innerHTML="N/A":t.innerHTML=e.data.description,$("#showDescription").append(t.value),$("#showModal").appendTo("body").modal("show"),ajaxCallCompleted()}},error:function(e){displayErrorMessage(e.responseJSON.message)}})}})),$(document).on("click",".delete-btn",(function(e){var t=$(e.currentTarget).attr("data-id");swal({title:Lang.get("messages.common.delete")+" !",text:Lang.get("messages.common.are_you_sure_want_to_delete")+'"'+Lang.get("messages.post_category.post_category")+'" ?',type:"warning",showCancelButton:!0,closeOnConfirm:!1,showLoaderOnConfirm:!0,confirmButtonColor:"#6777ef",cancelButtonColor:"#d33",cancelButtonText:Lang.get("messages.common.no"),confirmButtonText:Lang.get("messages.common.yes")},(function(){window.livewire.emit("deletePostCategory",t)}))})),document.addEventListener("delete",(function(){swal({title:Lang.get("messages.common.deleted")+" !",text:Lang.get("messages.post_category.post_category")+Lang.get("messages.common.has_been_deleted"),type:"success",confirmButtonColor:"#6777ef",timer:2e3})})),$("#addModal").on("hidden.bs.modal",(function(){resetModalForm("#addNewForm","#validationErrorsBox"),$("#description").summernote("code","")})),$("#editModal").on("hidden.bs.modal",(function(){resetModalForm("#editForm","#editValidationErrorsBox")})),$("#description, #editDescription").summernote({minHeight:200,height:200,toolbar:[["style",["bold","italic","underline","clear"]],["font",["strikethrough"]],["para",["paragraph"]]]})})();