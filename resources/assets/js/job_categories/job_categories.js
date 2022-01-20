'use strict';

$(document).ready(function () {
    $('#filterFeatured').select2();
});

$(document).ready(function () {
    $('#filterFeatured').on('change', function (e) {
        var data = $('#filterFeatured').select2('val');
        window.livewire.emit('changeFilter', 'filterFeatured', data);
    });
});

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
                window.livewire.emit('refresh');
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

$(document).on('click', '.edit-btn', function (event) {
    if (ajaxCallIsRunning) {
        return;
    }
    ajaxCallInProgress();
    let jobCategoryId = $(event.currentTarget).attr('data-id');
    renderData(jobCategoryId);
});

window.renderData = function (id) {
    $.ajax({
        url: jobCategoryUrl + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let element = document.createElement('textarea');
                element.innerHTML = result.data.name;
                $('#jobCategoryId').val(result.data.id);
                $('#editName').val(element.value);
                $('#editDescription').
                    summernote('code', result.data.description);
                (result.data.is_featured == 1) ? $('#editIsFeatured').
                    prop('checked', true) : $('#editIsFeatured').
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
    processingBtn('#editForm', '#btnEditSave', 'loading');
    if (!checkSummerNoteEmpty('#editDescription',
        'Description field is required.')) {
        processingBtn('#editForm', '#btnEditSave');
        return true;
    }
    const id = $('#jobCategoryId').val();
    $.ajax({
        url: jobCategoryUrl + id,
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
    let jobCategoryId = $(event.currentTarget).attr('data-id');
    $.ajax({
        url: jobCategoryUrl + jobCategoryId,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#showName').html('');
                $('#showDescription').html('');
                $('#showIsFeatured').html('');
                $('#showName').append(result.data.name);
                if (!isEmpty(result.data.description) ? $('#showDescription').
                    append(result.data.description) : $('#showDescription').
                    append('N/A'))
                    (result.data.is_featured == 1) ? $('#showIsFeatured').
                            append('Yes')
                        : $('#showIsFeatured').append('No');
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
    let jobCategoryId = $(event.currentTarget).attr('data-id');
    swal({
        title: Lang.get('messages.common.delete') + ' !',
        text: Lang.get('messages.common.are_you_sure_want_to_delete') + '"' + Lang.get('messages.job_category.job_category') + '" ?',
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
            url: jobCategoryUrl + jobCategoryId,
            type: 'DELETE',
            success: function success(result) {
                if (result.success) {
                    window.livewire.emit('refresh');
                }

                swal({
                    title: Lang.get('messages.common.deleted') + ' !',
                    text: Lang.get('messages.job_category.job_category') + Lang.get('messages.common.has_been_deleted'),
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

$('#addJobCategoryModal').on('hidden.bs.modal', function () {
    resetModalForm('#addJobCategoryForm', '#jobCategoryValidationErrorsBox');
    $('#jobCategoryDescription').summernote('code', '');
});

$('#editModal').on('hidden.bs.modal', function () {
    resetModalForm('#editForm', '#editValidationErrorsBox');
});

$(document).on('change', '.isFeatured', function (event) {
    let jobCategoryId = $(event.currentTarget).attr('data-id');
    activeIsFeatured(jobCategoryId);
});

window.activeIsFeatured = function (id) {
    $.ajax({
        url: jobCategoryUrl + id + '/change-status',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                window.livewire.emit('refresh');
            }
        },
    });
};

$('#jobCategoryDescription, #editDescription').summernote({
    minHeight: 200,
    height: 200,
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough']],
        ['para', ['paragraph']]],
});
