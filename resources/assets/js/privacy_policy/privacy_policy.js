$(document).ready(function () {
    $('#description').summernote({
        minHeight: 200,
        height: 200,
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']],
            ['para', ['paragraph']],
        ],
    });

    $('#privacyPolicy').submit(function (e) {
        if (!checkSummerNoteEmpty('#description',
            'Privacy Policy field is required.', 1)) {
            e.preventDefault();

            return true;
        }
    });

    $('#termsConditions').submit(function (e) {
        if (!checkSummerNoteEmpty('#description',
            'Terms Conditions field is required.', 1)) {
            e.preventDefault();

            return true;
        }
    });
});
