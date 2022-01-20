'use strict';

window.checkGoogleReCaptcha = function (registerType) {
    let response = grecaptcha.getResponse();
    if (response.length == 0) {
        displayErrorMessage('You must verify google recaptcha.');
        processingBtn(
            registerType == 1 ? '#addCandidateNewForm' : '#addEmployerNewForm',
            registerType == 1 ? '#btnCandidateSave' : '#btnEmployerSave');

        return false;
    }

    return true;
};
