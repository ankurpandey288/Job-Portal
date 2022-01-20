'use strict';

$(document).ready(function () {

    $('#blog_category_id').select2({
        width: '100%',
        placeholder: 'Select Post Category',
    });

    $('#description').summernote({
        minHeight: 200,
        height: 200,
        placeholder: 'enter description',
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']],
            ['para', ['paragraph']],
        ],
    });

    $(document).on('submit', '#editBlogForm, #createBlogForm', (e) => {
        if (!checkSummerNoteEmpty('#description',
            'Description field is required.', 1)) {
            e.preventDefault();
            return true;
        }
    });

    $(document).on('change', '#image', function () {
        let validFile = isValidFile($(this), '#validationErrorsBox');
        if (validFile) {
            displayPhoto(this, '#previewImage');
            $('#btnSave').prop('disabled', false);
        } else {
            $('#btnSave').prop('disabled', true);
        }
    });

});
