(()=>{"use strict";var e=document.querySelector("#phoneNumber"),o=document.querySelector("#error-msg"),n=document.querySelector("#valid-msg"),r=["Invalid number","Invalid country code","Too short","Too long","Invalid number"],t=window.intlTelInput(e,{initialCountry:"auto",separateDialCode:!0,geoIpLookup:function(e,o){$.get("https://ipinfo.io",(function(){}),"jsonp").always((function(o){var n=o&&o.country?o.country:"";e(n)}))},utilsScript}),i=function(){e.classList.remove("error"),o.innerHTML="",o.classList.add("hide"),n.classList.add("hide")};if(e.addEventListener("blur",(function(){if(i(),e.value.trim())if(t.isValidNumber())n.classList.remove("hide");else{e.classList.add("error");var a=t.getValidationError();o.innerHTML=r[a],o.classList.remove("hide")}})),e.addEventListener("change",i),e.addEventListener("keyup",i),"undefined"!=typeof phoneNo&&""!==phoneNo&&setTimeout((function(){$("#phoneNumber").trigger("change")}),500),$("#phoneNumber").on("blur keyup change countrychange",(function(){"undefined"!=typeof phoneNo&&""!==phoneNo&&(t.setNumber("+"+phoneNo),phoneNo="");var e=t.selectedCountryData.dialCode;$("#prefix_code").val(e)})),isEdit){var a=t.selectedCountryData.dialCode;$("#prefix_code").val(a)}var u=$("#phoneNumber").val().replace(/\s/g,"");$("#phoneNumber").val(u)})();