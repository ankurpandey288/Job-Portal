$(document).ready(function () {
    'use strict';

    $('#candidateId').select2({
        placeholder: 'Select Candidate',
    });

    $('#filter_employers').select2();

    checkBoxSelect();

    //select all checkbox
    function checkBoxSelect () {
        $('#ckbCheckAll').click(function () {
            $('.jobCheck').prop('checked', $(this).prop('checked'));
        });

        $('.jobCheck').on('click', function () {
            if ($('.jobCheck:checked').length == $('.jobCheck').length) {
                $('#ckbCheckAll').prop('checked', true);
            } else {
                $('#ckbCheckAll').prop('checked', false);
            }
        });
    }

    //employer
    $(document).on('change', '#filter_employers', function () {
        $('.job-notification-ul').empty();
        $('#ckbCheckAll').prop('checked', false);
        let url = '';

        let employerId = $(this).val();
        if (!isEmpty(employerId)) {
            url = getEmployerJobs + '/' + employerId;
        } else {
            url = jobNotification;
        }
        $.ajax({
            url: url,
            type: 'get',
            success: function (result) {
                if (result.success) {
                    let jobNotification = '';
                    let noJobsAvailable = '<li class="no-job-available"><h4>No Jobs available</h4></li>';
                    if (!isEmpty(employerId)) {
                        let index;
                        if (result.data.jobs.length > 0) {
                            for (index = 0; index <
                            result.data.jobs.length; ++index) {
                                let data = [
                                    {
                                        'job_id': result.data.jobs[index].id,
                                        'job_title': result.data.jobs[index].job_title,
                                        'created_by': humanReadableFormatDate(
                                            result.data.jobs[index].created_at),
                                        'jobDetails': jobDetails + '/' +
                                            result.data.jobs[index].id,
                                    }];
                                let jobNotificationLi = prepareTemplateRender(
                                    '#jobNotificationTemplate', data);
                                jobNotification += jobNotificationLi;
                            }
                        }
                    } else {
                        if (result.data.length > 0) {
                            let count;
                            for (count = 0; count <
                            result.data.length; ++count) {
                                let data = [
                                    {
                                        'job_id': result.data[count].id,
                                        'job_title': result.data[count].job_title,
                                        'created_by': humanReadableFormatDate(
                                            result.data[count].created_at),
                                        'jobDetails': jobDetails + '/' +
                                            result.data[count].id,
                                    }];
                                let jobLi = prepareTemplateRender(
                                    '#jobNotificationTemplate', data);
                                jobNotification += jobLi;
                            }
                        }
                    }
                    $('.job-notification-ul').
                        append(jobNotification != ''
                            ? jobNotification
                            : noJobsAvailable);
                    checkBoxSelect();
                }
            },
            error: function (result) {
                manageAjaxErrors(result);
            },
        });
    });

    function humanReadableFormatDate (date) {
        return moment(date).fromNow();
    };

    $(document).on('submit', '#createJobNotificationForm', function () {
        if ($('.jobCheck:checked').length === 0) {
            displayErrorMessage('Please select at job.');
            return false;
        }
        screenLock();
        startLoader();
    });
});
