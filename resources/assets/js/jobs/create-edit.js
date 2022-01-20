$(document).ready(function () {
    'use strict';

    new AutoNumeric('#toSalary', {
        maximumValue: 200000,
        currencySymbol: '',
        digitGroupSeparator: '\,',
        decimalPlaces: 1,
        currencySymbolPlacement:
        AutoNumeric.options.currencySymbolPlacement.suffix,
    });

    new AutoNumeric('#fromSalary', {
        maximumValue: 90000,
        currencySymbol: '',
        digitGroupSeparator: '\,',
        decimalPlaces: 1,
        currencySymbolPlacement:
        AutoNumeric.options.currencySymbolPlacement.suffix,
    });

    $('#toSalary').on('keyup', function () {
        let fromSalary = parseInt(
            Math.trunc(removeCommas($('#fromSalary').val())));
        let toSalary = parseInt(Math.trunc(removeCommas($('#toSalary').val())));
        if (toSalary < fromSalary) {
            $('#toSalary').focus();
            $('#salaryToErrorMsg').
                text(Lang.get('messages.job.please_enter_salary_range_to_greater_than_salary_range_from'));
            $('.actions [href=\'#next\']').
                css({ 'opacity': '0.7', 'pointer-events': 'none' });
            $('#saveJob').attr('disabled', true);
        } else {
            $('#salaryToErrorMsg').text('');
            $('.actions [href=\'#next\']').
                css({ 'opacity': '1', 'pointer-events': 'inherit' });
            $('#saveJob').attr('disabled', false);
        }
    });

    $('#toSalary').on('wheel', function (e) {
        $(this).trigger('keyup');
    });

    $('#fromSalary').on('keyup', function () {
        let fromSalary = parseInt(
            Math.trunc(removeCommas($('#fromSalary').val())));
        let toSalary = parseInt(Math.trunc(removeCommas($('#toSalary').val())));
        if (toSalary < fromSalary) {
            $('#fromSalary').focus();
            $('#salaryToErrorMsg').
                text(Lang.get('messages.job.please_enter_salary_range_to_greater_than_salary_range_from'));
            $('.actions [href=\'#next\']').
                css({ 'opacity': '0.7', 'pointer-events': 'none' });
            $('#saveJob').attr('disabled', true);
        } else {
            $('#salaryToErrorMsg').text('');
            $('.actions [href=\'#next\']').
                css({ 'opacity': '1', 'pointer-events': 'inherit' });
            $('#saveJob').attr('disabled', false);
        }
    });

    $('#fromSalary').on('wheel', function (e) {
        $(this).trigger('keyup');
    });

    $('#jobTypeId,#jobCategoryId,#careerLevelsId,#jobShiftId,#countryId,#stateId,#cityId,#salaryPeriodsId,#requiredDegreeLevelId,#functionalAreaId').
        select2({
            width: (!employerPanel) ? 'calc(100% - 44px)' : '100%',
        });
    $('#preferenceId,#currencyId,#countryID,#stateID').
        select2({
            width: '100%',
        });
    $('#SkillId').select2({
        width: (!employerPanel) ? 'calc(100% - 44px)' : '100%',
        placeholder: 'Select Job Skill',
    });
    $('#tagId').select2({
        width: (!employerPanel) ? 'calc(100% - 44px)' : '100%',
        placeholder: 'Select Job Tag',
    });
    if (!$('#companyId').hasClass('.select2-hidden-accessible') &&
        $('#companyId').is('select')) {
        $('#companyId').select2({
            width: '100%',
            placeholder: 'Select Company',
        });
    }

    var date = new Date();
    date.setDate(date.getDate() + 1);
    $('.expiryDatepicker').datetimepicker(DatetimepickerDefaults({
        format: 'YYYY-MM-DD',
        useCurrent: false,
        sideBySide: true,
        minDate: new Date(),
    }));

    $('#createJobForm, #editJobForm').on('submit', function (e) {
        $('#saveJob,#draftJob').attr('disabled', true);
        if (!checkSummerNoteEmpty('#details',
            'Job Description field is required.', 1)) {
            e.preventDefault();
            $('#saveJob,#draftJob').attr('disabled', false);
            return false;
        }
        if ($('#salaryToErrorMsg').text() !== '') {
            $('#toSalary').focus();
            $('#saveJob,#draftJob').attr('disabled', false);
            return false;
        }
    });

    $('#details').summernote({
        minHeight: 200,
        height: 200,
        placeholder: 'Enter Job Details...',
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']],
            ['para', ['paragraph']]],
    });

    $('#jobTypeDescription, #jobCategoryDescription, #skillDescription, #salaryPeriodDescription, #jobShiftDescription, #jobTagDescription').summernote({
        minHeight: 200,
        height: 200,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']],
            ['para', ['paragraph']]],
    });

    $('#editDetails').summernote({
        minHeight: 200,
        height: 200,
        placeholder: 'Enter Job Details...',
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']],
            ['para', ['paragraph']]],
    });

    $('#countryId').on('change', function () {
        $.ajax({
            url: jobStateUrl,
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
            },
        });
    });

    $('#stateId').on('change', function () {
        $.ajax({
            url: jobCityUrl,
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
                        append($('<option></option>').attr('value', i).text(v));
                });
            },
        });
    });

    window.autoNumeric = function (formId, validationBox) {
        $(formId)[0].reset();
        $('select.select2Selector').each(function (index, element) {
            let drpSelector = '#' + $(this).attr('id');
            $(drpSelector).val('');
            $(drpSelector).trigger('change');
        });
        $(validationBox).hide();
    };
});
//job Type
$(document).on('click', '.addJobTypeModal', function () {
    $('#addJobTypeModal').appendTo('body').modal('show');
});

