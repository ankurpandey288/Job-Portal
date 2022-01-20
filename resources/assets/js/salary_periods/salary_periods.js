'use strict';

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
                window.livewire.emit('refresh');
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

$(document).on('click', '.edit-btn', function (event) {
    if (ajaxCallIsRunning) {
        return;
    }
    ajaxCallInProgress();
    let salaryPeriodId = $(event.currentTarget).attr('data-id');
    renderData(salaryPeriodId);
});

window.renderData = function (id) {
    $.ajax({
        url: salaryPeriodUrl + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let element = document.createElement('textarea');
                element.innerHTML = result.data.period;
                $('#salaryPeriodId').val(result.data.id);
                $('#editSalaryPeriod').val(element.value);
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
        'Description field is required.', 1)) {
        return true;
    }
    processingBtn('#editForm', '#btnEditSave', 'loading');
    const id = $('#salaryPeriodId').val();
    $.ajax({
        url: salaryPeriodUrl + id,
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
    let salaryPeriodId = $(event.currentTarget).attr('data-id');
    $.ajax({
        url: salaryPeriodUrl + salaryPeriodId,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#showSalaryPeriod').html('');
                $('#showDescription').html('');
                $('#showSalaryPeriod').append(result.data.period);
                let element = document.createElement('textarea');
                element.innerHTML = result.data.description;
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
    let salaryPeriodId = $(event.currentTarget).attr('data-id');
    swal({
        title: Lang.get('messages.common.delete') + ' !',
        text: Lang.get('messages.common.are_you_sure_want_to_delete') + '"' + Lang.get('messages.job.salary_period') + '" ?',
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
            url: salaryPeriodUrl + salaryPeriodId,
            type: 'DELETE',
            success: function success(result) {
                if (result.success) {
                    window.livewire.emit('refresh');
                }

                swal({
                    title: Lang.get('messages.common.deleted') + ' !',
                    text: Lang.get('messages.job.salary_period') + Lang.get('messages.common.has_been_deleted'),
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

$('#addSalaryPeriodModal').on('hidden.bs.modal', function () {
    resetModalForm('#addSalaryPeriodForm', '#salaryPeriodValidationErrorsBox');
    $('#salaryPeriodDescription').summernote('code', '');
});

$('#editModal').on('hidden.bs.modal', function () {
    resetModalForm('#editForm', '#editValidationErrorsBox');
});

$('#salaryPeriodDescription, #editDescription').summernote({
    minHeight: 200,
    height: 200,
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough']],
        ['para', ['paragraph']]],
});
