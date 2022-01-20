$(document).ready(function () {
    'use strict';

    $('#locationId,#industryId,#ownershipTypeId,#companySizeId,#countryId,#stateId,#cityId').
        select2({
            width: (!employerPanel) ? 'calc(100% - 44px)' : '100%',
        });
    $('#establishedIn,#countryID,#stateID').
        select2({
            width: '100%',
        });

    $('#details').summernote({
        minHeight: 200,
        height: 200,
        placeholder: 'Enter Employer Details...',
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']],
            ['para', ['paragraph']]],
    });

    $('#editDetails').summernote({
        minHeight: 200,
        height: 200,
        placeholder: 'Enter Employer Details...',
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']],
            ['para', ['paragraph']]],
    });

    $('#description, #ownershipDescription').summernote({
        minHeight: 200,
        height: 200,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']],
            ['para', ['paragraph']]],
    });


    $('#countryId').on('change', function () {
        $.ajax({
            url: companyStateUrl,
            type: 'get',
            dataType: 'json',
            data: { postal: $(this).val() },
            success: function (data) {
                $('#stateId').empty();
                $('#stateId').
                    append(
                        $('<option value=""></option>').text('Select State'));
                $.each(data.data, function (i, v) {
                    $('#stateId').
                        append($('<option></option>').attr('value', i).text(v));
                });
                if (isEdit && stateId) {
                    $('#stateId').val(stateId).trigger('change');
                }
            },
        });
    });

    $('#stateId').on('change', function () {
        $.ajax({
            url: companyCityUrl,
            type: 'get',
            dataType: 'json',
            data: {
                state: $(this).val(),
                country: $('#countryId').val(),
            },
            success: function (data) {
                $('#cityId').empty();
                $.each(data.data, function (i, v) {
                    $('#cityId').
                        append(
                            $('<option ></option>').attr('value', i).text(v));
                });
                if (isEdit && cityId) {
                    $('#cityId').val(cityId).trigger('change');
                }
            },
        });
    });
    if (isEdit & countryId) {
        $('#countryId').val(countryId).trigger('change');
    }

    $(document).on('change', '#logo', function () {
        let validFile = isValidFile($(this), '#validationErrorsBox');
        if (validFile) {
            displayPhoto(this, '#logoPreview');
            $('#btnSave').prop('disabled', false);
        } else {
            $('#btnSave').prop('disabled', true);
        }
    });

    $(document).on('submit', '#addCompanyForm', function (e) {
        $('#btnSave').prop('disabled', true);
        if (!checkSummerNoteEmpty('#details',
            'Employer Details field is required.', 1)) {
            e.preventDefault();
            $('#btnSave').attr('disabled', false);
            return false;
        }
    });
    $('#addCompanyForm,#editCompanyForm').submit(function () {
        if ($('#error-msg').text() !== '') {
            $('#phoneNumber').focus();
            return false;
        }
    });
    $(document).on('submit', '#editCompanyForm', function (e) {
        $('#btnSave').prop('disabled', true);
        if (!checkSummerNoteEmpty('#editDetails',
            'Employer Details field is required.', 1)) {
            e.preventDefault();
            $('#btnSave').attr('disabled', false);
            return false;
        }
    });
    $(document).on('submit', '#addCompanyForm,#editCompanyForm', function (e) {
        e.preventDefault();

        $('#addCompanyForm,#editCompanyForm').
            find('input:text:visible:first').
            focus();

        let facebookUrl = $('#facebookUrl').val();
        let twitterUrl = $('#twitterUrl').val();
        let linkedInUrl = $('#linkedInUrl').val();
        let googlePlusUrl = $('#googlePlusUrl').val();
        let pinterestUrl = $('#pinterestUrl').val();

        let facebookExp = new RegExp(
            /^(https?:\/\/)?((m{1}\.)?)?((w{3}\.)?)facebook.[a-z]{2,3}\/?.*/i);
        let twitterExp = new RegExp(
            /^(https?:\/\/)?((m{1}\.)?)?((w{3}\.)?)twitter\.[a-z]{2,3}\/?.*/i);
        let googlePlusExp = new RegExp(
            /^(https?:\/\/)?((w{3}\.)?)?(plus\.)?(google\.[a-z]{2,3})\/?(([a-zA-Z 0-9._])?).*/i);
        let linkedInExp = new RegExp(
            /^(https?:\/\/)?((w{3}\.)?)linkedin\.[a-z]{2,3}\/?.*/i);
        let pinterestExp = new RegExp(
            /^(https?:\/\/)?((w{3}\.)?)pinterest\.[a-z]{2,3}\/?.*/i);

        urlValidation(facebookUrl, facebookExp);
        urlValidation(twitterUrl, twitterExp);
        urlValidation(linkedInUrl, linkedInExp);
        urlValidation(googlePlusUrl, googlePlusExp);
        urlValidation(pinterestUrl, pinterestExp);

        if (!urlValidation(facebookUrl, facebookExp)) {
            displayErrorMessage('Please enter a valid Facebook Url');
            $('#btnSave').prop('disabled', false);
            return false;
        }
        if (!urlValidation(twitterUrl, twitterExp)) {
            displayErrorMessage('Please enter a valid Twitter Url');
            $('#btnSave').prop('disabled', false);
            return false;
        }
        if (!urlValidation(googlePlusUrl, googlePlusExp)) {
            displayErrorMessage('Please enter a valid Google Plus Url');
            $('#btnSave').prop('disabled', false);
            return false;
        }
        if (!urlValidation(linkedInUrl, linkedInExp)) {
            displayErrorMessage('Please enter a valid Linkedin Url');
            $('#btnSave').prop('disabled', false);
            return false;
        }
        if (!urlValidation(pinterestUrl, pinterestExp)) {
            displayErrorMessage('Please enter a valid Pinterest Url');
            $('#btnSave').prop('disabled', false);
            return false;
        }
        $('#addCompanyForm,#editCompanyForm')[0].submit();

        return true;
    });
});

