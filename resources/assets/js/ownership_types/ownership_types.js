'use strict';

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
                window.livewire.emit('refresh');
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

$(document).on('click', '.edit-btn', function (event) {
    if (ajaxCallIsRunning) {
        return;
    }
    ajaxCallInProgress();
    let ownerShipTypeId = $(event.currentTarget).data('id');
    renderData(ownerShipTypeId);
});

window.renderData = function (id) {
    $.ajax({
        url: ownerShipTypeUrl + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let element = document.createElement('textarea');
                element.innerHTML = result.data.name;
                $('#ownerShipTypeId').val(result.data.id);
                $('#editName').val(element.value);
                $('#editDescription').
                    summernote('code', result.data.description);
                $('#editModal').appendTo('body').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};

$(document).on('submit', '#editForm', function (event) {
    event.preventDefault();
    if (!checkSummerNoteEmpty('#editDescription',
        'Description field is required.')) {
        return true;
    }
    processingBtn('#editForm', '#btnEditSave', 'loading');
    const id = $('#ownerShipTypeId').val();
    $.ajax({
        url: ownerShipTypeUrl + id,
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

$(document).on('click', '.show-btn', function (event) {
    if (ajaxCallIsRunning) {
        return;
    }
    ajaxCallInProgress();
    let ownerShipTypeId = $(event.currentTarget).data('id');
    $.ajax({
        url: ownerShipTypeUrl + ownerShipTypeId,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#showName').html('');
                $('#showDescription').html('');
                $('#showName').append(result.data.name);
                let element = document.createElement('textarea');
                element.innerHTML = (!isEmpty(result.data.description)
                    ? result.data.description
                    : 'N/A');
                $('#showDescription').append(element.value);
                $('#showModal').appendTo('body').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

$(document).on('click', '.delete-btn', function (event) {
    let ownerShipTypeId = $(event.currentTarget).attr('data-id');
    swal({
        title: Lang.get('messages.common.delete') + ' !',
        text: Lang.get('messages.common.are_you_sure_want_to_delete') + '"' + Lang.get('messages.company.ownership_type') + '" ?',
        type: 'warning',
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        confirmButtonColor: '#6777ef',
        cancelButtonColor: '#d33',
        cancelButtonText: Lang.get('messages.common.no'),
        confirmButtonText: Lang.get('messages.common.yes')
    }, function () {
        $.ajax({
            url: ownerShipTypeUrl + ownerShipTypeId,
            type: 'DELETE',
            success: function success(result) {
                if (result.success) {
                    window.livewire.emit('refresh');
                }

                swal({
                    title: Lang.get('messages.common.deleted') + ' !',
                    text: Lang.get('messages.company.ownership_type') + Lang.get('messages.common.has_been_deleted'),
                    type: 'success',
                    confirmButtonColor: '#6777ef',
                    timer: 2000
                });
            },
            error: function error(data) {
                swal({
                    title: '',
                    text: data.responseJSON.message,
                    type: 'error',
                    confirmButtonColor: '#6777ef',
                    timer: 2000
                });
            }
        });
    });
});

document.addEventListener('delete', function () {
    swal({
        title: Lang.get('messages.common.deleted') + ' !',
        text: Lang.get('messages.company.ownership_type') + Lang.get('messages.common.has_been_deleted'),
        type: 'success',
        confirmButtonColor: '#6777ef',
        timer: 2000,
    });
});

$('#addOwnershipModal').on('hidden.bs.modal', function () {
    resetModalForm('#addOwnershipForm', '#ownershipValidationErrorsBox');
    $('#ownershipDescription').summernote('code', '');
});

$('#editModal').on('hidden.bs.modal', function () {
    resetModalForm('#editForm', '#editValidationErrorsBox');
});

$('#ownershipDescription, #editDescription').summernote({
    minHeight: 200,
    height: 200,
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough']],
        ['para', ['paragraph']]],
});
