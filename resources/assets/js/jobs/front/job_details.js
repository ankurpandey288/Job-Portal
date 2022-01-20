$(document).ready(function () {

    (isJobAddedToFavourite)
        ? $('.favouriteText').text(removeFromFavorite)
        : $('.favouriteText').text(addToFavorites);

    $('#jobUrl').val(window.location.href);

    $('#addToFavourite').on('click', function () {
        let userId = $(this).data('favorite-user-id');
        let jobId = $(this).data('favorite-job-id');

        $.ajax({
            url: addJobFavouriteUrl,
            type: 'POST',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'userId': userId,
                'jobId': jobId,
            },
            success: function (result) {
                if (result.success) {
                    (result.data) ? $('.favouriteText').
                        text(removeFromFavorite) : $('.favouriteText').
                        text(addToFavorites);
                    displaySuccessMessage(result.message);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });

    $(document).on('submit', '#reportJobAbuse', function (e) {
        e.preventDefault();
        processingBtn('#reportJobAbuse', '#btnSave', 'loading');
        $.ajax({
            url: reportAbuseUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#reportJobAbuseModal').modal('hide');
                    $('.reportJobAbuse').prop('disabled', true);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
            complete: function () {
                processingBtn('#reportJobAbuse', '#btnSave');
            },
        });
    });

    // email job to friend
    $(document).on('submit', '#emailJobToFriend', function (e) {
        e.preventDefault();
        processingBtn('#emailJobToFriend', '#btnSendToFriend', 'loading');
        $.ajax({
            url: emailJobToFriend,
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#friendName,#friendEmail').val('');
                    $('#emailJobToFriendModal').modal('hide');
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
            complete: function () {
                processingBtn('#emailJobToFriend', '#btnSendToFriend');
            },
        });
    });

});
