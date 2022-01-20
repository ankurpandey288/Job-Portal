'use strict';

$(document).ready(function () {
    $('#size, #editCompanySize').keypress(function (e) {
        if (e.which != 8 && e.which != 0 && String.fromCharCode(e.which) !=
            '-' && (e.which < 48 || e.which > 57)) {
            $('#errMsg, #errEditMsg').
                html('Digits Only').
                show().
                fadeOut('slow');
            return false;
        }
    });
});

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
                window.livewire.emit('refresh');
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

$(document).on('click', '.edit-btn', function (event) {
    let companySizeId = $(event.currentTarget).data('id');
    renderData(companySizeId);
});

window.renderData = function (id) {
    $.ajax({
        url: companySizeUrl + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#companySizeId').val(result.data.id);
                $('#editCompanySize').val(result.data.size);
                $('#editModal').appendTo('body').modal('show');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};

$(document).on('submit', '#editForm', function (event) {
    event.preventDefault();
    processingBtn('#editForm', '#btnEditSave', 'loading');
    var id = $('#companySizeId').val();
    $.ajax({
        url: companySizeUrl + id,
        type: 'put',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#editModal').modal('hide');
                window.livewire.emit('refresh');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#editForm', '#btnEditSave');
        },
    });
});

$(document).on('click', '.delete-btn', function (event) {
    let companySizeId = $(event.currentTarget).attr('data-id');
    swal({
            title: Lang.get('messages.common.delete') + ' !',
            text: Lang.get('messages.common.are_you_sure_want_to_delete') + '"' + Lang.get('messages.company_size.company_size') + '" ?',
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
            window.livewire.emit('deleteCompanySize', companySizeId);
        });
});

document.addEventListener('delete', function () {
    swal({
        title: Lang.get('messages.common.deleted') + ' !',
        text: Lang.get('messages.company_size.company_size')+ Lang.get('messages.common.has_been_deleted'),
        type: 'success',
        confirmButtonColor: '#6777ef',
        timer: 2000,
    });
});

$('#addCompanySizeModal').on('hidden.bs.modal', function () {
    resetModalForm('#addCompanySizeForm', '#companySizeValidationErrorsBox');
});

$('#editModal').on('hidden.bs.modal', function () {
    resetModalForm('#editForm', '#editValidationErrorsBox');
});

$('#addCompanySizeModal').on('shown.bs.modal', function () {
    $('#size').focus();
});

$('#editModal').on('shown.bs.modal', function () {
    $('#editCompanySize').focus();
});
