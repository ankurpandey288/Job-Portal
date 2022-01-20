'use strict';

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
                window.livewire.emit('refresh');
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

$(document).on('click', '.edit-btn', function (event) {
    let careerLevelId = $(event.currentTarget).data('id');
    renderData(careerLevelId);
});

window.renderData = function (id) {
    $.ajax({
        url: careerLevelUrl + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let element = document.createElement('textarea');
                element.innerHTML = result.data.level_name;
                $('#careerLevelId').val(result.data.id);
                $('#editCareerLevel').val(element.value);
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
    const id = $('#careerLevelId').val();
    $.ajax({
        url: careerLevelUrl + id,
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
    let careerLevelId = $(event.currentTarget).attr('data-id');
    swal({
        title: Lang.get('messages.common.delete') + ' !',
        text: Lang.get('messages.common.are_you_sure_want_to_delete') + '"' + Lang.get('messages.job.career_level') + '" ?',
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
            url: careerLevelUrl + careerLevelId,
            type: 'DELETE',
            success: function success(result) {
                if (result.success) {
                    window.livewire.emit('refresh');
                }

                swal({
                    title: Lang.get('messages.common.deleted') + ' !',
                    text: Lang.get('messages.job.career_level') + Lang.get('messages.common.has_been_deleted'),
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

$('#addCareerModal').on('hidden.bs.modal', function () {
    resetModalForm('#addCareerForm', '#careerValidationErrorsBox');
});

$('#editModal').on('hidden.bs.modal', function () {
    resetModalForm('#editForm', '#editValidationErrorsBox');
});
