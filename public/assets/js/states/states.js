(()=>{"use strict";$(document).ready((function(){$("#countryID,#editCountryId").select2({width:"100%"}),$("#filter_country").select2({width:"170px"})})),$(document).on("click",".addStateModal",(function(){$("#addStateModal").appendTo("body").modal("show")})),$(document).on("submit","#addStateForm",(function(e){e.preventDefault(),processingBtn("#addStateForm","#stateBtnSave","loading"),$.ajax({url:stateSaveUrl,type:"POST",data:$(this).serialize(),success:function(e){e.success&&(displaySuccessMessage(e.message),$("#addStateModal").modal("hide"),window.livewire.emit("refresh"))},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){processingBtn("#addStateForm","#stateBtnSave")}})})),$(document).on("click",".edit-btn",(function(e){var t=$(e.currentTarget).attr("data-id");renderData(t)})),window.renderData=function(e){$.ajax({url:stateUrl+"/"+e+"/edit",type:"GET",success:function(e){e.success&&($("#stateId").val(e.data.id),$("#editName").val(e.data.name),$("#editCountryId").val(e.data.country_id).trigger("change"),$("#editModal").appendTo("body").modal("show"))},error:function(e){displayErrorMessage(e.responseJSON.message)}})},$(document).on("submit","#editForm",(function(e){e.preventDefault(),processingBtn("#editForm","#btnEditSave","loading");var t=$("#stateId").val();$.ajax({url:stateUrl+"/"+t,type:"put",data:$(this).serialize(),success:function(e){e.success&&(displaySuccessMessage(e.message),$("#editModal").modal("hide"),window.livewire.emit("refresh"))},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){processingBtn("#editForm","#btnEditSave")}})})),$(document).on("click",".delete-btn",(function(e){var t=$(e.currentTarget).attr("data-id");swal({title:Lang.get("messages.common.delete")+" !",text:Lang.get("messages.common.are_you_sure_want_to_delete")+'"'+Lang.get("messages.company.state")+'" ?',type:"warning",showCancelButton:!0,closeOnConfirm:!1,showLoaderOnConfirm:!0,confirmButtonColor:"#6777ef",cancelButtonColor:"#d33",cancelButtonText:Lang.get("messages.common.no"),confirmButtonText:Lang.get("messages.common.yes")},(function(){window.livewire.emit("deleteState",t)}))})),document.addEventListener("delete",(function(){swal({title:Lang.get("messages.common.deleted")+" !",text:Lang.get("messages.company.state")+Lang.get("messages.common.has_been_deleted"),type:"success",confirmButtonColor:"#6777ef",timer:2e3})})),$("#addStateModal").on("hidden.bs.modal",(function(){$("#countryID").val("").trigger("change"),resetModalForm("#addStateForm","#StateValidationErrorsBox")})),$("#editModal").on("hidden.bs.modal",(function(){resetModalForm("#editForm","#editValidationErrorsBox")})),$(document).ready((function(){$("#filter_country").on("change",(function(e){var t=$("#filter_country").select2("val");window.livewire.emit("changeFilter","filterCountry",t)}))}))})();