(()=>{"use strict";$(document).on("click",".addCountryModal",(function(){$("#addCountryModal").appendTo("body").modal("show")})),$(document).on("submit","#addCountryForm",(function(e){e.preventDefault(),processingBtn("#addCountryForm","#countryBtnSave","loading"),$.ajax({url:countrySaveUrl,type:"POST",data:$(this).serialize(),success:function(e){e.success&&(displaySuccessMessage(e.message),$("#addCountryModal").modal("hide"),window.livewire.emit("refresh"))},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){processingBtn("#addCountryForm","#countryBtnSave")}})})),$(document).on("click",".edit-btn",(function(e){var o=$(e.currentTarget).data("id");renderData(o)})),window.renderData=function(e){$.ajax({url:countryUrl+"/"+e+"/edit",type:"GET",success:function(e){e.success&&($("#countryId").val(e.data.id),$("#editName").val(e.data.name),$("#editShortCode").val(e.data.short_code),$("#editPhoneCode").val(e.data.phone_code),$("#editModal").appendTo("body").modal("show"))},error:function(e){displayErrorMessage(e.responseJSON.message)}})},$(document).on("submit","#editForm",(function(e){e.preventDefault(),processingBtn("#editForm","#btnEditSave","loading");var o=$("#countryId").val();$.ajax({url:countryUrl+"/"+o,type:"put",data:$(this).serialize(),success:function(e){e.success&&(displaySuccessMessage(e.message),$("#editModal").modal("hide"),window.livewire.emit("refresh"))},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){processingBtn("#editForm","#btnEditSave")}})})),$(document).on("click",".delete-btn",(function(e){var o=$(e.currentTarget).attr("data-id");swal({title:Lang.get("messages.common.delete")+" !",text:Lang.get("messages.common.are_you_sure_want_to_delete")+'"'+Lang.get("messages.company.country")+'" ?',type:"warning",showCancelButton:!0,closeOnConfirm:!1,showLoaderOnConfirm:!0,confirmButtonColor:"#6777ef",cancelButtonColor:"#d33",cancelButtonText:Lang.get("messages.common.no"),confirmButtonText:Lang.get("messages.common.yes")},(function(){window.livewire.emit("deleteCountry",o)}))})),document.addEventListener("delete",(function(){swal({title:Lang.get("messages.common.deleted")+" !",text:Lang.get("messages.company.country")+Lang.get("messages.common.has_been_deleted"),type:"success",confirmButtonColor:"#6777ef",timer:2e3})})),$("#addCountryModal").on("hidden.bs.modal",(function(){resetModalForm("#addCountryForm","#countryValidationErrorsBox")})),$("#editModal").on("hidden.bs.modal",(function(){resetModalForm("#editForm","#editValidationErrorsBox")}))})();