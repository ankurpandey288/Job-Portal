'use strict';
$(document).ready(function (){
    $('#filterStatus').select2();
});

let tableName = '#jobApplicationsTbl';
$(tableName).DataTable({
    processing: true,
    serverSide: true,
    'order': [[0, 'asc']],
    ajax: {
        url: jobApplicationsUrl,
        type: 'GET',
        data: function (data){
            data.status = $('#filterStatus').
            find('option:selected').val();
        }
    },
    columnDefs: [
        {
            'targets': [0],
            'className': 'text-center',
            'width': '15%',
        },
        {
            'targets': [2],
            'className': 'text-right',
            'width': '15%',
        },
        {
            'targets': [3],
            'className': 'text-center',
            'width': '13%',
            'orderable': false,
        },
        {
            'targets': [4],
            'className': 'text-center',
            'width': '13%',
        },
        {
            'targets': [5],
            'className': 'text-center',
            'width': '15%',
            'orderable': false,
        },
        {
            'targets': [6],
            'className': 'text-center',
            'width': '12%',
            'orderable': false,
        },
    ],
    columns: [
        {
            data: function (row) {
                let showLink = candidateDetailsUrl + '/' +
                    row.candidate.unique_id;
                return '<a href="' + showLink + '">' +
                    row.candidate.user.full_name + '</a>';
            },
            name: 'candidate.user.first_name',
        },
        {
            data: function (row) {
                return row.job.currency.currency_icon + '&nbsp;' +
                    currency(row.expected_salary).format();
            },
            name: 'expected_salary',
        },
        {
            data: function (row) {
                return moment(row.created_at, 'YYYY-MM-DD').
                    format('Do MMM, YYYY');
            },
            name: 'created_at',
        },
        {
            data: function (row) {
                if (!row.hasResumeAvailable) {
                    let downloadLink = downloadDocumentUrl + '/' + row.id;
                    return '<a href="' + downloadLink + '">' + 'Download' +
                        '</a>';
                }

                return 'N/A';
            },
            name: 'candidate.user.last_name',
        },
        {
            data: function (row) {
                return !isEmpty(row.job_stage_id) ? row.job_stage.name :
                    '<i class="font-20 fas fa-times-circle text-danger"></i>';
            },
            name: 'jobStage.name',
        },
        {
            data: function (row) {
                const statusColor = {
                    '0': 'warning',
                    '1': 'primary',
                    '2': 'danger',
                    '3': 'info',
                    '4': 'success',
                };
                return '<span class="badge badge-' + statusColor[row.status] +
                    '">' + statusArray[row.status] + '</span>';
            },
            name: 'status',
        },
        {
            data: function (row) {
                console.log(row);
                let todayDate = (new Date()).toISOString().split('T')[0];
                let isJobExpiry = false;
                if (todayDate > row.job.job_expiry_date) {
                     isJobExpiry = true;
                }
                let viewSlotScreen = jobApplicationsUrl+ '/' + row.id + '/slots';
                let isCompleted = false;
                let isShortlisted = false;
                let isJobStage = false;
                let isRejected = false;
                let isApplied = false;

                if (row.status == 1) {
                    isApplied = true;
                }
                if (row.status == 2) {
                    isRejected = true;
                }
                if (row.status == 3) {
                    isCompleted = true;
                }
                if (row.status == 4) {
                    isShortlisted = true;
                }

                if (!isEmpty(row.job_stage_id)) {
                    isJobStage = true;
                }
                let data = [
                    {
                        'statusId': row.status,
                        'id': row.id,
                        'isApplied': isApplied,
                        'isCompleted': isCompleted,
                        'isShortlisted': isShortlisted,
                        'isJobStage': isJobStage,
                        'isRejected': isRejected,
                        'viewSlotsScreen': viewSlotScreen,
                        'isJobExpiry': isJobExpiry,
                    },
                ];
                return prepareTemplateRender('#jobApplicationActionTemplate',
                    data);
            },
            name: 'id',
        },
    ],
    'fnInitComplete': function () {
        $('#filterStatus').
        change(function () {
            $('#jobApplicationsTbl').DataTable().ajax.reload(null, true);
        });
    },
});

