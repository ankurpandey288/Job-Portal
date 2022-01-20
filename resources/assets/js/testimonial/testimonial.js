'use strict';

const Handlebars = require('handlebars');
preparedTemplate();
$(document).ready(function () {
    $(document).on('submit', '#addNewForm', function (e) {
        e.preventDefault();
        if (!checkSummerNoteEmpty('#description',
            'Description field is required.', 1)) {
            return true;
        }
        processingBtn('#addNewForm', '#btnSave', 'loading');
        if ($('#customerName').val().length > 50) {
            displayErrorMessage('Customer Name may not be greater than 50 character.');
            setTimeout(function () {
                processingBtn('#addNewForm', '#btnSave');
            }, 1000)
            return false;
        }
        $.ajax({
            url: testimonialSaveUrl,
            type: 'POST',
            data: new FormData(this),
            dataType: 'JSON',
            processData: false,
            contentType: false,
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
        let testimonialId = $(event.currentTarget).data('id');
        renderData(testimonialId);
    });

    window.renderData = function (id) {
        $.ajax({
            url: testimonialUrl + id + '/edit',
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    let element = document.createElement('textarea');
                    element.innerHTML = result.data.customer_name;
                    $('#testimonialId').val(result.data.id);
                    $('#editCustomerName').val(element.value);
                    if (isEmpty(result.data.customer_image_url)) {
                        $('#editPreviewImage').
                            attr('src', defaultDocumentImageUrl);
                    } else {
                        $('#editPreviewImage').
                            attr('src', result.data.customer_image_url);
                    }
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
        if ($('#editCustomerName').val().length > 50) {
            displayErrorMessage('Customer Name may not be greater than 50 character.');
            setTimeout(function () {
                processingBtn('#editForm', '#btnEditSave');
            }, 1000)
            return false;
        }
        const id = $('#testimonialId').val();
        $.ajax({
            url: testimonialUrl + id + '/update',
            type: 'POST',
            data: new FormData($(this)[0]),
            dataType: 'JSON',
            processData: false,
            contentType: false,
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
        let testimonialId = $(event.currentTarget).data('id');
        $.ajax({
            url: testimonialUrl + testimonialId,
            type: 'GET',
            success: function (result) {
                console.log(result.data);
                if (result.success) {
                    $('#showCustomerName').html('');
                    $('#showDescription').html('');
                    $('#documentUrl').html('');

                    $('#showCustomerName').append(result.data.customer_name);
                    if (isEmpty(result.data.customer_image_url)) {
                        $('#documentUrl').hide();
                        $('#noDocument').show();
                    } else {
                        $('#noDocument').hide();
                        $('#documentUrl').show();
                        $('#documentUrl').
                            attr('src', result.data.customer_image_url);
                    }
                    let element = document.createElement('textarea');
                    element.innerHTML = (!isEmpty(result.data.description))
                        ? result.data.description
                        : 'N/A';
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

    $(document).on('click', '.addTestimonialModal', function () {
        $('#addModal').appendTo('body').modal('show');
    });

    $(document).on('click', '.delete-btn', function (event) {
        let testimonialId = $(event.currentTarget).attr('data-id');
        swal({
                title: Lang.get('messages.common.delete') + ' !',
                text: Lang.get('messages.common.are_you_sure_want_to_delete') + '"' + Lang.get('messages.testimonial.testimonial') + '" ?',
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
                window.livewire.emit('deleteTestimonial', testimonialId);
            });
    });

    document.addEventListener('delete', function () {
        swal({
            title: Lang.get('messages.common.deleted') + ' !',
            text: Lang.get('messages.testimonial.testimonial') + Lang.get('messages.common.has_been_deleted'),
            type: 'success',
            confirmButtonColor: '#6777ef',
            timer: 2000,
        });
    });

    $('#addModal').on('hidden.bs.modal', function () {
        resetModalForm('#addNewForm', '#validationErrorsBox');
        $('#description').summernote('code', '');
        $('#previewImage').attr('src', defaultDocumentImageUrl);
    });

    $('#editModal').on('hidden.bs.modal', function () {
        resetModalForm('#editForm', '#editValidationErrorsBox');
        // $('#editForm')[0].reset();
    });

    $('#description, #editDescription').summernote({
        minHeight: 200,
        height: 200,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']],
            ['para', ['paragraph']]],
    });

    $(document).on('change', '#customerImage', function () {
        if (isValidFile($(this), '#validationErrorsBox')) {
            displayPhoto(this, '#previewImage');
        }
    });

    $(document).on('change', '#editCustomerImage', function () {
        if (isValidFile($(this), '#editValidationErrorsBox')) {
            displayPhoto(this, '#editPreviewImage');
        }
    });
});

let source = $('#actionTemplate')[0].innerHTML;
window.actionTemplate = Handlebars.compile(source);
