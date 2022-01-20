'use strict';

$(document).ready(function () {
    $('#filter_featured').select2({
        width: '170px',
    });
    $('#filter_status').select2();
});

$(document).on('click', '.adminMakeFeatured', function (event) {
    let companyId = $(event.currentTarget).data('id');
    makeFeatured(companyId);
});

window.makeFeatured = function (id) {
    $.ajax({
        url: companiesUrl + '/' + id + '/mark-as-featured',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('[data-toggle="tooltip"]').tooltip('hide');
                window.livewire.emit('refresh');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};

$(document).on('click', '.adminUnFeatured', function (event) {
    let companyId = $(event.currentTarget).data('id');
    makeUnFeatured(companyId);
});

window.makeUnFeatured = function (id) {
    $.ajax({
        url: companiesUrl + '/' + id + '/mark-as-unfeatured',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('[data-toggle="tooltip"]').tooltip('hide');
                window.livewire.emit('refresh');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};

$(document).on('click', '.delete-btn', function (event) {
    let companyId = $(event.currentTarget).attr('data-id');
    swal({
            title: Lang.get('messages.common.delete') + ' !',
            text: Lang.get('messages.common.are_you_sure_want_to_delete') + '"' + Lang.get('messages.candidate.employee') + '" ?',
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
            window.livewire.emit('deleteEmployee', companyId);
        });
});

document.addEventListener('delete', function () {
    swal({
        title: Lang.get('messages.common.deleted') + ' !',
        text: Lang.get('messages.candidate.employee')+ Lang.get('messages.common.has_been_deleted'),
        type: 'success',
        confirmButtonColor: '#6777ef',
        timer: 2000,
    });
});

$(document).on('change', '.isFeatured', function (event) {
    let companyId = $(event.currentTarget).data('id');
    activeIsFeatured(companyId);
});

$(document).on('change', '.isActive', function (event) {
    let companyId = $(event.currentTarget).data('id');
    changeIsActive(companyId);
});

window.changeIsActive = function (id) {
    $.ajax({
        url: companiesUrl + '/' + id + '/change-is-active',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                window.livewire.emit('refresh');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};

$(document).on('change', '.is-email-verified', function (event) {
    if ($(this).is(':checked')) {
        let companyId = $(event.currentTarget).data('id');
        changeEmailVerified(companyId);
        $(this).attr('disabled', true);
    } else {
        return false;
    }
});

window.changeEmailVerified = function (id) {
    $.ajax({
        url: companiesUrl + '/' + id + '/verify-email',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                return true;
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};

$(document).on('click', '.send-email-verification', function (event) {
    let companyId = $(event.currentTarget).attr('data-id');
    $.ajax({
        url: companiesUrl + '/' + companyId + '/resend-email-verification',
        type: 'post',
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                return true;
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

$(document).ready(function () {
    $('#filter_featured').on('change', function (e) {
        var data = $('#filter_featured').select2('val');
        window.livewire.emit('changeFilter', 'featured', data);
    });

    $('#filter_status').on('change', function (e) {
        var data = $('#filter_status').select2('val');
        window.livewire.emit('changeFilter', 'status', data);
    });
});
