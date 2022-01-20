'use strict';
$(document).ready(function () {
    $('#countryId,#educationCountryId, #editCountry,#editEducationCountry').
        select2({
            'width': '100%',
        });
    $('#editState, #editEducationState').
        select2({
            'width': '100%',
        });
    $('#editCity,#editEducationCity').
        select2({
            'width': '100%',
        });
    $('#degreeLevelId').
        select2({
            'width': '100%',
        });
    $('.addExperienceBtn').on('click', function () {
        showAddExperienceDiv();
    });
    $('.addEducationBtn').on('click', function () {
        showAddEducationDiv();
    });

    $('#btnEducationCancel').on('click', function () {
        $('#degreeLevelId').val('');
        $('#degreeLevelId').
            select2({ 'width': '100%', 'placeholder': 'Select Degree Level' });
        hideAddEducationDiv();
    });
    $('#btnEditEducationCancel').on('click', function () {
        hideEditEducationDiv();
    });
    $('#btnCancel').on('click', function () {
        hideAddExperienceDiv();
    });
    $('#btnEditCancel').on('click', function () {
        hideEditExperienceDiv();
    });

    window.setDatePicker = function (startDate, endDate) {
        $(startDate).datetimepicker(DatetimepickerDefaults({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true,
            maxDate: new moment(),
        }));
        $(endDate).datetimepicker(DatetimepickerDefaults({
            format: 'YYYY-MM-DD',
            sideBySide: true,
            maxDate: new moment(),
            useCurrent: false,
        }));
    };

    $('#startDate').on('dp.change', function (e) {
        $('#endDate').val('');
        $('#endDate').data('DateTimePicker').minDate(e.date);
    });

    $('#editStartDate').on('dp.change', function (e) {
        setTimeout(() => {
            $('#editEndDate').data('DateTimePicker').minDate(e.date);
        }, 1000);
    });

    $('#default').on('click', function () {
        if ($(this).prop('checked') == true) {
            $('#endDate').prop('disabled', true);
            $('#endDate').val('');
            $('#endDate').val('').removeAttr('required', false);
            $('#requiredText').addClass('d-none');
        } else if ($(this).prop('checked') == false) {
            $('#endDate').val('').attr('required', true);
            $('#requiredText').removeClass('d-none');
            $('#endDate').data('DateTimePicker').minDate($('#startDate').val());
            $('#endDate').prop('disabled', false);
        }
    });

    $('#editWorking').on('click', function () {
        if ($(this).prop('checked') == true) {
            $('#editEndDate').prop('disabled', true);
            $('#editEndDate').val('');
            $('#editEndDate').val('').removeAttr('required', false);
            $('#editRequiredText').addClass('d-none');
        } else if ($(this).prop('checked') == false) {
            $('#editEndDate').val('').attr('required', true);
            $('#editRequiredText').removeClass('d-none');
            $('#editEndDate').
                data('DateTimePicker').
                minDate($('#editStartDate').val());
            $('#editEndDate').prop('disabled', false);
        }
    });

    $(document).on('submit', '#addNewExperienceForm', function (e) {
        e.preventDefault();
        processingBtn('#addNewExperienceForm', '#btnExperienceSave', 'loading');
        $.ajax({
            url: addExperienceUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    $('#notfoundExperience').addClass('d-none');
                    displaySuccessMessage(result.message);
                    hideAddExperienceDiv();
                    renderExperienceTemplate(result.data);
                    randerCVTemplate();
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
            complete: function () {
                processingBtn('#addNewExperienceForm', '#btnExperienceSave');
            },
        });
    });

    $(document).on('click', '.edit-experience', function (event) {
        let experienceId = $(event.currentTarget).data('id');
        renderExperienceData(experienceId);
    });

    $(document).on('submit', '#editExperienceForm', function (event) {
        event.preventDefault();
        processingBtn('#editExperienceForm', '#btnEditExperienceSave',
            'loading');
        const id = $('#experienceId').val();
        $.ajax({
            url: experienceUrl + id,
            type: 'put',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    hideEditExperienceDiv();
                    $('.candidate-experience-container').
                        children('.candidate-experience').
                        each(function () {
                            let candidateExperienceId = $(this).attr('data-id');
                            if (candidateExperienceId == result.data.id) {
                                $(this).remove();
                            }
                        });
                    renderExperienceTemplate(result.data.candidateExperience);
                    randerCVTemplate();
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
            complete: function () {
                processingBtn('#editExperienceForm', '#btnEditExperienceSave');
            },
        });
    });

    $(document).on('click', '.delete-experience', function (event) {
        let experienceId = $(event.currentTarget).data('id');
        deleteItem(experienceUrl + experienceId, 'Experience',
            '.candidate-experience-container', '.candidate-experience',
            '#notfoundExperience');
    });

    $(document).on('submit', '#addNewEducationForm', function (e) {
        e.preventDefault();
        processingBtn('#addNewEducationForm', '#btnEducationSave', 'loading');
        $.ajax({
            url: addEducationUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    renderEducationTemplate(result.data);
                    $('#candidateEducationsDiv').show();
                    $('#createEducationsDiv').addClass('d-none');
                    randerCVTemplate();
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
            complete: function () {
                processingBtn('#addNewEducationForm', '#btnEducationSave');
            },
        });
    });

    $(document).on('click', '.edit-education', function (event) {
        let educationId = $(event.currentTarget).data('id');
        renderEducationData(educationId);
    });

    $(document).on('submit', '#editEducationForm', function (event) {
        event.preventDefault();
        processingBtn('#editEducationForm', '#btnEditEducationSave',
            'loading');
        const id = $('#educationId').val();
        $.ajax({
            url: educationUrl + id,
            type: 'put',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    hideEditEducationDiv();
                    $('.candidate-education-container').
                        children('.candidate-education').
                        each(function () {
                            let candidateEducationId = $(this).attr('data-id');
                            if (candidateEducationId == result.data.id) {
                                $(this).remove();
                            }
                        });
                    renderEducationTemplate(result.data.candidateEducation);
                    randerCVTemplate();
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
            complete: function () {
                processingBtn('#editEducationForm', '#btnEditEducationSave');
            },
        });
    });

    $(document).on('click', '.delete-education', function (event) {
        let educationId = $(event.currentTarget).data('id');
        deleteItem(educationUrl + educationId, Lang.get('messages.candidate_profile.education'),
            '.candidate-education-container', '.candidate-education',
            '#notfoundEducation');
    });

    window.deleteItem = function (url, header, parent, child, selector) {
        swal({
            title: Lang.get('messages.common.delete') + ' !',
            text: Lang.get('messages.common.are_you_sure_want_to_delete') +'"'+ header + '" ?',
            type: 'warning',
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            confirmButtonColor: '#6777ef',
            cancelButtonColor: '#d33',
            cancelButtonText: Lang.get('messages.common.no'),
            confirmButtonText: Lang.get('messages.common.yes'),
        }, function () {
            deleteItemAjax(url, header, parent, child, selector);
        });
    };

    function deleteItemAjax (url, header, parent, child, selector) {
        $.ajax({
            url: url,
            type: 'DELETE',
            dataType: 'json',
            success: function success (obj) {
                if (obj.success) {
                    $(parent).children(child).each(function () {
                        let templateId = $(this).attr('data-id');
                        if (templateId == obj.data) {
                            $(this).remove();
                        }
                    });
                    if ($(parent).children(child).length <= 0) {
                        $(selector).removeClass('d-none');
                    }
                    randerCVTemplate();
                }

                swal({
                    title: Lang.get('messages.common.deleted') + ' !',
                    text: header + Lang.get('messages.common.has_been_deleted'),
                    type: 'success',
                    confirmButtonColor: '#6777ef',
                    timer: 2000,
                });
            },
            error: function error (data) {
                swal({
                    title: '',
                    text: data.responseJSON.message,
                    type: 'error',
                    confirmButtonColor: '#6777ef',
                    timer: 5000,
                });
            },
        });
    }

    $('#countryId, #educationCountryId, #editCountry, #editEducationCountry').
        on('change', function (e, paramData) {
            const modalType = $(this).data('modal-type');
            const modalTypeHasEdit = (typeof $(this).data('is-edit') ===
                'undefined')
                ? false
                : true;
            $.ajax({
                url: companyStateUrl,
                type: 'get',
                dataType: 'json',
                data: { postal: $(this).val() },
                success: function (data) {
                    $((modalType === 'experience')
                        ? ((!modalTypeHasEdit) ? '#stateId' : '#editState')
                        : ((!modalTypeHasEdit)
                            ? '#educationStateId'
                            : '#editEducationState')).empty();
                    $((modalType === 'experience')
                        ? ((!modalTypeHasEdit) ? '#stateId' : '#editState')
                        : ((!modalTypeHasEdit)
                            ? '#educationStateId'
                            : '#editEducationState')).
                        append(
                            '<option value="" selected>Select State</option>');
                    $.each(data.data, function (i, v) {
                        $((modalType === 'experience')
                            ? ((!modalTypeHasEdit) ? '#stateId' : '#editState')
                            : ((!modalTypeHasEdit)
                                ? '#educationStateId'
                                : '#editEducationState')).
                            append($('<option></option>').
                                attr('value', i).
                                text(v));
                    });
                    if (modalTypeHasEdit)
                        $((modalType === 'experience')
                            ? '#editState'
                            : '#editEducationState').
                            val(paramData.stateId).
                            trigger('change', [{ cityId: paramData.cityId }]);
                },
            });
        });

    $('#stateId, #educationStateId, #editState, #editEducationState').
        on('change', function (e, paramData) {
            const modalType = $(this).data('modal-type');
            const modalTypeHasEdit = (typeof $(this).data('is-edit') ===
                'undefined')
                ? false
                : true;
            $.ajax({
                url: companyCityUrl,
                type: 'get',
                dataType: 'json',
                data: {
                    state: $(this).val(),
                    country: $(
                        (modalType === 'experience') ? (!modalTypeHasEdit)
                            ? '#countryId'
                            : '#editCountry' : (!modalTypeHasEdit)
                            ? '#educationCountryId'
                            : '#editEducationCountry').val(),
                },
                success: function (data) {
                    $((modalType === 'experience') ? (!modalTypeHasEdit)
                        ? '#cityId'
                        : '#editCity' : (!modalTypeHasEdit)
                        ? '#educationCityId'
                        : '#editEducationCity').empty();
                    $((modalType === 'experience') ? (!modalTypeHasEdit)
                        ? '#cityId'
                        : '#editCity' : (!modalTypeHasEdit)
                        ? '#educationCityId'
                        : '#editEducationCity').
                        append(
                            '<option value="" selected>Select City</option>');
                    $.each(data.data, function (i, v) {
                        $((modalType === 'experience') ? (!modalTypeHasEdit)
                            ? '#cityId'
                            : '#editCity' : (!modalTypeHasEdit)
                            ? '#educationCityId'
                            : '#editEducationCity').
                            append($('<option></option>').
                                attr('value', i).
                                text(v));
                    });
                    if (modalTypeHasEdit)
                        $((modalType === 'experience')
                            ? '#editCity'
                            : '#editEducationCity').
                            val(typeof paramData !== 'undefined'
                                ? paramData.cityId
                                : '').
                            trigger('change.select2');
                },
            });
        });
});

