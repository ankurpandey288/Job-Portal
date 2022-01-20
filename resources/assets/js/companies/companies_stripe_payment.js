$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });

    $(document).on('click', '#makeFeatured', function () {
        let payloadData = {
            companyId: companyID,
        };
        $(this).
            html(
                '<div class="spinner-border spinner-border-sm " role="status">\n' +
                '                                            <span class="sr-only">Loading...</span>\n' +
                '                                        </div>');

        $(this).addClass('disabled');

        $.post(companyStripePaymentUrl, payloadData).done((result) => {
            let sessionId = result.data.sessionId;
            stripe.redirectToCheckout({
                sessionId: sessionId,
            }).then(function (result) {
                $(this).html('Make Featured').removeClass('disabled');
                manageAjaxErrors(result);
            });
        }).catch(error => {
            $(this).html('Make Featured').removeClass('disabled');
            manageAjaxErrors(error);
        });
    });
});
