$(document).ready(function () {

    (isCompanyAddedToFavourite)
        ? $('.favouriteText').text(unfollowText)
        : $('.favouriteText').text(followText);

    $('#addToFavourite').on('click', function () {
        let userId = $(this).data('favorite-user-id');
        let companyId = $(this).data('favorite-company_id');

        $.ajax({
            url: addCompanyFavouriteUrl,
            type: 'POST',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'userId': userId,
                'companyId': companyId,
            },
            success: function (result) {
                if (result.success) {
                    console.log(result.data);
                    (result.data) ? $('.favouriteText').
                        text(unfollowText) : $('.favouriteText').
                        text(followText);
                    displaySuccessMessage(result.message);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });

    $(document).on('submit', '#reportToCompany', function (e) {
        e.preventDefault();
        processingBtn('#reportToCompany', '#btnSave', 'loading');
        $.ajax({
            url: reportToCompanyUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#reportToCompanyModal').modal('hide');
                    $('.reportToCompany').prop('disabled', true);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
            complete: function () {
                processingBtn('#reportToCompany', '#btnSave');
            },
        });
    });
});
