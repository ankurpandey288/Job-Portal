(()=>{"use strict";$(document).ready((function(){$(document).on("click",".save-draft",(function(e){e.preventDefault(),submitForm("#applyJobForm","draft")})),$(document).on("click",".apply-job",(function(e){e.preventDefault(),submitForm("#applyJobForm","apply")})),window.submitForm=function(e,o){var t=new FormData($(document).find(e)[0]);t.append("application_type",o),$.ajax({url:applyJobUrl,type:"post",data:t,dataType:"JSON",contentType:!1,cache:!1,processData:!1,success:function(e){e.success&&(console.log(e),displaySuccessMessage(e.message),setTimeout((function(){window.location=jobDetailsUrl+"/"+e.data}),3e3))},error:function(e){displayErrorMessage(e.responseJSON.message)}})}}))})();