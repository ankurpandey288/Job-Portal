'use strict';

$(document).ready(function () {
    $('#headerFilterStatus').select2();
});

$(document).on('submit', '#addNewForm', function (e) {
    e.preventDefault();
    processingBtn('#addNewForm', '#btnSave', 'loading');
    if ($('#description').summernote('isEmpty')) {
        $('#description').val('');
    }
    $.ajax({
        url: headerSliderSaveUrl,
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
    let headerSliderId = $(event.currentTarget).data('id');
    renderData(headerSliderId);
});

window.renderData = function (id) {
    $.ajax({
        url: headerSliderUrl + id + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#headerSliderId').val(result.data.id);
                if (isEmpty(result.data.header_slider_url)) {
                    $('#editPreviewImage').attr('src', defaultDocumentImageUrl);
                } else {
                    $('#editPreviewImage').
                        attr('src', result.data.header_slider_url);
                    $('#imageSliderUrl').
                        attr('href', result.data.header_slider_url);
                    $('#imageSliderUrl').text(view);
                }
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
    processingBtn('#editForm', '#btnEditSave', 'loading');
    const id = $('#headerSliderId').val();
    $.ajax({
        url: headerSliderUrl + id + '/update',
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

$(document).on('click', '.addHeaderSliderModal', function () {
    $('#addModal').appendTo('body').modal('show');
});

$(document).on('click', '.delete-btn', function (event) {
    let headerSliderId = $(event.currentTarget).attr('data-id');
    swal({
            title: Lang.get('messages.common.delete') + ' !',
            text: Lang.get('messages.common.are_you_sure_want_to_delete') + '"' + Lang.get('messages.header_slider.header_slider') + '" ?',
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
            window.livewire.emit('deleteHeaderSlider', headerSliderId);
        });
});

document.addEventListener('delete', function () {
    swal({
        title: Lang.get('messages.common.deleted') + ' !',
        text: Lang.get('messages.header_slider.header_slider') + Lang.get('messages.common.has_been_deleted'),
        type: 'success',
        confirmButtonColor: '#6777ef',
        timer: 2000,
    });
});

$('#addModal').on('hidden.bs.modal', function () {
    resetModalForm('#addNewForm', '#validationErrorsBox');
    $('#previewImage').attr('src', defaultDocumentImageUrl);
});

$('#editModal').on('hidden.bs.modal', function () {
    resetModalForm('#editForm', '#editValidationErrorsBox');
    $('#editPreviewImage').attr('src', defaultDocumentImageUrl);
});

window.displayImage = function (input, selector, validationMessageSelector) {
    let displayPreview = true;
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            let image = new Image();
            image.src = e.target.result;
            image.onload = function () {
                if ((image.height < 1080 || image.width < 1920)) {
                    $('#imageSlider').val('');
                    $(validationMessageSelector).removeClass('d-none');
                    $(validationMessageSelector).
                        html(headerSizeMessage).
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
            html(headerSizeMessage).
            show();
        $(validationMessageSelector).delay(5000).slideUp(300);
        return false;
    }
    $(validationMessageSelector).hide();
    return true;
};

$(document).on('change', '#headerSlider', function () {
    $('#addModal #validationErrorsBox').addClass('d-none');
    if (isValidImage($(this), '#addModal #validationErrorsBox')) {
        displayImage(this, '#previewImage', '#addModal #validationErrorsBox');
    }
});

$(document).on('change', '#editHeaderSlider', function () {
    $('#editModal #editValidationErrorsBox').addClass('d-none');
    if (isValidFile($(this), '#editModal #editValidationErrorsBox')) {
        displayImage(this, '#editPreviewImage',
            '#editModal #editValidationErrorsBox');
    }
});

$(document).on('change', '.isActive', function (event) {
    let headerSliderId = $(event.currentTarget).data('id');
    changeIsActive(headerSliderId);
});

window.changeIsActive = function (id) {
    $.ajax({
        url: headerSliderUrl + id + '/change-is-active',
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

$('.searchIsActive').on('change', function () {
    $.ajax({
        url: headerSliderUrl + 'change-search-disable',
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

$(document).ready(function () {
    $('#headerFilterStatus').on('change', function (e) {
        let data = $('#headerFilterStatus').select2('val');
        window.livewire.emit('changeFilter', 'status', data);
    });
});
