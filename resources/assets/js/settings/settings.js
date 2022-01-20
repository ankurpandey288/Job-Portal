'use strict';

$(document).on('change', '#logo', function () {
    if (isValidFile($(this), '#validationErrorsBox')) {
        displayPhoto(this, '#logoPreview');
    }
    $('#validationErrorsBox').delay(5000).slideUp(300);
});

$(document).on('change', '#footerLogo', function () {
    if (isValidFile($(this), '#validationErrorsBox')) {
        displayPhoto(this, '#footerLogoPreview');
    }
    $('#validationErrorsBox').delay(5000).slideUp(300);
});

window.displayFavicon = function (input, selector) {
    let displayPreview = true;
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            let image = new Image();
            image.src = e.target.result;
            image.onload = function () {
                if ((image.height != 16 || image.width != 16) &&
                    (image.height != 32 || image.width != 32)) {
                    $('#favicon').val('');
                    $('#validationErrorsBox').removeClass('d-none');
                    $('#validationErrorsBox').
                        html('The image must be of pixel 16 x 16 and 32 x 32.').
                        show();
                    return false;
                }
                $(selector).attr('src', e.target.result);
                displayPreview = true;
            };
        };
        if (displayPreview) {
            reader.readAsDataURL(input.files[0]);
            $(selector).show();
        }
    }
};

window.isValidFavicon = function (inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['gif', 'png', 'ico']) == -1) {
        $(inputSelector).val('');
        $(validationMessageSelector).removeClass('d-none');
        $(validationMessageSelector).
            html('The image must be a file of type: gif, ico, png.').
            show();
        return false;
    }
    $(validationMessageSelector).hide();
    return true;
};

$(document).on('change', '#favicon', function () {
    $('#validationErrorsBox').addClass('d-none');
    if (isValidFavicon($(this), '#validationErrorsBox')) {
        displayFavicon(this, '#faviconPreview');
    }
    $('#validationErrorsBox').delay(5000).slideUp(300);
});

$('#facebookUrl').keyup(function () {
    this.value = this.value.toLowerCase();
});
$('#twitterUrl').keyup(function () {
    this.value = this.value.toLowerCase();
});
$('#googleUrl').keyup(function () {
    this.value = this.value.toLowerCase();
});
$('#linkedInUrl').keyup(function () {
    this.value = this.value.toLowerCase();
});
$('#editFrontSettingForm').submit(function () {
    if ($('#error-msg').text() !== '') {
        $('#phoneNumber').focus();
        return false;
    }
});
$(document).on('submit', '#editGeneralForm', function (event) {
    event.preventDefault();

    $('#companyUrl').focus();

    let companyUrl = $('#companyUrl').val();

    let companyUrlExp = new RegExp(
        /^(http|https)?:\/\/[a-zA-Z0-9-\.]+\.[a-z]{2,4}/);

    let companyUrlCheck = (companyUrl == '' ? true : (companyUrl.match(
        companyUrlExp) ? true : false));
    if (!companyUrlCheck) {
        displayErrorMessage('Please enter a valid Company Url');
        return false;
    }

    $('#editGeneralForm')[0].submit();

    return true;
});

$(document).on('submit', '#editForm', function (event) {
    event.preventDefault();

    $('#editForm').
        find('input:text:visible:first').
        focus();

    let facebookUrl = $('#facebookUrl').val();
    let twitterUrl = $('#twitterUrl').val();
    let googlePlusUrl = $('#googlePlusUrl').val();
    let linkedInUrl = $('#linkedInUrl').val();

    let facebookExp = new RegExp(
        /^(https?:\/\/)?((m{1}\.)?)?((w{2,3}\.)?)facebook.[a-z]{2,3}\/?.*/i);
    let twitterExp = new RegExp(
        /^(https?:\/\/)?((m{1}\.)?)?((w{2,3}\.)?)twitter\.[a-z]{2,3}\/?.*/i);
    let googlePlusExp = new RegExp(
        /^(https?:\/\/)?(plus\.)?(google\.[a-z]{2,3})\/?(([a-zA-Z 0-9._])?).*/i);
    let linkedInExp = new RegExp(
        /^(https?:\/\/)?((w{2,3}\.)?)linkedin\.[a-z]{2,3}\/?.*/i);

    let facebookCheck = (facebookUrl == '' ? true : (facebookUrl.match(
        facebookExp) ? true : false));
    if (!facebookCheck) {
        displayErrorMessage('Please enter a valid Facebook Url');
        return false;
    }
    let twitterCheck = (twitterUrl == '' ? true : (twitterUrl.match(twitterExp)
        ? true
        : false));
    if (!twitterCheck) {
        displayErrorMessage('Please enter a valid Twitter Url');
        return false;
    }
    let googlePlusCheck = (googlePlusUrl == '' ? true : (googlePlusUrl.match(
        googlePlusExp) ? true : false));
    if (!googlePlusCheck) {
        displayErrorMessage('Please enter a valid Google Plus Url');
        return false;
    }
    let linkedInCheck = (linkedInUrl == '' ? true : (linkedInUrl.match(
        linkedInExp) ? true : false));
    if (!linkedInCheck) {
        displayErrorMessage('Please enter a valid Linkedin Url');
        return false;
    }
    $('#editForm')[0].submit();

    return true;
});

$('#aboutUs').summernote({
    minHeight: 200,
    height: 200,
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough']],
        ['para', ['paragraph']]],
});

$(document).on('submit', '#aboutUsForm', function (event) {
    event.preventDefault();
    if (!checkSummerNoteEmpty('#aboutUs', 'About Us field is required.')) {
        return false;
    }

    $('#aboutUsForm')[0].submit();
});

$(document).on('click', '#btnSaveEnvData', function (event) {
    event.preventDefault();
    swal({
            title: Lang.get('messages.setting.configuration_update') + ' !',
            text: Lang.get('messages.setting.update_application_configuration'),
            type: 'warning',
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            confirmButtonColor: '#6777ef',
            cancelButtonColor: '#d33',
            cancelButtonText: Lang.get('messages.common.no'),
            confirmButtonText: Lang.get('messages.common.yes'),
        },
        function () {
            $('#envUpdateForm')[0].submit();
        });
});

$(document).on('change', '#enableEdit', function () {
    if ($(this).prop('checked')) {
        $('#envUpdateForm').find('input:text').attr('disabled', false);
        $('#enableCookie').attr('disabled', false);
        $('#btnSaveEnvData').attr('disabled', false);
        $('#envUpdateText').text(disableEditText);
    } else {
        $('#envUpdateForm').find('input:text').attr('disabled', true);
        $('#enableCookie').attr('disabled', true);
        $('#btnSaveEnvData').attr('disabled', true);
        $('#envUpdateText').text(enableEditText);
    }
});

$(document).on('change', '#enableCookie', function () {
    if ($(this).prop('checked'))
        $('#enableCookieText').text(disableCookie);
    else
        $('#enableCookieText').text(enableCookie);
});
