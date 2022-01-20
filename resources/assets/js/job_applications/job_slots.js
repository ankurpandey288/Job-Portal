'use strict';

$(document).on('click', '.schedule-interview', function () {
    $('#scheduleInterviewModal').appendTo('body').modal('show');
});

$(document).on('click', '.batch-slot', function (event) {
    $('#batchSlotId').val($(event.currentTarget).attr('data-batch'));
    $('#batchSlotModal').appendTo('body').modal('show');
});

$(document).on('submit', '#batchSlotForm', function (e) {
    e.preventDefault();
    processingBtn('#batchSlotForm', '#batchSlotBtnSave', 'loading');
    let formData = new FormData($(this)[0]);
    formData.append('job_application_id', JobApplicationId);
    formData.append('batch', $('#batchSlotId').val());
    $.ajax({
        url: batchSlotStoreUrl,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#batchSlotModal').modal('hide');
                window.livewire.emit('refresh');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#batchSlotForm', '#batchSlotBtnSave');
        },
    });
});

$(document).on('click', '.edit-btn', function (event) {
    if (ajaxCallIsRunning) {
        return;
    }
    ajaxCallInProgress();
    let slotId = $(event.currentTarget).attr('data-id');
    $.ajax({
        url: jobApplicationUrl +'/slots/'+ slotId + '/edit',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#editSlotId').val(result.data.id);
                $('#editDate').val(result.data.date);
                $('#editTime').val(result.data.time);
                $('#editNotes').val(result.data.notes);
                $('#editSlotModal').appendTo('body').modal('show');
                ajaxCallCompleted();
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

$(document).on('submit', '#editSlotForm', function (event) {
    event.preventDefault();
    processingBtn('#editSlotForm', '#editSlotBtnSave', 'loading');
    const slotId = $('#editSlotId').val();
    let formData = new FormData($(this)[0]);
    formData.append('job_application_id', JobApplicationId);
    $.ajax({
        url: jobApplicationUrl +'/slots/'+ slotId + '/update',
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#editSlotModal').modal('hide');
                window.livewire.emit('refresh');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#editSlotForm', '#editSlotBtnSave');
        },
    });
});

$(document).on('click', '.delete-btn', function (event) {
    let slotId = $(event.currentTarget).attr('data-id');
    swal({
        title: Lang.get('messages.common.delete') + ' !',
        text: Lang.get('messages.common.are_you_sure_want_to_delete') + '"' + Lang.get('messages.job_stage.slot') + '" ?',
        type: 'warning',
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        confirmButtonColor: '#6777ef',
        cancelButtonColor: '#d33',
        cancelButtonText: Lang.get('messages.common.no'),
        confirmButtonText: Lang.get('messages.common.yes')
    }, function () {
        $.ajax({
            url: jobApplicationUrl + '/slots/'+slotId,
            type: 'DELETE',
            success: function success(result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    window.livewire.emit('refresh');
                    setTimeout(function (){
                        if ($('.slot-data').length == 0) {
                            location.reload();
                        }
                    }, 3000);
                }

                swal({
                    title: Lang.get('messages.common.deleted') + ' !',
                    text: Lang.get('messages.job_stage.slot') + Lang.get('messages.common.has_been_deleted'),
                    type: 'success',
                    confirmButtonColor: '#6777ef',
                    timer: 2000
                });
            },
            error: function error(data) {
                swal({
                    title: '',
                    text: data.responseJSON.message,
                    type: 'error',
                    confirmButtonColor: '#6777ef',
                    timer: 2000
                });
            }
        });
    });
});

$(document).on('click', '.add-slot', function () {
    uniqueId++;
    let data = {
        'uniqueId': uniqueId,
    }
    $('.slot-main-div').append(prepareTemplateRender('#interviewSlotHtmlTemplate', data));
    timePickerFunction('time['+uniqueId+']');
    dateTimePickerFunction('date['+uniqueId+']');
    resetScheduleSlotIndex();
});

$(document).on('click', '.cancel-slot', function (e) {
    e.preventDefault();
    let cancelSlotNote = $(this).parent('.choose-slot-textarea').find('textarea.cancel-slot-notes').val().trim();
    if (cancelSlotNote == '') {
        displayErrorMessage('Cancel Reason field is required');
        return false;
    }
    $.ajax({
        url: cancelSlotUrl,
        type: 'POST',
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'jobApplicationId': JobApplicationId,
            'cancelSlotNote': cancelSlotNote,
        },
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('.schedule-interview').removeClass('d-none');
                $(this).parent('.choose-slot-textarea').find('textarea.cancel-slot-notes').val('');
                window.livewire.emit('refresh');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

const resetScheduleSlotIndex = () => {
    let data = {
        'uniqueId': uniqueId,
    }
    let index = 1;
    $('.slot-main-div .slot-box').each(function () {
        index++;
    });
    if (index - 1 == 0) {
        $('.slot-main-div').append(prepareTemplateRender('#interviewSlotHtmlTemplate', data));
    }
};

$(document).on('click', '.delete-schedule-slot', function () {
    $(this).parents('.slot-box').remove();
    resetScheduleSlotIndex();
    timePickerFunction('time['+uniqueId+']');
    dateTimePickerFunction('date['+uniqueId+']');
    if (!uniqueId == 1) {
        uniqueId--;

    }
});

$('#scheduleInterviewModal').on('hidden.bs.modal', function () {
    $('#historyDiv').html('');
    $('.slot-main-div').html('');
    $('.add-slot').trigger('click');
    processingBtn('#scheduleInterviewForm', '#scheduleInterviewBtnSave');
});

$('#batchSlotModal').on('hidden.bs.modal', function () {
    processingBtn('#batchSlotForm', '#batchSlotBtnSave');
    resetModalForm('#batchSlotForm', '#batchSlotValidationErrorsBox');
});

$(document).on('submit', '#scheduleInterviewForm', function (e) {
    e.preventDefault();
    processingBtn('#scheduleInterviewForm', '#scheduleInterviewBtnSave', 'loading');
    let formData = new FormData($(this)[0]);
    formData.append('scheduleSlotCount', uniqueId);
    formData.append('job_application_id', JobApplicationId);
    $.ajax({
        url: interviewSlotStoreUrl,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#scheduleInterviewModal').modal('hide');
                $('.schedule-interview').addClass('d-none');
                window.livewire.emit('refresh');
                if (result.data) {
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                }
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            processingBtn('#scheduleInterviewForm', '#scheduleInterviewBtnSave');
        },
    });
});

const timePickerFunction = (selector) => {
    console.log(selector);
    $(document.getElementById(selector)).datetimepicker(DatetimepickerDefaults({
        format: 'HH:mm',
        sideBySide: true,
    }));
};

const dateTimePickerFunction = (selector) => {
    $(document.getElementById(selector)).datetimepicker(DatetimepickerDefaults({
        format: 'DD-MM-YYYY',
        useCurrent: true,
        sideBySide: true,
        minDate: new moment()
    }));
};

$(document).ready(function () {
    timePickerFunction('time['+1+']');
    dateTimePickerFunction('date['+1+']');
    timePickerFunction('time');
    dateTimePickerFunction('date');
    timePickerFunction('editTime');
    dateTimePickerFunction('editDate');

    $('#stages').select2({
        width: '110%',
    });
    let data = $('#stages').select2('val');
    $('#stages').on('change', function (e) {
        data = $('#stages').select2('val');
        window.livewire.emit('changeFilter', 'stage', data);
    });
    window.livewire.emit('changeFilter', 'stage', data);
    window.livewire.emit('stageFilter', 'jobApplicationId', JobApplicationId);
});
