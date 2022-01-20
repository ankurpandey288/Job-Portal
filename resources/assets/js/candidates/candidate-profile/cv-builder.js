'use strict';
$(document).ready(function () {
    renderCandidateData();
    randerCVTemplate();

    $('#skillId,#candidateCountryId,#candidateStateId,#candidateCityId').
        select2({
            width: '100%',
        });

    $('#candidateCountryId').on('change', function () {
        $.ajax({
            url: companyStateUrl,
            type: 'get',
            dataType: 'json',
            data: { postal: $(this).val() },
            success: function (data) {
                $('#candidateStateId').empty();
                $('#candidateStateId').append(
                    $('<option value="" selected>Select State</option>'));
                $.each(data.data, function (i, v) {
                    $('#candidateStateId').
                        append($('<option></option>').attr('value', i).text(v));
                });
                if (isEditProfile && stateId != '') {
                    $('#candidateStateId').val(stateId).trigger('change');
                }
                if ($('#candidateStateId').val() == null) {
                    $('#candidateStateId').find('option[value=""]').remove();
                    $('#candidateStateId').
                        prepend(
                            $('<option value="" selected>Select State</option>'));
                }
                if ($('#candidateCityId').val() == null) {
                    $('#candidateCityId').
                        prepend(
                            $('<option value="" selected>Select City</option>'));
                }
            },
        });
    });

    $('#candidateStateId').on('change', function () {
        $.ajax({
            url: companyCityUrl,
            type: 'get',
            dataType: 'json',
            data: {
                state: $(this).val(),
                country: $('#candidateCountryId').val(),
            },
            success: function (data) {
                $('#candidateCityId').empty();
                $.each(data.data, function (i, v) {
                    $('#candidateCityId').
                        append(
                            $('<option ></option>').attr('value', i).text(v));
                });
                if (isEditProfile && cityId != '') {
                    $('#candidateCityId').val(cityId).trigger('change');
                }
                if ($('#candidateCityId').val() == null) {
                    $('#candidateCityId').
                        prepend(
                            $('<option value="" selected>Select City</option>'));
                }
            },
        });
    });

    if (isEditProfile & countryId) {
        $('#candidateCountryId').val(countryId).trigger('change');
    }

    $(document).on('submit', '#editGeneralForm', function (e) {
        e.preventDefault();
        processingBtn('#editGeneralForm', '#btnEditGeneralSave', 'loading');
        $.ajax({
            url: updateCandidateUrl,
            type: 'post',
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    hideAddGeneralDiv();
                    randerCVTemplate();
                    $('#candidateName').text(result.data.full_name);
                    $('#candidateLocation').
                        text(result.data.candidate.full_location);
                    $('#candidatePhone').text(result.data.phone);
                    let skills = result.data.candidateSkill;
                    let skillHtml = '<ul class="pl-3">';
                    skills.forEach(function (item) {
                        skillHtml = skillHtml +
                            '<li class="font-weight-bold">' + item + '</li>';
                    });
                    skillHtml = skillHtml + '</ul>';
                    $('#candidateSkillDiv').html(skillHtml);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
            complete: function () {
                processingBtn('#editGeneralForm', '#btnEditGeneralSave');
            },
        });
    });

    $(document).on('keyup', '#facebookId', function () {
        this.value = this.value.toLowerCase();
    });
    $(document).on('keyup', '#twitterId', function () {
        this.value = this.value.toLowerCase();
    });
    $(document).on('keyup', '#linkedinId', function () {
        this.value = this.value.toLowerCase();
    });
    $(document).on('keyup', '#googlePlusId', function () {
        this.value = this.value.toLowerCase();
    });
    $(document).on('keyup', '#pinterestId', function () {
        this.value = this.value.toLowerCase();
    });

    $(document).on('submit', '#editOnlineProfileForm', function (e) {
        e.preventDefault();
        processingBtn('#editOnlineProfileForm', '#btnOnlineProfileSave',
            'loading');
        let facebookUrl = $('#facebookId').val();
        let twitterUrl = $('#twitterId').val();
        let linkedInUrl = $('#linkedinId').val();
        let googlePlusUrl = $('#googlePlusId').val();
        let pinterestUrl = $('#pinterestId').val();

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
        urlValidation(linkedInUrl, googlePlusExp);
        urlValidation(googlePlusUrl, linkedInExp);
        urlValidation(pinterestUrl, pinterestExp);

        if (!urlValidation(facebookUrl, facebookExp)) {
            displayErrorMessage('Please enter a valid Facebook Url');
            processingBtn('#editOnlineProfileForm',
                '#btnOnlineProfileSave');
            return false;
        }
        if (!urlValidation(twitterUrl, twitterExp)) {
            displayErrorMessage('Please enter a valid Twitter Url');
            processingBtn('#editOnlineProfileForm',
                '#btnOnlineProfileSave');
            return false;
        }
        if (!urlValidation(linkedInUrl, linkedInExp)) {
            displayErrorMessage('Please enter a valid Linkedin Url');
            processingBtn('#editOnlineProfileForm',
                '#btnOnlineProfileSave');
            return false;
        }
        if (!urlValidation(googlePlusUrl, googlePlusExp)) {
            displayErrorMessage('Please enter a valid Google Plus Url');
            processingBtn('#editOnlineProfileForm',
                '#btnOnlineProfileSave');
            return false;
        }
        if (!urlValidation(pinterestUrl, pinterestExp)) {
            displayErrorMessage('Please enter a valid Pinterest Url');
            processingBtn('#editOnlineProfileForm',
                '#btnOnlineProfileSave');
            return false;
        }

        $.ajax({
            url: updateonlineProfileUrl,
            type: 'post',
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    hideAddOnlineProfileDiv();
                    $('#candidateOnlineProfileDiv').
                        html(result.data.onlineProfileLayout);
                    $('#addOnlineProfileDiv').
                        html(result.data.editonlineProfileLayout);
                    randerCVTemplate();
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
            complete: function () {
                processingBtn('#editOnlineProfileForm',
                    '#btnOnlineProfileSave');
            },
        });
    });

    $(document).on('click', '.editGeneralBtn', function () {
        showEditGeneralDiv();
    });
    $(document).on('click', '#btnGeneralCancel', function () {
        hideAddGeneralDiv();
    });
    $(document).on('click', '.addOnlineProfileBtn', function () {
        showAddOnlineProfileDiv();
    });
    $(document).on('click', '#btnOnlineProfileCancel', function () {
        hideAddOnlineProfileDiv();
    });
    $(document).on('click', '.cv-preview', function () {
        $('#cvModal').appendTo('body').modal('show');
    });
    $(document).on('click', '#downloadPDF', function () {
        makeCVPDF();
    });
    $(document).on('click', '.printCV', function () {
        let divToPrint = document.getElementById('cvTemplate');
        let newWin = window.open('', 'Print-Window');
        newWin.document.open();
        newWin.document.write(
            '<html>' +
            '<link href="' + bootstarpUrl +
            '" rel="stylesheet" type="text/css"/>' +
            '<link href="' + styleCssUrl +
            '" rel="stylesheet" type="text/css"/>' +
            '<link href="' + customCssUrl +
            '" rel="stylesheet" type="text/css"/>' +
            '<link href="' + fontCssUrl +
            '" rel="stylesheet" type="text/css"/>' +
            '<body onload="window.print()">' + divToPrint.innerHTML +
            '</body></html>');
        newWin.document.close();
        setTimeout(function () {newWin.close();}, 10);
    });

});
window.renderCandidateData = function () {
    $.ajax({
        url: candidateProfileUrl,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#first_name').val(result.data.first_name);
                $('#last_name').val(result.data.last_name);
                $('#email').val(result.data.email);
                $('#phone').val(result.data.phone);
                $('#candidateCountryId').
                    val(result.data.country_id).
                    trigger('change');
                stateId = result.data.state_id;
                cityId = result.data.city_id;
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};
window.randerCVTemplate = function () {
    $('#btnEditGeneralSave').attr('disabled', true);
    $.ajax({
        url: cvTemplateUrl,
        type: 'GET',
        success: function (result) {
            if (result) {
                $('#cvTemplate').html(result);
                $('#btnEditGeneralSave').attr('disabled', false);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};
window.showEditGeneralDiv = function () {
    hideAddExperienceDiv();
    hideEditExperienceDiv();
    hideAddEducationDiv();
    hideEditEducationDiv();
    hideAddOnlineProfileDiv();
    $('#candidateGeneralDiv').hide();
    $('#editGeneralDiv').removeClass('d-none');
    resetModalForm('#editGeneralForm');
    renderCandidateData();
};
window.hideAddGeneralDiv = function () {
    $('#candidateGeneralDiv').show();
    $('#editGeneralDiv').addClass('d-none');
};
window.showAddOnlineProfileDiv = function () {
    hideAddExperienceDiv();
    hideEditExperienceDiv();
    hideAddEducationDiv();
    hideEditEducationDiv();
    hideAddGeneralDiv();
    $('#candidateOnlineProfileDiv').hide();
    $('#addOnlineProfileDiv').removeClass('d-none');
    resetModalForm('#editOnlineProfileForm');
};
window.hideAddOnlineProfileDiv = function () {
    $('#candidateOnlineProfileDiv').show();
    $('#addOnlineProfileDiv').addClass('d-none');
};
function makeCVPDF () {
    var element = document.getElementById('cvTemplate');
    html2pdf(element);
    return;
}
