$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });

    $(document).on('click', '.featured-job', function () {
        let payloadData = {
            jobId: $(this).data('id'),
        };
        $(this).
            html(
                '<div class="spinner-border spinner-border-sm " role="status">\n' +
                '                                            <span class="sr-only">Loading...</span>\n' +
                '                                        </div>');
        $(this).tooltip('hide');
        $('#jobsTbl a.featured-job').addClass('disabled');

        $.post(jobStripePaymentUrl, payloadData).done((result) => {
            let sessionId = result.data.sessionId;
            stripe.redirectToCheckout({
                sessionId: sessionId,
            }).then(function (result) {
                $(this).html('Make Featured').removeClass('disabled');
                $('#jobsTbl a.featured-job').removeClass('disabled');
                manageAjaxErrors(result);
            });
        }).catch(error => {
            $(this).html('Make Featured').removeClass('disabled');
            $('#jobsTbl a.featured-job').removeClass('disabled');
            manageAjaxErrors(error);
        });
    });
});
