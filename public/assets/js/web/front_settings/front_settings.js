(()=>{"use strict";$(document).on("change","#advertiseImage",(function(){$("#validationErrorsBox").addClass("d-none"),isValidAdvertise($(this),"#validationErrorsBox")&&displayAdvertiseImage(this,"#advertisePreview"),$("#validationErrorsBox").delay(5e3).slideUp(300)})),window.displayAdvertiseImage=function(e,i){var a=!0;if(e.files&&e.files[0]){var r=new FileReader;r.onload=function(e){var r=new Image;r.src=e.target.result,r.onload=function(){if(450!=r.height||630!=r.width)return $("#advertiseImage").val(""),$("#validationErrorsBox").removeClass("d-none"),$("#validationErrorsBox").html("The image must be of pixel 450 x 630").show(),!1;$(i).attr("src",e.target.result),a=!0}},a&&(r.readAsDataURL(e.files[0]),$(i).show())}},window.isValidAdvertise=function(e,i){var a=$(e).val().split(".").pop().toLowerCase();return-1==$.inArray(a,["jpg","jpeg","png"])?($(e).val(""),$(i).removeClass("d-none"),$(i).html("The image must be a file of type: jpg, jpeg, png.").show(),!1):($(i).hide(),!0)}})();