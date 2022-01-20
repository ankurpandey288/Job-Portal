'use strict';

$(document).ready(function () {
    $('#stateID,#editStateId').select2({
        'width': '100%',
    });
    $('#filter_state').select2({
        width: '180px',
    });
});

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
                window.livewire.emit('refresh');
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

$(document).on('click', '.edit-btn', function (event) {
    let cityId = $(event.currentTarget).attr('data-id');
    renderData(cityId);
});

window.renderData = function (id) {
    $.ajax({
        url: cityUrl + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#cityId').val(result.data.id);
                $('#editName').val(result.data.name);
                $('#editStateId').val(result.data.state_id).trigger('change');
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
    const id = $('#cityId').val();
    $.ajax({
        url: cityUrl + '/' + id,
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
    let cityId = $(event.currentTarget).attr('data-id');
    swal({
        title: Lang.get('messages.common.delete') + ' !',
        text: Lang.get('messages.common.are_you_sure_want_to_delete') + '"' + Lang.get('messages.job.city') + '" ?',
        type: 'warning',
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        confirmButtonColor: '#6777ef',
        cancelButtonColor: '#d33',
        cancelButtonText: Lang.get('messages.common.no'),
        confirmButtonText: Lang.get('messages.common.yes'),
    }, function () {
        window.livewire.emit('deleteCity', cityId);
    });
});

document.addEventListener('delete', function () {
    swal({
        title: Lang.get('messages.common.deleted') + ' !',
        text: Lang.get('messages.job.city')+ Lang.get('messages.common.has_been_deleted'),
        type: 'success',
        confirmButtonColor: '#6777ef',
        timer: 2000,
    });
});

$('#addCityModal').on('hidden.bs.modal', function () {
    $('#stateID').val('').trigger('change');
    resetModalForm('#addCityForm', '#cityValidationErrorsBox');
});

$('#editModal').on('hidden.bs.modal', function () {
    resetModalForm('#editForm', '#editValidationErrorsBox');
});

$(document).ready(function () {
    $('#filter_state').on('change', function (e) {
        var data = $('#filter_state').select2('val');
        window.livewire.emit('changeFilter', 'filterState', data);
    });
}); 
