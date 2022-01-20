'use strict';

$(document).on('click', '.addNoticeboardModal', function () {
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
        url: noticeboardSaveUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addModal').modal('hide');
                window.livewire.emit('refresh');
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

$(document).on('click', '.edit-btn', function (event) {
    if (ajaxCallIsRunning) {
        return;
    }
    ajaxCallInProgress();
    let noticeboardId = $(event.currentTarget).data('id');
    renderData(noticeboardId);
});

window.renderData = function (id) {
    $.ajax({
        url: noticeboardUrl + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let element = document.createElement('textarea');
                element.innerHTML = result.data.title;
                $('#noticeboardId').val(result.data.id);
                $('#editTitle').val(element.value);
                $('#editDescription').
                    summernote('code', result.data.description);
                (result.data.is_active == 1) ? $('#editIsActive').
                    prop('checked', true) : $('#editIsActive').
                    prop('checked', false);
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
        'Description field is required.', 1)) {
        return true;
    }
    processingBtn('#editForm', '#btnEditSave', 'loading');
    const id = $('#noticeboardId').val();
    $.ajax({
        url: noticeboardUrl + id,
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
    let noticeboardId = $(event.currentTarget).data('id');
    $.ajax({
        url: noticeboardUrl + noticeboardId,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#showTitle').html('');
                $('#showDescription').html('');
                $('#showTitle').append(result.data.title);
                let element = document.createElement('textarea');
                element.innerHTML = (!isEmpty(result.data.description))
                    ? result.data.description
                    : 'N/A';
                $('#showDescription').append(element.value);
                (result.data.is_active === 1)
                    ? $('#showIsActive').
                        html('Active')
                    : $('#showIsActive').
                        html('Deactive');
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
    let noticeboardId = $(event.currentTarget).attr('data-id');
    swal({
            title: Lang.get('messages.common.delete') + ' !',
            text: Lang.get('messages.common.are_you_sure_want_to_delete') + '"' + Lang.get('messages.noticeboard.noticeboard') + '" ?',
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
            window.livewire.emit('deleteNoticeboard', noticeboardId);
        });
});

document.addEventListener('delete', function () {
    swal({
        title: Lang.get('messages.common.deleted') + ' !',
        text: Lang.get('messages.noticeboard.noticeboard') + Lang.get('messages.common.has_been_deleted'),
        type: 'success',
        confirmButtonColor: '#6777ef',
        timer: 2000,
    });
});

$(document).on('change', '.isActive', function (event) {
    let noticeId = $(event.currentTarget).data('id');
    $.ajax({
        url: noticeboardUrl + noticeId + '/' + 'change-status',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                window.livewire.emit('refresh');
            }
        },
    });
});

$('#addModal').on('hidden.bs.modal', function () {
    resetModalForm('#addNewForm', '#validationErrorsBox');
    $('#description').summernote('code', '');
});

$('#editModal').on('hidden.bs.modal', function () {
    resetModalForm('#editForm', '#editValidationErrorsBox');
});

$('#description, #editDescription').summernote({
    minHeight: 200,
    height: 200,
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough']],
        ['para', ['paragraph']]],
});

$(document).ready(function () {
    $('#noticeboard_filter_status').select2();
    
    $('#noticeboard_filter_status').on('change', function (e) {
        let data = $('#noticeboard_filter_status').select2('val');
        window.livewire.emit('changeFilter', 'status', data);
    });
});
