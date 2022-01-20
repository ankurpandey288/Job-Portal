(()=>{"use strict";$(document).ready((function(){$("#size, #editCompanySize").keypress((function(e){if(8!=e.which&&0!=e.which&&"-"!=String.fromCharCode(e.which)&&(e.which<48||e.which>57))return $("#errMsg, #errEditMsg").html("Digits Only").show().fadeOut("slow"),!1}))})),$(document).on("click",".addCompanySizeModal",(function(){$("#addCompanySizeModal").appendTo("body").modal("show")})),$(document).on("submit","#addCompanySizeForm",(function(e){e.preventDefault(),processingBtn("#addCompanySizeForm","#companySizeBtnSave","loading"),$.ajax({url:companySizeSaveUrl,type:"POST",data:$(this).serialize(),success:function(e){e.success&&(displaySuccessMessage(e.message),$("#addCompanySizeModal").modal("hide"),window.livewire.emit("refresh"))},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){processingBtn("#addCompanySizeForm","#companySizeBtnSave")}})})),$(document).on("click",".edit-btn",(function(e){var o=$(e.currentTarget).data("id");renderData(o)})),window.renderData=function(e){$.ajax({url:companySizeUrl+e+"/edit",type:"GET",success:function(e){e.success&&($("#companySizeId").val(e.data.id),$("#editCompanySize").val(e.data.size),$("#editModal").appendTo("body").modal("show"))},error:function(e){displayErrorMessage(e.responseJSON.message)}})},$(document).on("submit","#editForm",(function(e){e.preventDefault(),processingBtn("#editForm","#btnEditSave","loading");var o=$("#companySizeId").val();$.ajax({url:companySizeUrl+o,type:"put",data:$(this).serialize(),success:function(e){e.success&&(displaySuccessMessage(e.message),$("#editModal").modal("hide"),window.livewire.emit("refresh"))},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){processingBtn("#editForm","#btnEditSave")}})})),$(document).on("click",".delete-btn",(function(e){var o=$(e.currentTarget).attr("data-id");swal({title:Lang.get("messages.common.delete")+" !",text:Lang.get("messages.common.are_you_sure_want_to_delete")+'"'+Lang.get("messages.company_size.company_size")+'" ?',type:"warning",showCancelButton:!0,closeOnConfirm:!1,showLoaderOnConfirm:!0,confirmButtonColor:"#6777ef",cancelButtonColor:"#d33",cancelButtonText:Lang.get("messages.common.no"),confirmButtonText:Lang.get("messages.common.yes")},(function(){window.livewire.emit("deleteCompanySize",o)}))})),document.addEventListener("delete",(function(){swal({title:Lang.get("messages.common.deleted")+" !",text:Lang.get("messages.company_size.company_size")+Lang.get("messages.common.has_been_deleted"),type:"success",confirmButtonColor:"#6777ef",timer:2e3})})),$("#addCompanySizeModal").on("hidden.bs.modal",(function(){resetModalForm("#addCompanySizeForm","#companySizeValidationErrorsBox")})),$("#editModal").on("hidden.bs.modal",(function(){resetModalForm("#editForm","#editValidationErrorsBox")})),$("#addCompanySizeModal").on("shown.bs.modal",(function(){$("#size").focus()})),$("#editModal").on("shown.bs.modal",(function(){$("#editCompanySize").focus()}))})();