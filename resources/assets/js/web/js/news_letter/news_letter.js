'use strict';

$(document).on('submit', '#newsLetterForm', function (event) {
    event.preventDefault();
    let email = $('#mc-email').val();
    let emailExp = new RegExp(
        /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
    let emailCheck = (email == '' ? true : (email.match(
        emailExp) ? true : false));
    if (!emailCheck) {
        displayErrorMessage('Please enter a valid Email');
        return false;
    }
    let loadingButton = jQuery(this).find('#btnLetterSave');
    loadingButton.button('loading');
    $.ajax({
        url: createNewLetterUrl,
        type: 'post',
        data: new FormData($(this)[0]),
        processData: false,
        contentType: false,
        success: function (result) {
            displaySuccessMessage(result.message);
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            $('#mc-email').val('');
            loadingButton.button('reset');
        },
    });
});