$(document).on('submit', '#addJobTypeForm', function (e) {
    e.preventDefault();
    if (!checkSummerNoteEmpty('#jobTypeDescription',
        'Description field is required.', 1)) {
        return true;
    }
    processingBtn('#addJobTypeForm', '#jobTypeBtnSave', 'loading');
    $.ajax({
        url: jobTypeSaveUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addJobTypeModal').modal('hide');
                let data = {
                    id: result.data.id,
                    text: result.data.name,
                };
                let newOption = new Option(data.text, data.id, false, true);
                $('#jobTypeId').append(newOption).trigger('change');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#addJobTypeForm', '#jobTypeBtnSave');
        },
    });
});
$('#addJobTypeModal').on('hidden.bs.modal', function () {
    resetModalForm('#addJobTypeForm', '#jobTypeValidationErrorsBox');
    $('#jobTypeDescription').summernote('code', '');
});
//job category
$(document).on('click', '.addJobCategoryModal', function () {
    $('#addJobCategoryModal').appendTo('body').modal('show');
});

$(document).on('submit', '#addJobCategoryForm', function (e) {
    e.preventDefault();
    processingBtn('#addJobCategoryForm', '#jobCategoryBtnSave', 'loading');
    if (!checkSummerNoteEmpty('#jobCategoryDescription',
        'Description field is required.')) {
        processingBtn('#addJobCategoryForm', '#jobCategoryBtnSave');
        return true;
    }

    $.ajax({
        url: jobCategorySaveUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addJobCategoryModal').modal('hide');
                let data = {
                    id: result.data.id,
                    text: result.data.name,
                };
                let newOption = new Option(data.text, data.id, false, true);
                $('#jobCategoryId').append(newOption).trigger('change');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#addJobCategoryForm', '#jobCategoryBtnSave');
        },
    });
});
$('#addJobCategoryModal').on('hidden.bs.modal', function () {
    resetModalForm('#addJobCategoryForm', '#jobCategoryValidationErrorsBox');
    $('#jobCategoryDescription').summernote('code', '');
});
//skill
$(document).on('click', '.addSkillModal', function () {
    $('#addSkillModal').appendTo('body').modal('show');
});

$(document).on('submit', '#addSkillForm', function (e) {
    e.preventDefault();
    if (!checkSummerNoteEmpty('#skillDescription',
        'Description field is required.')) {
        return true;
    }
    processingBtn('#addSkillForm', '#skillBtnSave', 'loading');
    $.ajax({
        url: skillSaveUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addSkillModal').modal('hide');
                let data = {
                    id: result.data.id,
                    text: result.data.name,
                };
                let newOption = new Option(data.text, data.id, false, true);
                $('#SkillId').append(newOption).trigger('change');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#addSkillForm', '#skillBtnSave');
        },
    });
});
$('#addSkillModal').on('hidden.bs.modal', function () {
    resetModalForm('#addSkillForm', '#skillValidationErrorsBox');
    $('#skillDescription').summernote('code', '');
});
//salary period
$(document).on('click', '.addSalaryPeriodModal', function () {
    $('#addSalaryPeriodModal').appendTo('body').modal('show');
});

