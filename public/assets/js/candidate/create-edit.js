$(document).ready((function(){"use strict";function a(){"0"==$("input[name='immediate_available']:checked").val()?$(".available-at").show():$(".available-at").hide()}$("#maritalStatusId, #countryId, #careerLevelId, #industryId, #functionalAreaId,#stateId,#cityId, #skillId, #languageId").select2({width:"calc(100% - 44px)"}),$("#countryID,#stateID,#salaryCurrencyId").select2({width:"100%"}),$("#birthDate").datetimepicker(DatetimepickerDefaults({format:"YYYY-MM-DD",useCurrent:!0,sideBySide:!0,maxDate:new Date})),$("#availableAt").datetimepicker(DatetimepickerDefaults({format:"YYYY-MM-DD",useCurrent:!1,sideBySide:!0,minDate:new Date})),setTimeout((function(){$("input[type=radio][name=immediate_available]").trigger("change")}),300),$("#countryId").on("change",(function(){$.ajax({url:companyStateUrl,type:"get",dataType:"json",data:{postal:$(this).val()},success:function(a){$("#stateId").empty(),$("#stateId").append($('<option value=""></option>').text("Select State")),$.each(a.data,(function(a,e){$("#stateId").append($("<option></option>").attr("value",a).text(e))})),isEdit&&stateId&&$("#stateId").val(stateId).trigger("change")}})})),$("#stateId").on("change",(function(){$.ajax({url:companyCityUrl,type:"get",dataType:"json",data:{state:$(this).val(),country:$("#countryId").val()},success:function(a){$("#cityId").empty(),$.each(a.data,(function(a,e){$("#cityId").append($("<option></option>").attr("value",a).text(e))})),isEdit&&cityId&&$("#cityId").val(cityId).trigger("change")}})})),isEdit&countryId&&$("#countryId").val(countryId).trigger("change"),$("#createCandidatesForm,#editCandidatesForm").submit((function(){if(""!==$("#error-msg").text())return $("#phoneNumber").focus(),!1})),$("input[type=radio][name=immediate_available]").change((function(){1==$("input[name='immediate_available']:checked").val()?$(".available-at").hide():$(".available-at").show()})),$("#available").click((function(){a()})),$("#not_available").click((function(){a()})),$(document).on("submit","#createCandidatesForm,#editCandidatesForm",(function(a){a.preventDefault(),$("#createCandidatesForm,#editCandidatesForm").find("input:text:visible:first").focus();var e=$("#facebookUrl").val(),t=$("#twitterUrl").val(),n=$("#linkedInUrl").val(),d=$("#googlePlusUrl").val(),i=$("#pinterestUrl").val(),o=new RegExp(/^(https?:\/\/)?((m{1}\.)?)?((w{3}\.)?)facebook.[a-z]{2,3}\/?.*/i),r=new RegExp(/^(https?:\/\/)?((m{1}\.)?)?((w{3}\.)?)twitter\.[a-z]{2,3}\/?.*/i),s=new RegExp(/^(https?:\/\/)?((w{3}\.)?)?(plus\.)?(google\.[a-z]{2,3})\/?(([a-zA-Z 0-9._])?).*/i),l=new RegExp(/^(https?:\/\/)?((w{3}\.)?)linkedin\.[a-z]{2,3}\/?.*/i),c=new RegExp(/^(https?:\/\/)?((w{3}\.)?)pinterest\.[a-z]{2,3}\/?.*/i);return urlValidation(e,o),urlValidation(t,r),urlValidation(n,l),urlValidation(d,s),urlValidation(i,c),urlValidation(e,o)?urlValidation(t,r)?urlValidation(d,s)?urlValidation(n,l)?urlValidation(i,c)?($("#createCandidatesForm,#editCandidatesForm")[0].submit(),!0):(displayErrorMessage("Please enter a valid Pinterest Url"),!1):(displayErrorMessage("Please enter a valid Linkedin Url"),!1):(displayErrorMessage("Please enter a valid Google Plus Url"),!1):(displayErrorMessage("Please enter a valid Twitter Url"),!1):(displayErrorMessage("Please enter a valid Facebook Url"),!1)}))})),$("#description, #skillDescription, #martialDescription").summernote({minHeight:200,height:200,toolbar:[["style",["bold","italic","underline","clear"]],["font",["strikethrough"]],["para",["paragraph"]]]}),$(document).on("click",".addMaritalStatusModal",(function(){$("#addMaritalStatusModal").appendTo("body").modal("show")})),$(document).on("submit","#addMaritalStatusForm",(function(a){if(a.preventDefault(),!checkSummerNoteEmpty("#martialDescription","Description field is required.",1))return!0;processingBtn("#addMaritalStatusForm","#maritalStatusBtnSave","loading"),$.ajax({url:maritalStatusSaveUrl,type:"POST",data:$(this).serialize(),success:function(a){if(a.success){displaySuccessMessage(a.message),$("#addMaritalStatusModal").modal("hide");var e={id:a.data.id,text:a.data.marital_status},t=new Option(e.text,e.id,!1,!0);$("#maritalStatusId").append(t).trigger("change")}},error:function(a){displayErrorMessage(a.responseJSON.message)},complete:function(){processingBtn("#addMaritalStatusForm","#maritalStatusBtnSave")}})})),$("#addMaritalStatusModal").on("hidden.bs.modal",(function(){resetModalForm("#addMaritalStatusForm","#maritalStatusValidationErrorsBox"),$("#martialDescription").summernote("code","")})),$(document).on("click",".addSkillModal",(function(){$("#addSkillModal").appendTo("body").modal("show")})),$(document).on("submit","#addSkillForm",(function(a){if(a.preventDefault(),!checkSummerNoteEmpty("#skillDescription","Description field is required."))return!0;processingBtn("#addSkillForm","#skillBtnSave","loading"),$.ajax({url:skillSaveUrl,type:"POST",data:$(this).serialize(),success:function(a){if(a.success){displaySuccessMessage(a.message),$("#addSkillModal").modal("hide");var e={id:a.data.id,text:a.data.name},t=new Option(e.text,e.id,!1,!0);$("#skillId").append(t).trigger("change")}},error:function(a){displayErrorMessage(a.responseJSON.message)},complete:function(){processingBtn("#addSkillForm","#skillBtnSave")}})})),$("#addSkillModal").on("hidden.bs.modal",(function(){resetModalForm("#addSkillForm","#skillValidationErrorsBox"),$("#skillDescription").summernote("code","")})),$(document).on("click",".addLanguageModal",(function(){$("#addLanguageModal").appendTo("body").modal("show")})),$(document).on("submit","#addLanguageForm",(function(a){a.preventDefault(),processingBtn("#addLanguageForm","#languageBtnSave","loading"),$.ajax({url:languageSaveUrl,type:"POST",data:$(this).serialize(),success:function(a){if(a.success){displaySuccessMessage(a.message),$("#addLanguageModal").modal("hide");var e={id:a.data.id,text:a.data.language},t=new Option(e.text,e.id,!1,!0);$("#languageId").append(t).trigger("change"),setTimeout((function(){$("#languageBtnSave").button("reset")}),1e3)}},error:function(a){displayErrorMessage(a.responseJSON.message),setTimeout((function(){$("#languageBtnSave").button("reset")}),1e3)},complete:function(){setTimeout((function(){processingBtn("#addLanguageForm","#languageBtnSave")}),1e3)}})})),$("#addLanguageModal").on("hidden.bs.modal",(function(){resetModalForm("#addLanguageForm","#languageValidationErrorsBox")})),$(document).on("click",".addCountryModal",(function(){$("#addCountryModal").appendTo("body").modal("show")})),$(document).on("submit","#addCountryForm",(function(a){a.preventDefault(),processingBtn("#addCountryForm","#countryBtnSave","loading"),$.ajax({url:countrySaveUrl,type:"POST",data:$(this).serialize(),success:function(a){if(a.success){displaySuccessMessage(a.message),$("#addCountryModal").modal("hide");var e={id:a.data.id,text:a.data.name},t=new Option(e.text,e.id,!1,!0);$("#countryId").append(t).trigger("change")}},error:function(a){displayErrorMessage(a.responseJSON.message)},complete:function(){processingBtn("#addCountryForm","#countryBtnSave")}})})),$("#addCountryModal").on("hidden.bs.modal",(function(){resetModalForm("#addCountryForm","#countryValidationErrorsBox")})),$(document).on("click",".addStateModal",(function(){$("#addStateModal").appendTo("body").modal("show")})),$(document).on("submit","#addStateForm",(function(a){a.preventDefault(),processingBtn("#addStateForm","#stateBtnSave","loading"),$.ajax({url:stateSaveUrl,type:"POST",data:$(this).serialize(),success:function(a){if(a.success){displaySuccessMessage(a.message),$("#addStateModal").modal("hide");var e={id:a.data.id,text:a.data.name},t=new Option(e.text,e.id,!1,!0);$("#stateId").append(t).trigger("change")}},error:function(a){displayErrorMessage(a.responseJSON.message)},complete:function(){processingBtn("#addStateForm","#stateBtnSave")}})})),$("#addStateModal").on("hidden.bs.modal",(function(){$("#countryID").val("").trigger("change"),resetModalForm("#addStateForm","#StateValidationErrorsBox")})),$(document).on("click",".addCityModal",(function(){$("#addCityModal").appendTo("body").modal("show")})),$(document).on("submit","#addCityForm",(function(a){a.preventDefault(),processingBtn("#addCityForm","#cityBtnSave","loading"),$.ajax({url:citySaveUrl,type:"POST",data:$(this).serialize(),success:function(a){if(a.success){displaySuccessMessage(a.message),$("#addCityModal").modal("hide");var e={id:a.data.id,text:a.data.name},t=new Option(e.text,e.id,!1,!0);$("#cityId").append(t).trigger("change")}},error:function(a){displayErrorMessage(a.responseJSON.message)},complete:function(){processingBtn("#addCityForm","#cityBtnSave")}})})),$("#addCityModal").on("hidden.bs.modal",(function(){$("#stateID").val("").trigger("change"),resetModalForm("#addCityForm","#cityValidationErrorsBox")})),$(document).on("click",".addCareerLevelModal",(function(){$("#addCareerModal").appendTo("body").modal("show")})),$(document).on("submit","#addCareerForm",(function(a){a.preventDefault(),processingBtn("#addCareerForm","#careerBtnSave","loading"),$.ajax({url:careerLevelSaveUrl,type:"POST",data:$(this).serialize(),success:function(a){if(a.success){displaySuccessMessage(a.message),$("#addCareerModal").modal("hide");var e={id:a.data.id,text:a.data.level_name},t=new Option(e.text,e.id,!1,!0);$("#careerLevelId").append(t).trigger("change")}},error:function(a){displayErrorMessage(a.responseJSON.message)},complete:function(){processingBtn("#addCareerForm","#careerBtnSave")}})})),$("#addCareerModal").on("hidden.bs.modal",(function(){resetModalForm("#addCareerForm","#careerValidationErrorsBox")})),$(document).on("click",".addIndustryModal",(function(){$("#addModal").appendTo("body").modal("show")})),$(document).on("submit","#addNewForm",(function(a){if(a.preventDefault(),!checkSummerNoteEmpty("#description","Description field is required.",1))return!0;processingBtn("#addNewForm","#btnSave","loading"),$.ajax({url:industrySaveUrl,type:"POST",data:$(this).serialize(),success:function(a){if(a.success){displaySuccessMessage(a.message),$("#addModal").modal("hide");var e={id:a.data.id,text:a.data.name},t=new Option(e.text,e.id,!1,!0);$("#industryId").append(t).trigger("change")}},error:function(a){displayErrorMessage(a.responseJSON.message)},complete:function(){processingBtn("#addNewForm","#btnSave")}})})),$(document).on("click",".addFunctionalAreaModal",(function(){$("#addFunctionalModal").appendTo("body").modal("show")})),$(document).on("submit","#addFunctionalForm",(function(a){a.preventDefault(),processingBtn("#addFunctionalForm","#functionalBtnSave","loading"),$.ajax({url:functionalAreaSaveUrl,type:"POST",data:$(this).serialize(),success:function(a){if(a.success){displaySuccessMessage(a.message),$("#addFunctionalModal").modal("hide");var e={id:a.data.id,text:a.data.name},t=new Option(e.text,e.id,!1,!0);$("#functionalAreaId").append(t).trigger("change")}},error:function(a){displayErrorMessage(a.responseJSON.message)},complete:function(){processingBtn("#addFunctionalForm","#functionalBtnSave")}})})),$("#addFunctionalModal").on("hidden.bs.modal",(function(){resetModalForm("#addFunctionalForm","#functionalValidationErrorsBox")}));