'use strict';
$('#loginTab a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
});
// store the currently selected tab in the hash value
$('ul.nav-tabs > li > a').on('shown.bs.tab', function (e) {
    var id = $(e.target).attr('href').substr(1);
    window.location.hash = id;
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
});
// on load of the page: switch to the currently selected tab
var hash = window.location.hash;
$('#loginTab a[href="' + hash + '"]').tab('show');

$('#candidate').on('hidden.bs.tab', function () {
    resetModalForm('#candidateForm', '#candidateValidationErrBox');
    console.log('candidate');
});
$('#employer').on('hidden.bs.tab', function () {
    resetModalForm('#employeeForm', '#employerValidationErrBox');
});

$(document).on('submit', '#addCandidateNewForm', function (e) {
    e.preventDefault();
    processingBtn('#addCandidateNewForm', '#btnCandidateSave', 'loading');

    if (isGoogleReCaptchaEnabled) {
        if (!checkGoogleReCaptcha(1))
            return true;
    }

    $.ajax({
        url: registerSaveUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                setTimeout(function () {
                    window.location = candidateLogInUrl;
                }, 1500);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#addCandidateNewForm', '#btnCandidateSave');
        },
    });
});

$(document).on('submit', '#addEmployerNewForm', function (e) {
    e.preventDefault();
    processingBtn('#addEmployerNewForm', '#btnEmployerSave', 'loading');

    if (isGoogleReCaptchaEnabled) {
        if (!checkGoogleReCaptcha(2))
            return true;
    }

    $.ajax({
        url: registerSaveUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                setTimeout(function () {
                    window.location = employerLogInUrl;
                }, 1500);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#addEmployerNewForm', '#btnEmployerSave');
        },
    });
});