window.showAddEducationDiv = function () {
    hideAddExperienceDiv();
    hideEditExperienceDiv();
    hideAddOnlineProfileDiv();
    hideAddGeneralDiv();
    $('#candidateEducationsDiv').hide();
    $('#createEducationsDiv').removeClass('d-none');
    resetModalForm('#addNewEducationForm', '#validationErrorsBox');
    $('#educationCountryId, #educationStateId, #educationCityId').val('');
    $('#educationStateId, #educationCityId').empty();
    $('#educationStateId').
        select2({ 'width': '100%', 'placeholder': 'Select State' });
    $('#educationCityId').
        select2({ 'width': '100%', 'placeholder': 'Select City' });
    $('#educationCountryId').trigger('change.select2');
};
window.showEditEducationDiv = function () {
    hideAddExperienceDiv();
    hideEditExperienceDiv();
    hideAddOnlineProfileDiv();
    hideAddGeneralDiv();
    $('#candidateEducationsDiv').hide();
    $('#editEducationsDiv').removeClass('d-none');
    resetModalForm('#editEducationForm', '#editValidationErrorsBox');
    $('#editEducationCountry, #editEducationState, #editEducationCity').val('');
    $('#editEducationState, #editEducationCity').empty();
    $('#editEducationCountry').trigger('change.select2');
};
window.hideAddEducationDiv = function () {
    $('#candidateEducationsDiv').show();
    $('#createEducationsDiv').addClass('d-none');
};
window.hideEditEducationDiv = function () {
    $('#candidateEducationsDiv').show();
    $('#editEducationsDiv').addClass('d-none');
};
window.showAddExperienceDiv = function () {
    hideAddEducationDiv();
    hideEditEducationDiv();
    hideAddOnlineProfileDiv();
    hideAddGeneralDiv();
    $('#candidateExperienceDiv').hide();
    $('#createExperienceDiv').removeClass('d-none');
    setDatePicker('#startDate', '#endDate');
    resetModalForm('#addNewExperienceForm', '#validationErrorsBox');
    $('#countryId, #stateId, #cityId').val('');
    $('#stateId, #cityId').empty();
    $('#stateId').select2({ 'width': '100%', 'placeholder': 'Select State' });
    $('#cityId').select2({ 'width': '100%', 'placeholder': 'Select City' });
    $('#countryId').trigger('change.select2');
};
window.showEditExperienceDiv = function () {
    hideAddEducationDiv();
    hideEditEducationDiv();
    hideAddOnlineProfileDiv();
    hideAddGeneralDiv();
    $('#candidateExperienceDiv').hide();
    $('#editExperienceDiv').removeClass('d-none');
    resetModalForm('#editExperienceForm', '#editValidationErrorsBox');
    setDatePicker('#editStartDate', '#editEndDate');
    $('#editExperienceCountry, #editExperienceState, #editExperienceCity').
        val('');
    $('#editExperienceState, #editExperienceCity').empty();
    $('#editExperienceCountry').trigger('change.select2');
};
window.hideAddExperienceDiv = function () {
    $('#candidateExperienceDiv').show();
    $('#createExperienceDiv').addClass('d-none');
};
window.hideEditExperienceDiv = function () {
    $('#candidateExperienceDiv').show();
    $('#editExperienceDiv').addClass('d-none');
};
window.renderEducationData = function (id) {
    showEditEducationDiv();
    startLoader();
    $('#btnEditEducationSave').attr('disabled', true);
    $.ajax({
        url: candidateUrl + id + '/edit-education',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                stopLoader();
                $('#educationId').val(result.data.id);
                $('#editDegreeLevel').
                    val(result.data.degree_level.id).
                    trigger('change');
                $('#editDegreeTitle').val(result.data.degree_title);
                $('#editEducationCountry').
                    val(result.data.country_id).
                    trigger('change', [
                        {
                            stateId: result.data.state_id,
                            cityId: result.data.city_id,
                        }]);
                $('#editInstitute').val(result.data.institute);
                $('#editResult').val(result.data.result);
                $('#editYear').val(result.data.year).trigger('change');
                $('#btnEditEducationSave').attr('disabled', false);
            }
        },
        error: function (result) {
            stopLoader();
            displayErrorMessage(result.responseJSON.message);
        },
    });
};
window.renderEducationTemplate = function (educationArray) {
    let candidateEducationCount =
        $('.candidate-education-container .candidate-education:last').
            data('education-id') != undefined ?
            $('.candidate-education-container .candidate-education:last').
                data('experience-id') + 1 : 0;
    let template = $.templates('#CVcandidateEducationTemplate');
    let data = {
        candidateEducationNumber: candidateEducationCount,
        id: educationArray.id,
        degreeLevel: educationArray.degree_level.name,
        degreeTitle: educationArray.degree_title,
        year: educationArray.year,
        country: educationArray.country,
        institute: educationArray.institute,
    };
    let stageTemplateHtml = template.render(data);
    $('.candidate-education-container').append(stageTemplateHtml);
    $('#notfoundEducation').addClass('d-none');
};
window.renderExperienceData = function (id) {
    showEditExperienceDiv();
    startLoader();
    $('#btnEditCancel').attr('disabled', true);
    $.ajax({
        url: candidateUrl + id + '/edit-experience',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                stopLoader();
                $('#experienceId').val(result.data.id);
                $('#editTitle').val(result.data.experience_title);
                $('#editCompany').val(result.data.company);
                $('#editCountry').
                    val(result.data.country_id).
                    trigger('change', [
                        {
                            stateId: result.data.state_id,
                            cityId: result.data.city_id,
                        }]);

                $('#editStartDate').
                    val(moment(result.data.start_date).
                        format('YYYY-MM-DD'));
                $('#editDescription').val(result.data.description);
                if (result.data.currently_working == 1) {
                    $('#editWorking').
                        prop('checked', true);
                    $('#editEndDate').val('');
                } else {
                    $('#editWorking').
                        prop('checked', false);
                    $('#editEndDate').
                        val(moment(result.data.end_date).format('YYYY-MM-DD'));
                    $('#editRequiredText').removeClass('d-none');
                }
                if (result.data.currently_working == 1) {
                    $('#editEndDate').prop('disabled', true);
                }
                $('#btnEditCancel').attr('disabled', false);
            }
        },
        error: function (result) {
            stopLoader();
            displayErrorMessage(result.responseJSON.message);
        },
    });
};
window.renderExperienceTemplate = function (experienceArray) {
    let candidateExperienceCount =
        $('.candidate-experience-container .candidate-experience:last').
            data('experience-id') != undefined ?
            $('.candidate-experience-container .candidate-experience:last').
                data('experience-id') + 1 : 0;
    let template = $.templates('#CVcandidateExperienceTemplate');
    let endDate = experienceArray.currently_working == 1
        ? present
        : moment(experienceArray.end_date, 'YYYY-MM-DD').
            format('Do MMM, YYYY');
    let data = {
        candidateExperienceNumber: candidateExperienceCount,
        id: experienceArray.id,
        title: experienceArray.experience_title,
        company: experienceArray.company,
        startDate: moment(experienceArray.start_date, 'YYYY-MM-DD').
            format('Do MMM, YYYY'),
        endDate: endDate,
        description: experienceArray.description,
        country: experienceArray.country,
    };
    let stageTemplateHtml = template.render(data);
    $('.candidate-experience-container').append(stageTemplateHtml);
    $('#notfoundExperience').addClass('d-none');
};

