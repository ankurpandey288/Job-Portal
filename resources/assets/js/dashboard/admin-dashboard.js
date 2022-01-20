$(document).ready(function () {
    'use strict';

    let timeRange = $('#timeRange');
    let isPickerApply = false;
    const today = moment();
    let start = today.clone().startOf('week');
    let end = today.clone().endOf('week');

    timeRange.on('apply.daterangepicker', function (ev, picker) {
        isPickerApply = true;
        start = picker.startDate.format('YYYY-MM-D  H:mm:ss');
        end = picker.endDate.format('YYYY-MM-D  H:mm:ss');
        loadDashboardData(start, end);
    });

    const lastMonth = moment().startOf('month').subtract(1, 'days');
    const thisMonthStart = moment().startOf('week');
    const thisMonthEnd = moment().endOf('week');

    window.cb = function (start, end) {
        timeRange.find('span').
            html(
                start.format('MMM D, YYYY') + ' - ' +
                end.format('MMM D, YYYY'));
    };

    timeRange.daterangepicker({
        startDate: start,
        endDate: end,
        opens: 'left',
        showDropdowns: true,
        autoUpdateInput: false,
        ranges: {
            'This Week': [moment().startOf('week'), moment().endOf('week')],
            'Last Week': [
                moment().startOf('week').subtract(7, 'days'),
                moment().startOf('week').subtract(1, 'days')],
        },
    }, cb);

    cb(start, end);

    window.loadDashboardData = function (startDate, endDate) {
        $.ajax({
            type: 'GET',
            url: adminDashboardChartData,
            dataType: 'json',
            data: {
                start_date: startDate,
                end_date: endDate,
            },
            cache: false,
        }).done(
            WeeklyBarChart,
            PostStatistics,
        );
    };

    window.WeeklyBarChart = function (result) {
        $('#weeklyUserBarChartContainer').html('');
        $('canvas#weeklyUserBarChart').remove();
        $('#weeklyUserBarChartContainer').
            append('<canvas id="weeklyUserBarChart" width="515" height="413"></canvas>');

        let data = result.data.weeklyChartData;
        const weeklyData = {
            labels: data.weeklyLabels,
            datasets: [
                {
                    label: 'Employees',
                    backgroundColor: '#6777ef',
                    data: data.totalEmployerCount,
                }, {
                    label: 'Candidates',
                    backgroundColor: '#3abaf4',
                    data: data.totalCandidateCount,
                }],
        };
        let ctx = $('#weeklyUserBarChart');
        let config = new Chart(ctx, {
            type: 'bar',
            data: weeklyData,
            options: {
                scales: {
                    xAxes: [
                        {
                            stacked: true,
                            gridLines: {
                                display: false,
                            },
                        }],
                    yAxes: [
                        {
                            stacked: true,
                            ticks: {
                                min: 0,
                                precision: 0,
                            },
                            type: 'linear',
                        }],
                },
            },
        });
    };

    window.PostStatistics = function (result) {
        $('#postStatisticsChartContainer').html('');
        $('canvas#postStatisticsChart').remove();
        $('#postStatisticsChartContainer').
            append('<canvas id="postStatisticsChart" width="1031" height="400"></canvas>');

        let data = result.data.postStatisticsChartData;
        const postStatisticsLineChartData = {
            labels: data.weeklyPostLabels,
            datasets: [{
                label: 'Posts',
                data: data.totalPostCount,
                backgroundColor: '#6777ef',
                borderColor: '#6777ef',
                hoverOffset: 4,
                pointRadius: 5,
                pointHoverRadius: 5,
                fill:false,
                tension: 0.1,
            }]
        };

        let postStatistics = $('#postStatisticsChart');

        let myChart = new Chart(postStatistics, {
            type: 'line',
            data: postStatisticsLineChartData,
            options: {
                legend: false,
                scales: {
                    xAxes: [
                        {
                            stacked: true,
                            gridLines: {
                                display: false,
                            },
                        }],
                    yAxes: [
                        {
                            stacked: true,
                            ticks: {
                                min: 0,
                                precision: 0,
                            },
                            type: 'linear',
                        }],
                },
            }
        });
    }

    loadDashboardData(start.format('YYYY-MM-D H:mm:ss'),
        end.format('YYYY-MM-D H:mm:ss'));
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

$(document).ready(function () {
    $("#recent-employee-scroll").niceScroll({
        touchbehavior: true,
    });
});
