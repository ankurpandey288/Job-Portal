'use strict';
$(document).ready(function () {
    $(document).on('click', '.uploadResumeModal', function () {
        $('#uploadModal').appendTo('body').modal('show');
    });

    $(document).on('submit', '#addNewForm', function (e) {
        let empty = $('#uploadResumeTitle').val().trim().replace(/ \r\n\t/g, '') === '';
        if (empty){
            displayErrorMessage('The title field is not contain only white space');
            return false;
        }
        e.preventDefault();
        processingBtn('#addNewForm', '#btnSave', 'loading');
        $.ajax({
            url: resumeUploadUrl,
            type: 'post',
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#uploadModal').modal('hide');
                    setTimeout(function () {
                        processingBtn('#addNewForm', '#btnSave', 'reset');
                    }, 1000);
                    location.reload();
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
                setTimeout(function () {
                    processingBtn('#addNewForm', '#btnSave', 'reset');
                }, 1000);
            },
            complete: function () {
                setTimeout(function () {
                    processingBtn('#addNewForm', '#btnSave');
                }, 1000);
            },
        });
    });

    $(document).on('change', '#customFile', function () {
        let extension = isValidDocument($(this), '#validationErrorsBox');
        if (!isEmpty(extension) && extension != false) {
            $('#validationErrorsBox').html('').hide();
        }
    });

    window.isValidDocument = function (
        inputSelector, validationMessageSelector) {
        let ext = $(inputSelector).val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['jpg', 'jpeg', 'pdf', 'doc', 'docx']) ==
            -1) {
            $(inputSelector).val('');
            $(validationMessageSelector).removeClass('d-none');
            $(validationMessageSelector).
                html(
                    'The document must be a file of type: jpeg, jpg, pdf, doc, docx.').
                show();
            $(validationMessageSelector).delay(5000).slideUp(300);
            
            return false;
        }
        $(validationMessageSelector).hide();
        
        return ext;
    };

    $('.custom-file-input').on('change', function () {
        var fileName = $(this).val().split('\\').pop();
        $(this).
            siblings('.custom-file-label').
            addClass('selected').
            html(fileName);
    });

    $(document).on('click', '.delete-resume', function (event) {
        let resumeId = $(event.currentTarget).attr('data-id');
        swal({
                title: Lang.get('messages.common.delete') + ' !',
                text: Lang.get('messages.common.are_you_sure_want_to_delete') + '"' + Lang.get('messages.apply_job.resume') + '" ?',
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
                $.ajax({
                    url: resumeUploadUrl + '/' + resumeId,
                    type: 'DELETE',
                    success: function (result) {
                        if (result.success) {
                            setTimeout(location.reload(), 1000);
                        }
                        swal({
                            title: Lang.get('messages.common.deleted') + ' !',
                            text: Lang.get('messages.apply_job.resume')+ Lang.get('messages.common.has_been_deleted'),
                            type: 'success',
                            confirmButtonColor: '#6777ef',
                            timer: 2000,
                        });
                    },
                    error: function (data) {
                        swal({
                            title: '',
                            text: data.responseJSON.message,
                            type: 'error',
                            timer: 5000,
                        });
                    },
                });
            },
        );
    });
});

$('#uploadModal').on('hidden.bs.modal', function () {
    $('#customFile').
        siblings('.custom-file-label').
        addClass('selected').
        html('Choose file');
    resetModalForm('#addNewForm', '#validationErrorsBox');
});
