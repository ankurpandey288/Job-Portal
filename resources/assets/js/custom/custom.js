'use strict';

const Handlebars = require('handlebars');
let source = null;
let jsrender = require('jsrender');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
});
$(document).ajaxComplete(function () {
    // Required for Bootstrap tooltips in DataTables
    $('[data-toggle="tooltip"]').tooltip({
        'html': true,
        'offset': 10,
    });
});
$('input:text:not([readonly="readonly"])').first().focus();

$(function () {
    $('.modal').on('shown.bs.modal', function () {
        $(this).find('input:text').first().focus();
    });
});

window.resetModalForm = function (formId, validationBox) {
    $(formId)[0].reset();
    $('select.select2Selector').each(function (index, element) {
        let drpSelector = '#' + $(this).attr('id');
        $(drpSelector).val('');
        $(drpSelector).trigger('change');
    });
    $(validationBox).hide();
};

window.printErrorMessage = function (selector, errorResult) {
    $(selector).show().html('');
    $(selector).text(errorResult.responseJSON.message);
};

window.manageAjaxErrors = function (data) {
    var errorDivId = arguments.length > 1 && arguments[1] !== undefined
        ? arguments[1]
        : 'editValidationErrorsBox';
    if (data.status == 404) {
        iziToast.error({
            title: 'Error!',
            message: data.responseJSON.message,
            position: 'topRight',
        });
    } else {
        printErrorMessage('#' + errorDivId, data);
    }
};

window.displaySuccessMessage = function (message) {
    iziToast.success({
        title: 'Success',
        message: message,
        position: 'topRight',
    });
};

window.displayErrorMessage = function (message) {
    iziToast.error({
        title: 'Error',
        message: message,
        position: 'topRight',
    });
};

window.deleteItem = function (url, tableId, header, callFunction = null) {
    swal({
            title: Lang.get('messages.common.delete') + ' !',
            text: Lang.get('messages.common.are_you_sure_want_to_delete') +'"'+ header + '" ?',
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
            deleteItemAjax(url, tableId, header, callFunction = null);
        });
};

function deleteItemAjax (url, tableId, header, callFunction = null) {
    $.ajax({
        url: url,
        type: 'DELETE',
        dataType: 'json',
        success: function (obj) {
            if (obj.success) {
                if ($(tableId).DataTable().data().count() == 1) {
                    $(tableId).DataTable().page('previous').draw('page');
                } else {
                    $(tableId).DataTable().ajax.reload(null, false);
                }
            }
            swal({
                title: Lang.get('messages.common.deleted') + ' !',
                text: header + Lang.get('messages.common.has_been_deleted'),
                type: 'success',
                confirmButtonColor: '#6777ef',
                timer: 2000,
            });
            if (callFunction) {
                eval(callFunction);
            }
        },
        error: function (data) {
            swal({
                title: '',
                text: data.responseJSON.message,
                type: 'error',
                confirmButtonColor: '#6777ef',
                timer: 5000,
            });
        },
    });
}

window.format = function (dateTime) {
    var format = arguments.length > 1 && arguments[1] !== undefined
        ? arguments[1]
        : 'DD-MMM-YYYY';
    return moment(dateTime).format(format);
};

window.processingBtn = function (selecter, btnId, state = null) {
    var loadingButton = $(selecter).find(btnId);
    if (state === 'loading') {
        loadingButton.button('loading');
    } else {
        loadingButton.button('reset');
    }
};

window.prepareTemplateRender = function (templateSelector, data) {
    let template = jsrender.templates(templateSelector);
    return template.render(data);
};

window.isValidFile = function (inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
        $(inputSelector).val('');
        $(validationMessageSelector).removeClass('d-none');
        $(validationMessageSelector).
            html('The image must be a file of type: jpeg, jpg, png.').
            show();
        $(validationMessageSelector).delay(5000).slideUp(300);

        return false;
    }
    $(validationMessageSelector).hide();
    return true;
};

window.displayPhoto = function (input, selector) {
    let displayPreview = true;
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            let image = new Image();
            image.src = e.target.result;
            image.onload = function () {
                $(selector).attr('src', e.target.result);
                displayPreview = true;
            };
        };
        if (displayPreview) {
            reader.readAsDataURL(input.files[0]);
            $(selector).show();
        }
    }
};
window.removeCommas = function (str) {
    return str.replace(/,/g, '');
};

window.DatetimepickerDefaults = function (opts) {
    return $.extend({}, {
        sideBySide: true,
        ignoreReadonly: true,
        icons: {
            close: 'fa fa-times',
            time: 'fa fa-clock-o',
            date: 'fa fa-calendar',
            up: 'fa fa-arrow-up',
            down: 'fa fa-arrow-down',
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-clock-o',
            clear: 'fa fa-trash-o',
        },
    }, opts);
};