// industry
$(document).on('click', '.addIndustryModal', function () {
    $('#addModal').appendTo('body').modal('show');
});

$(document).on('submit', '#addNewForm', function (e) {
    e.preventDefault();
    if (!checkSummerNoteEmpty('#description',
        'Description field is required.', 1)) {
        return true;
    }
    processingBtn('#addNewForm', '#btnSave', 'loading');
    $.ajax({
        url: industrySaveUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addModal').modal('hide');
                let data = {
                    id: result.data.id,
                    text: result.data.name,
                };
                let newOption = new Option(data.text, data.id, false, true);
                $('#industryId').append(newOption).trigger('change');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#addNewForm', '#btnSave');
        },
    });
});

//ownership type 
$(document).on('click', '.addOwnerShipTypeModal', function () {
    $('#addOwnershipModal').appendTo('body').modal('show');
});

$(document).on('submit', '#addOwnershipForm', function (e) {
    e.preventDefault();
    if (!checkSummerNoteEmpty('#ownershipDescription',
        'Description field is required.')) {
        return true;
    }
    processingBtn('#addOwnershipForm', '#ownershipBtnSave', 'loading');
    $.ajax({
        url: ownerShipTypeSaveUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addOwnershipModal').modal('hide');
                let data = {
                    id: result.data.id,
                    text: result.data.name,
                };
                let newOption = new Option(data.text, data.id, false, true);
                $('#ownershipTypeId').append(newOption).trigger('change');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#addOwnershipForm', '#ownershipBtnSave');
        },
    });
});

$('#addOwnershipModal').on('hidden.bs.modal', function () {
    resetModalForm('#addOwnershipForm', '#ownershipValidationErrorsBox');
    $('#ownershipDescription').summernote('code', '');
});

//country
$(document).on('click', '.addCountryModal', function () {
    $('#addCountryModal').appendTo('body').modal('show');
});

$(document).on('submit', '#addCountryForm', function (e) {
    e.preventDefault();
    processingBtn('#addCountryForm', '#countryBtnSave', 'loading');
    $.ajax({
        url: countrySaveUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addCountryModal').modal('hide');
                let data = {
                    id: result.data.id,
                    text: result.data.name,
                };
                let newOption = new Option(data.text, data.id, false, true);
                $('#countryId').append(newOption).trigger('change');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#addCountryForm', '#countryBtnSave');
        },
    });
});
$('#addCountryModal').on('hidden.bs.modal', function () {
    resetModalForm('#addCountryForm', '#countryValidationErrorsBox');
});
// state
$(document).on('click', '.addStateModal', function () {
    $('#addStateModal').appendTo('body').modal('show');
});

$(document).on('submit', '#addStateForm', function (e) {
    e.preventDefault();
    processingBtn('#addStateForm', '#stateBtnSave', 'loading');
    $.ajax({
        url: stateSaveUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addStateModal').modal('hide');
                let data = {
                    id: result.data.id,
                    text: result.data.name,
                };
                let newOption = new Option(data.text, data.id, false, true);
                $('#stateId').append(newOption).trigger('change');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#addStateForm', '#stateBtnSave');
        },
    });
});
$('#addStateModal').on('hidden.bs.modal', function () {
    $('#countryID').val('').trigger('change');
    resetModalForm('#addStateForm', '#StateValidationErrorsBox');
});

//city
$(document).on('click', '.addCityModal', function () {
    $('#addCityModal').appendTo('body').modal('show');
});

$(document).on('submit', '#addCityForm', function (e) {
    e.preventDefault();
    processingBtn('#addCityForm', '#cityBtnSave', 'loading');
    $.ajax({
        url: citySaveUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addCityModal').modal('hide');
                let data = {
                    id: result.data.id,
                    text: result.data.name,
                };
                let newOption = new Option(data.text, data.id, false, true);
                $('#cityId').append(newOption).trigger('change');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#addCityForm', '#cityBtnSave');
        },
    });
});

$('#addCityModal').on('hidden.bs.modal', function () {
    $('#stateID').val('').trigger('change');
    resetModalForm('#addCityForm', '#cityValidationErrorsBox');
});

//company size
$(document).on('click', '.addCompanySizeModal', function () {
    $('#addCompanySizeModal').appendTo('body').modal('show');
});

$(document).on('submit', '#addCompanySizeForm', function (e) {
    e.preventDefault();
    processingBtn('#addCompanySizeForm', '#companySizeBtnSave', 'loading');
    $.ajax({
        url: companySizeSaveUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addCompanySizeModal').modal('hide');
                let data = {
                    id: result.data.id,
                    text: result.data.size,
                };
                let newOption = new Option(data.text, data.id, false, true);
                $('#companySizeId').append(newOption).trigger('change');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#addCompanySizeForm', '#companySizeBtnSave');
        },
    });
});

$('#addCompanySizeModal').on('shown.bs.modal', function () {
    $('#size').focus();
});

$('#addCompanySizeModal').on('hidden.bs.modal', function () {
    resetModalForm('#addCompanySizeForm', '#companySizeValidationErrorsBox');
});
