'use strict';

$(document).ready(function () {
    $('#countryID,#editCountryId').select2({
        'width': '100%',
    });
    $('#filter_country').select2({
        width: '170px',
    });
});

$(document).on('click', '.addStateModal', function () {
    $('#addStateModal').appendTo('body').modal('show');
});

$(document).on('submit', '#addStateForm', function (e) {
    e.preventDefault();
    processingBtn('#addStateForm', '#stateBtnSave', 'loading');
    $.ajax({
        url: stateSaveUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addStateModal').modal('hide');
                window.livewire.emit('refresh');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#addStateForm', '#stateBtnSave');
        },
    });
});


$(document).on('click', '.edit-btn', function (event) {
    let stateId = $(event.currentTarget).attr('data-id');
    renderData(stateId);
});

window.renderData = function (id) {
    $.ajax({
        url: stateUrl + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#stateId').val(result.data.id);
                $('#editName').val(result.data.name);
                $('#editCountryId').
                    val(result.data.country_id).
                    trigger('change');
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
    const id = $('#stateId').val();
    $.ajax({
        url: stateUrl + '/' + id,
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
    let stateId = $(event.currentTarget).attr('data-id');
    swal({
        title: Lang.get('messages.common.delete') + ' !',
        text: Lang.get('messages.common.are_you_sure_want_to_delete') + '"' + Lang.get('messages.company.state') + '" ?',
        type: 'warning',
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        confirmButtonColor: '#6777ef',
        cancelButtonColor: '#d33',
        cancelButtonText: Lang.get('messages.common.no'),
        confirmButtonText: Lang.get('messages.common.yes'),
    }, function () {
        window.livewire.emit('deleteState', stateId);
    });
});

document.addEventListener('delete', function () {
    swal({
        title: Lang.get('messages.common.deleted') + ' !',
        text: Lang.get('messages.company.state')+ Lang.get('messages.common.has_been_deleted'),
        type: 'success',
        confirmButtonColor: '#6777ef',
        timer: 2000,
    });
});

$('#addStateModal').on('hidden.bs.modal', function () {
    $('#countryID').val('').trigger('change');
    resetModalForm('#addStateForm', '#StateValidationErrorsBox');
});

$('#editModal').on('hidden.bs.modal', function () {
    resetModalForm('#editForm', '#editValidationErrorsBox');
});

$(document).ready(function () {
    $('#filter_country').on('change', function (e) {
        var data = $('#filter_country').select2('val');
        window.livewire.emit('changeFilter', 'filterCountry', data);
    });
}); 
