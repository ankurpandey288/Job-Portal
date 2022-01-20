$('document').ready(function () {

    'use strict';

    let timeRange = $('#timeRange');
    const today = moment();
    let start = today.clone().startOf('month');
    let end = today.clone().endOf('month');
    let jobStatus = $('#jobStatus').val();
    let gender = $('#gender').val();
    let isPickerApply = false;

    $('#jobStatus, #gender').select2({
        width: '100%',
    });

    $('#jobStatus').on('change', function (e) {
        e.preventDefault();
        jobStatus = $('#jobStatus').val();
        let gender = $('#gender').val();
        loadTotalJobsApplication(moment(start).format('YYYY-MM-D  H:mm:ss'),
            moment(end).format('YYYY-MM-D  H:mm:ss'), jobStatus, gender);
    });
    $('#gender').on('change', function (e) {
        e.preventDefault();
        gender = $('#gender').val();
        jobStatus = $('#jobStatus').val();
        loadTotalJobsApplication(moment(start).format('YYYY-MM-D  H:mm:ss'),
            moment(end).format('YYYY-MM-D  H:mm:ss'), jobStatus, gender);
    });
    
    timeRange.on('apply.daterangepicker', function (ev, picker) {
        isPickerApply = true;
        start = picker.startDate.format('YYYY-MM-D  H:mm:ss');
        end = picker.endDate.format('YYYY-MM-D  H:mm:ss');
        loadTotalJobsApplication(start, end, jobStatus, gender);
    });

    window.cb = function (start, end) {
        timeRange.find('span').
            html(
                start.format('MMM D, YYYY') + ' - ' +
                end.format('MMM D, YYYY'));
    };

    cb(start, end);

    const lastMonth = moment().startOf('month').subtract(1, 'days');
    const thisMonthStart = moment().startOf('month');
    const thisMonthEnd = moment().endOf('month');

    timeRange.daterangepicker({
        startDate: start,
        endDate: end,
        opens: 'left',
        showDropdowns: true,
        autoUpdateInput: false,
        ranges: {
            'Today': [moment(), moment()],
            'This Week': [moment().startOf('week'), moment().endOf('week')],
            'Last Week': [
                moment().startOf('week').subtract(7, 'days'),
                moment().startOf('week').subtract(1, 'days')],
            'This Month': [thisMonthStart, thisMonthEnd],
            'Last Month': [
                lastMonth.clone().startOf('month'),
                lastMonth.clone().endOf('month')],
        },
    }, cb);

    window.loadTotalJobsApplication = function (
        startDate, endDate, jobStatus = null, gender = null) {
        $.ajax({
            type: 'GET',
            url: jobsApplicationUrl,
            dataType: 'json',
            data: {
                start_date: startDate,
                end_date: endDate,
                job_status: jobStatus,
                gender: gender,
            },
            cache: false,
        }).done(prepareJobsReport);
    };
    window.prepareJobsReport = function (result) {
        $('#employerDashboardChart').html('');
        let data = result.data;
        if (data.totalJobApplication === 0) {
            $('#jobContainer').html('');
            $('#jobContainer').
                append(
                    '<div align="center" class="pt50 h150">No Records Found</div>');
            return true;
        } else {
            $('#jobContainer').html('');
            $('#jobContainer').
                append('<canvas id="employerDashboardChart"></canvas>');
        }
        let barChartData = {
            labels: data.dates.dateArr,
            datasets: [
                {
                    label: 'Total Job Applications',
                    backgroundColor: '#6777ef',
                    data: data.jobApplicationCounts,
                    borderWidth: 1,
                },
            ],
        };
        var ctx = document.getElementById('employerDashboardChart').
            getContext('2d');
        ctx.canvas.style.height = '400px';
        ctx.canvas.style.width = '100%';
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                legend: {
                    display: false,
                },
                scales: {
                    xAxes: [
                        {
                            stacked: true,
                        }],
                    yAxes: [
                        {
                            stacked: true,
                            ticks: {
                                min:0,
                                stepSize: 1,
                            },
                        }],
                },
            },
        });
    };
    loadTotalJobsApplication(start.format('YYYY-MM-D  H:mm:ss'),
        end.format('YYYY-MM-D  H:mm:ss'), jobStatus, gender);
});

$(document).ready(function () {
    let applyBtn = $('.range_inputs > button.applyBtn');
    $(document).on('click', '.ranges li', function () {
        if ($(this).data('range-key') === 'Custom Range') {
            applyBtn.css('display', 'initial');
        } else {
            applyBtn.css('display', 'none');
        }
    });
    applyBtn.css('display', 'none');
});
