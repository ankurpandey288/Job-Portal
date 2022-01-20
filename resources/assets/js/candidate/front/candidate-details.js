$(document).ready(function () {
    'use strict';
    $(document).on('submit', '#reportToCandidate', function (e) {
        e.preventDefault();
        processingBtn('#reportToCandidate', '#btnSave', 'loading');
        $.ajax({
            url: reportToCandidateUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#reportToCandiateModal').modal('hide');
                    $('.reportToCandidate').prop('disabled', true);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
            complete: function () {
                processingBtn('#reportToCandidate', '#btnSave');
            },
        });
    });
});