window.isEmpty = (value) => {
    return value === undefined || value === null || value === '';
};

window.screenLock = function () {
    $('#overlay-screen-lock').show();
    $('body').css({ 'pointer-events': 'none', 'opacity': '0.6' });
};

window.screenUnLock = function () {
    $('body').css({ 'pointer-events': 'auto', 'opacity': '1' });
    $('#overlay-screen-lock').hide();
};

window.onload = function () {
    window.startLoader = function () {
        $('.infy-loader').show();
    };

    window.stopLoader = function () {
        $('.infy-loader').hide();
    };

// infy loader js
    stopLoader();
};

$(document).ready(function () {
    // script to active parent menu if sub menu has currently active
    let hasActiveMenu = $(document).
        find('.nav-item.dropdown ul li').
        hasClass('active');
    if (hasActiveMenu) {
        $(document).
            find('.nav-item.dropdown ul li.active').
            parent('ul').
            css('display', 'block');
        $(document).
            find('.nav-item.dropdown ul li.active').
            parent('ul').
            parent('li').
            addClass('active');
    }
});

window.urlValidation = function (value, regex) {
    let urlCheck = (value == '' ? true : (value.match(regex)
        ? true
        : false));
    if (!urlCheck) {
        return false;
    }

    return true;
};

$('.languageSelection').on('click', function () {
    let languageName = $(this).data('prefix-value');

    $.ajax({
        type: 'POST',
        url: '/change-language',
        data: { languageName: languageName },
        success: function () {
            location.reload();
        },
    });
});



if ($(window).width() > 992) {
    $('.no-hover').on('click', function () {
        $(this).toggleClass('open');
    });
}

$(document).on('click', '#readNotification', function (e) {
    e.preventDefault();
    let notificationId = $(this).data('id');
    let notification = $(this);
    $.ajax({
        type: 'POST',
        url: readNotification +'/'+ notificationId + '/read',
        data: { notificationId: notificationId },
        success: function () {
            notification.remove();
            let notificationCounter = document.getElementsByClassName(
                'readNotification').length;
            if (notificationCounter == 0) {
                $('#readAllNotification').addClass('d-none');
                $('.empty-state').removeClass('d-none');
                $('.notification-toggle').removeClass('beep');
            }
        },
        error: function (error) {
            manageAjaxErrors(error);
        },
    });
});

$(document).on('click', '#readAllNotification', function (e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: readAllNotifications,
        success: function () {
            $('.readNotification').remove();
            $('#readAllNotification').addClass('d-none');
            $('.empty-state').removeClass('d-none');
            $('.notification-toggle').removeClass('beep');
        },
        error: function (error) {
            manageAjaxErrors(error);
        },
    });
});

$('#register').on('click', function (e) {
    e.preventDefault();
    $('.open #dropdownLanguage').trigger('click');
    $('.open #dropdownLogin').trigger('click');
});
$('#language').on('click', function (e) {
    e.preventDefault();
    $('.open #dropdownRegister').trigger('click');
    $('.open #dropdownLogin').trigger('click');
});
$('#login').on('click', function (e) {
    e.preventDefault();
    $('.open #dropdownRegister').trigger('click');
    $('.open #dropdownLanguage').trigger('click');
});

window.checkSummerNoteEmpty = function (
    selectorElement, errorMessage, isRequired = 0) {
    if ($(selectorElement).summernote('isEmpty') && isRequired === 1) {
        displayErrorMessage(errorMessage);
        $(document).find('.note-editable').html('<p><br></p>');
        return false;
    } else if (!$(selectorElement).summernote('isEmpty')) {
        $(document).find('.note-editable').contents().each(function () {
            if (this.nodeType === 3) { // text node
                this.textContent = this.textContent.replace(/\u00A0/g, '');
            }
        });
        if ($(document).find('.note-editable').text().trim().length == 0) {
            $(document).find('.note-editable').html('<p><br></p>');
            $(selectorElement).val(null);
            if (isRequired === 1) {
                displayErrorMessage(errorMessage);

                return false;
            }
        }
    }

    return true;
};

window.preparedTemplate = function () {
    let source = $('#actionTemplate').html();
    window.preparedTemplate = Handlebars.compile(source);
};

window.ajaxCallInProgress = function () {
    ajaxCallIsRunning = true;
};

window.ajaxCallCompleted = function () {
    ajaxCallIsRunning = false;
};

window.avoidSpace = function (event) {
    let k = event ? event.which : window.event.keyCode;
    if (k == 32) {
        return false;
    }
};
