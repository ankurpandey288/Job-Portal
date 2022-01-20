'use strict';

$(document).ready(function () {
    $('#image_filter_status').select2();
});

$(document).on('submit', '#addNewForm', function (e) {
    e.preventDefault();
    if (!checkSummerNoteEmpty('#description',
        'Description field is required.')) {
        return true;
    }
    processingBtn('#addNewForm', '#btnSave', 'loading');
    $.ajax({
        url: imageSliderSaveUrl,
        type: 'POST',
        data: new FormData($(this)[0]),
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
        let imageSliderId = $(event.currentTarget).data('id');
        renderData(imageSliderId);
    });

    window.renderData = function (id) {
        $.ajax({
            url: imageSliderUrl + id + '/edit',
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    $('#imageSliderId').val(result.data.id);
                    if (isEmpty(result.data.image_slider_url)) {
                        $('#editPreviewImage').attr('src', defaultDocumentImageUrl);
                    } else {
                        $('#editPreviewImage').
                            attr('src', result.data.image_slider_url);
                        $('#imageSliderUrl').
                            attr('href', result.data.image_slider_url);
                        $('#imageSliderUrl').text(view);
                    }
                    $('#editDescription').summernote('code', result.data.description);
                    (result.data.is_active == 1) ? $('#editIsActive').
                        prop('checked', true) : $('#editIsActive').
                        prop('checked', false);
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
        if (!checkSummerNoteEmpty('#editDescription',
            'Description field is required.')) {
            return true;
        }
        processingBtn('#editForm', '#btnEditSave', 'loading');
        const id = $('#imageSliderId').val();
        $.ajax({
            url: imageSliderUrl + id + '/update',
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

    $(document).on('click', '.addImageSliderModal', function () {
        $('#addModal').appendTo('body').modal('show');
    });

$(document).on('click', '.delete-btn', function (event) {
    let imageSliderId = $(event.currentTarget).attr('data-id');
    swal({
            title: Lang.get('messages.common.delete') + ' !',
            text: Lang.get('messages.common.are_you_sure_want_to_delete') + '"' + Lang.get('messages.image_slider.image_slider') + '" ?',
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
            window.livewire.emit('deleteImageSlider', imageSliderId);
        });
});

document.addEventListener('delete', function () {
    swal({
        title: Lang.get('messages.common.deleted') + ' !',
        text: Lang.get('messages.image_slider.image_slider') + Lang.get('messages.common.has_been_deleted'),
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
    $('#editDescription').summernote('code', '');
    $('#editPreviewImage').attr('src', defaultDocumentImageUrl);
});

$('#description, #editDescription').summernote({
    minHeight: 200,
    height: 200,
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough']],
        ['para', ['paragraph']]],
});

window.displayImage = function (input, selector, validationMessageSelector) {
    let displayPreview = true;
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            let image = new Image();
            image.src = e.target.result;
            image.onload = function () {
                if ((image.height < 500 || image.width < 1140)) {
                    $('#imageSlider').val('');
                    $(validationMessageSelector).removeClass('d-none');
                    $(validationMessageSelector).
                        html(imageSizeMessage).
                        show();
                    $(validationMessageSelector).delay(5000).slideUp(300);
                    return false;
                }
                $(selector).attr('src', e.target.result);
                $(validationMessageSelector).hide();
                displayPreview = true;
            };
        };
        if (displayPreview) {
            reader.readAsDataURL(input.files[0]);
            $(selector).show();
        }
    }
};

window.isValidImage = function (inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
        $(inputSelector).val('');
        $(validationMessageSelector).removeClass('d-none');
        $(validationMessageSelector).
            html(imageExtensionMessage).
            show();
        $(validationMessageSelector).delay(5000).slideUp(300);
        return false;
    }
    $(validationMessageSelector).hide();
    return true;
};

$(document).on('change', '#imageSlider', function () {
    $('#addModal #validationErrorsBox').addClass('d-none');
    if (isValidImage($(this), '#addModal #validationErrorsBox')) {
        displayImage(this, '#previewImage', '#addModal #validationErrorsBox');
    }
});

$(document).on('change', '#editImageSlider', function () {
    $('#editModal #editValidationErrorsBox').addClass('d-none');
    if (isValidFile($(this), '#editModal #editValidationErrorsBox')) {
        displayImage(this, '#editPreviewImage',
            '#editModal #editValidationErrorsBox');
    }
});

$(document).on('change', '.isActive', function (event) {
    let imageSliderId = $(event.currentTarget).data('id');
    changeIsActive(imageSliderId);
});

window.changeIsActive = function (id) {
    $.ajax({
        url: imageSliderUrl + id + '/change-is-active',
        method: 'post',
        cache: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                window.livewire.emit('refresh');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};

$('.isFullSlider').on('change', function () {
    $.ajax({
        url: imageSliderUrl + 'change-full-slider',
        method: 'post',
        data: $('#searchIsActive').serialize(),
        dataType: 'JSON',
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

$('.isSliderActive').on('change', function () {
    $.ajax({
        url: imageSliderUrl + 'change-slider-active',
        method: 'post',
        dataType: 'JSON',
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

$(document).on('click', '.show-btn', function (event) {
    let imageSliderId = $(event.currentTarget).data('id');
    $.ajax({
        url: imageSliderUrl + imageSliderId,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#showDescription').html('');
                $('#documentUrl').html('');
                
                if (isEmpty(result.data.image_slider_url)) {
                    $('#documentUrl').hide();
                    $('#noDocument').show();
                } else {
                    $('#noDocument').hide();
                    $('#documentUrl').show();
                    $('#documentUrl').
                        attr('src', result.data.image_slider_url);
                }
                let element = document.createElement('textarea');
                element.innerHTML = (!isEmpty(result.data.description)
                    ? result.data.description
                    : 'N/A');
                $('#showDescription').append(element.value);
                $('#showModal').appendTo('body').modal('show');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

$(document).ready(function () {
    $('#image_filter_status').on('change', function (e) {
        let data = $('#image_filter_status').select2('val');
        window.livewire.emit('changeFilter', 'status', data);
    });
});