$(document).on('submit', '#addSalaryPeriodForm', function (e) {
    e.preventDefault();
    if (!checkSummerNoteEmpty('#salaryPeriodDescription',
        'Description field is required.', 1)) {
        return true;
    }
    processingBtn('#addSalaryPeriodForm', '#salaryPeriodBtnSave', 'loading');
    $.ajax({
        url: salaryPeriodSaveUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addSalaryPeriodModal').modal('hide');
                let data = {
                    id: result.data.id,
                    text: result.data.period,
                };
                let newOption = new Option(data.text, data.id, false, true);
                $('#salaryPeriodsId').append(newOption).trigger('change');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#addSalaryPeriodForm', '#salaryPeriodBtnSave');
        },
    });
});
$('#addSalaryPeriodModal').on('hidden.bs.modal', function () {
    resetModalForm('#addSalaryPeriodForm', '#salaryPeriodValidationErrorsBox');
    $('#salaryPeriodDescription').summernote('code', '');
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
                console.log(result.data);
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
//career level
$(document).on('click', '.addCareerLevelModal', function () {
    $('#addCareerModal').appendTo('body').modal('show');
});

$(document).on('submit', '#addCareerForm', function (e) {
    e.preventDefault();
    processingBtn('#addCareerForm', '#careerBtnSave', 'loading');
    $.ajax({
        url: careerLevelSaveUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addCareerModal').modal('hide');
                let data = {
                    id: result.data.id,
                    text: result.data.level_name,
                };
                let newOption = new Option(data.text, data.id, false, true);
                $('#careerLevelsId').append(newOption).trigger('change');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#addCareerForm', '#careerBtnSave');
        },
    });
});
$('#addCareerModal').on('hidden.bs.modal', function () {
    resetModalForm('#addCareerForm', '#careerValidationErrorsBox');
});
//job shift
$(document).on('click', '.addJobShiftModal', function () {
    $('#addJobShiftModal').appendTo('body').modal('show');
});

$(document).on('submit', '#addJobShiftForm', function (e) {
    e.preventDefault();
    if (!checkSummerNoteEmpty('#jobShiftDescription',
        'Description field is required.', 1)) {
        processingBtn('#addJobShiftForm', '#jobShiftBtnSave');
        return true;
    }
    processingBtn('#addJobShiftForm', '#jobShiftBtnSave', 'loading');
    $.ajax({
        url: jobShiftSaveUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addJobShiftModal').modal('hide');
                let data = {
                    id: result.data.id,
                    text: result.data.shift,
                };
                let newOption = new Option(data.text, data.id, false, true);
                $('#jobShiftId').append(newOption).trigger('change');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#addJobShiftForm', '#jobShiftBtnSave');
        },
    });
});
$('#addJobShiftModal').on('hidden.bs.modal', function () {
    resetModalForm('#addJobShiftForm', '#jobShiftValidationErrorsBox');
    $('#jobShiftDescription').summernote('code', '');
});
//job tag
$(document).on('click', '.addJobTagModal', function () {
    $('#addJobTagModal').appendTo('body').modal('show');
});

$(document).on('submit', '#addJobTagForm', function (e) {
    e.preventDefault();
    processingBtn('#addJobTagForm', '#jobTagBtnSave', 'loading');
    if (!checkSummerNoteEmpty('#jobTagDescription',
        'Description field is required.')) {
        processingBtn('#addJobTagForm', '#jobTagBtnSave');
        return true;
    }
    $.ajax({
        url: jobTagSaveUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addJobTagModal').modal('hide');
                let data = {
                    id: result.data.id,
                    text: result.data.name,
                };
                let newOption = new Option(data.text, data.id, false, true);
                $('#tagId').append(newOption).trigger('change');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#addJobTagForm', '#jobTagBtnSave');
        },
    });
});
$('#addJobTagModal').on('hidden.bs.modal', function () {
    resetModalForm('#addJobTagForm', '#jobTagValidationErrorsBox');
    $('#jobTagDescription').summernote('code', '');
});
//degree level
$(document).on('click', '.addRequiredDegreeLevelTypeModal', function () {
    $('#addDegreeLevelModal').appendTo('body').modal('show');
});

$(document).on('submit', '#addDegreeLevelForm', function (e) {
    e.preventDefault();
    processingBtn('#addDegreeLevelForm', '#degreeLevelBtnSave', 'loading');
    $.ajax({
        url: requiredDegreeLevelSaveUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addDegreeLevelModal').modal('hide');
                let data = {
                    id: result.data.id,
                    text: result.data.name,
                };
                let newOption = new Option(data.text, data.id, false, true);
                $('#requiredDegreeLevelId').append(newOption).trigger('change');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#addDegreeLevelForm', '#degreeLevelBtnSave');
        },
    });
});
$('#addDegreeLevelModal').on('hidden.bs.modal', function () {
    resetModalForm('#addDegreeLevelForm', '#degreeLevelValidationErrorsBox');
});

//functional area
$(document).on('click', '.addFunctionalAreaModal', function () {
    $('#addFunctionalModal').appendTo('body').modal('show');
});

$(document).on('submit', '#addFunctionalForm', function (e) {
    e.preventDefault();
    processingBtn('#addFunctionalForm', '#functionalBtnSave', 'loading');
    $.ajax({
        url: functionalAreaSaveUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addFunctionalModal').modal('hide');
                let data = {
                    id: result.data.id,
                    text: result.data.name,
                };
                let newOption = new Option(data.text, data.id, false, true);
                $('#functionalAreaId').append(newOption).trigger('change');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#addFunctionalForm', '#functionalBtnSave');
        },
    });
});
$('#addFunctionalModal').on('hidden.bs.modal', function () {
    resetModalForm('#addFunctionalForm', '#functionalValidationErrorsBox');
});
