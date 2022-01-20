'use strict';

$(document).ready(function () {

    $('#body').summernote({
        minHeight: 200,
        height: 200,
        dialogsInBody: true,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture']],
            ['view', ['codeview']]
        ]
    });

    $(document).on('submit', '#editEmailTemplateForm', (e) => {
        if (!checkSummerNoteEmpty('#body',
            'Body field is required.', 1)) {
            e.preventDefault();
            return true;
        }
    });

    $(document).on('click', '.note-link-btn', (e) => {
        e.preventDefault();
        let text = $('.note-form-group .note-link-text').val().trim().length;
        let url = $('.note-form-group .note-link-url').val().trim().length;
        if (text == 0) {
            displayErrorMessage('Text Field is required.')
            $('.link-dialog').modal("show");
            return false;
        }

        if (url == 0) {
            displayErrorMessage('Url Field is required.');
            $('.link-dialog').modal("show");

            return false;
        }

        return true;
    });

    $(document).on('click', '.note-image-btn', (e) => {
        let imageUrl = $('.note-group-image-url .note-image-url').val().trim().length;
        let imageModal = $('.note-modal:eq(1)');
        if (imageUrl == 0) {
            imageModal.show();
            imageModal.addClass('show');
            displayErrorMessage('Url Field is required.');

            return false;
        }
        imageModal.hide();
        imageModal.removeClass('show');

        return true;
    });
    /* summernote modal label */
    $('.note-modal .form-group label').append(' <span class="text-danger">*</span>');
});
