'use strict';

$(document).on('click', '.addCountryModal', function () {
    $('#addCountryModal').appendTo('body').modal('show');
});

$(document).on('submit', '#addCountryForm', function (e) {
    e.preventDefault();
    processingBtn('#addCountryForm', '#countryBtnSave', 'loading');
    $.ajax({
        url: countrySaveUrl,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#addCountryModal').modal('hide');
                window.livewire.emit('refresh');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#addCountryForm', '#countryBtnSave');
        },
    });
});

$(document).on('click', '.edit-btn', function (event) {
    let countryId = $(event.currentTarget).data('id');
    renderData(countryId);
});

window.renderData = function (id) {
    $.ajax({
        url: countryUrl + '/' + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {

                $('#countryId').val(result.data.id);
                $('#editName').val(result.data.name);
                $('#editShortCode').val(result.data.short_code);
                $('#editPhoneCode').val(result.data.phone_code);
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
    const id = $('#countryId').val();
    $.ajax({
        url: countryUrl + '/' + id,
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
    let countryId = $(event.currentTarget).attr('data-id');
    swal({
            title: Lang.get('messages.common.delete') + ' !',
            text: Lang.get('messages.common.are_you_sure_want_to_delete') + '"' + Lang.get('messages.company.country') + '" ?',
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
            window.livewire.emit('deleteCountry', countryId);
        });
});

document.addEventListener('delete', function () {
    swal({
        title: Lang.get('messages.common.deleted') + ' !',
        text: Lang.get('messages.company.country')+ Lang.get('messages.common.has_been_deleted'),
        type: 'success',
        confirmButtonColor: '#6777ef',
        timer: 2000,
    });
});

$('#addCountryModal').on('hidden.bs.modal', function () {
    resetModalForm('#addCountryForm', '#countryValidationErrorsBox');
});

$('#editModal').on('hidden.bs.modal', function () {
    resetModalForm('#editForm', '#editValidationErrorsBox');
});