$(document).on('click', '.action-delete', function (event) {
    let jobApplicationId = $(event.currentTarget).data('id');
    deleteItem(jobApplicationDeleteUrl + '/' + jobApplicationId, tableName,
        Lang.get('messages.job_application.job_application'));
});

$(document).on('click', '.short-list', function (event) {
    let jobApplicationId = $(event.currentTarget).data('id');
    let applicationStatus = 4;
    changeStatus(jobApplicationId, applicationStatus);
});

$(document).on('click', '.action-completed', function (event) {
    let jobApplicationId = $(event.currentTarget).data('id');
    let applicationStatus = 3;
    selectedItem(jobApplicationId,applicationStatus);
});

$(document).on('click', '.action-decline', function (event) {
    let jobApplicationId = $(event.currentTarget).data('id');
    let applicationStatus = 2;
    rejectedItem(jobApplicationId,applicationStatus);
});

window.changeStatus = function (id, applicationStatus) {
    $.ajax({
        url: jobApplicationStatusUrl + id + '/status/' + applicationStatus,
        method: 'get',
        cache: false,
        success: function (result) {
            if (result.success) {
                $(tableName).DataTable().ajax.reload(null, false);
            }
        },
        error: function error (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
};

window.rejectedItem = function (id,applicationStatus) {
    swal({
            title: Lang.get('messages.common.rejected')+' !',
            text:  Lang.get('messages.common.are_you_sure_want_to_reject') +'"'+Lang.get('messages.job_application.job_application')+'" ?',
            type: 'warning',
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            confirmButtonColor: '#6777ef',
            cancelButtonColor: '#d33',
            cancelButtonText: Lang.get('messages.common.no'),
            confirmButtonText: Lang.get('messages.common.yes'),
        },
        function () {
            changeStatus(id,applicationStatus);
            swal({
                title: Lang.get('messages.common.rejected') + ' !',
                text: Lang.get('messages.job_application.job_application') + ' ' +Lang.get('messages.common.has_been_rejected'),
                type: 'success',
                confirmButtonColor: '#6777ef',
                timer: 2000,
            });
        });
};

window.selectedItem = function (id,applicationStatus) {
    swal({
            title: Lang.get('messages.common.selected')+' !',
            text: Lang.get('messages.common.are_you_sure_want_to_select') +'"'+Lang.get('messages.job_application.job_application')+'" ?',
            type: 'warning',
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            confirmButtonColor: '#6777ef',
            cancelButtonColor: '#d33',
            cancelButtonText: Lang.get('messages.common.no'),
            confirmButtonText: Lang.get('messages.common.yes'),
        },
        function () {
            changeStatus(id,applicationStatus);
            swal({
                title: Lang.get('messages.common.selected') + ' !',
                text: Lang.get('messages.job_application.job_application') + ' ' +Lang.get('messages.common.has_been_selected'),
                type: 'success',
                confirmButtonColor: '#6777ef',
                timer: 2000,
            });
        });
};

$(document).on('click', '.change-job-stage', function () {
    let id = $(this).data('id');
    $('#jobApplicationId').val(id);
    $('#changeJobStageModal').appendTo('body').modal('show');
});

$(document).on('submit', '#changeJobStageForm', function (e) {
    e.preventDefault();
    processingBtn('#changeJobStageForm', '#changeJobStageBtnSave', 'loading');
    $.ajax({
        url: changeJobStage,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#changeJobStageModal').modal('hide');
                $(tableName).DataTable().ajax.reload(null, false);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#changeJobStageForm', '#changeJobStageBtnSave');
        },
    });
});

$('#changeJobStageModal').on('hidden.bs.modal', function () {
    $('#jobStageId').val('').trigger('change');
});

$(document).ready(function () {
    $('#jobStageId').select2({
        width: '100%',
    });
});
