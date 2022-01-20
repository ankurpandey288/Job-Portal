'use strict';
let filterJobId = null;
document.addEventListener('livewire:load', function (event) {
    window.livewire.hook('message.processed', () => {
        $('#jobApplicationStatus').select2({
            width: '100%',
        });
        $('#jobApplicationStatus').val(filterJobId).trigger('change.select2');
        setTimeout(function () { $('.alert').fadeOut('fast'); }, 4000);
    });
});

$(document).on('click', '.apply-job-note', function (event) {
    let appliedJobId = $(event.currentTarget).attr('data-id');
    $.ajax({
        url: candidateAppliedJobUrl + '/' + appliedJobId,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#showNote').html('');
                if (!isEmpty(result.data.notes) ? $('#showNote').
                    append(result.data.notes) : $('#showNote').append('N/A'))
                    $('#showModal').appendTo('body').modal('show');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

$(document).on('click', '.remove-applied-jobs', function (event) {
    let jobId = $(event.currentTarget).attr('data-id');
    swal({
            title: Lang.get('messages.common.delete') + ' !',
            text: Lang.get('messages.common.are_you_sure_want_to_delete') + '"' + Lang.get('messages.applied_job.applied_jobs') + '" ?',
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
            window.livewire.emit('removeAppliedJob', jobId);
        });
});

document.addEventListener('deleted', function () {
    swal({
        title: Lang.get('messages.common.deleted') + ' !',
        text: Lang.get('messages.applied_job.applied_jobs') + Lang.get('messages.common.has_been_deleted'),
        type: 'success',
        confirmButtonColor: '#6777ef',
        timer: 2000,
    });
});

$(document).ready(function () {
    $('#jobApplicationStatus').on('change', function () {
        filterJobId = $(this).val();
        window.livewire.emit('changeFilter', 'jobApplicationStatus',
            $(this).val());
    });

    $('#jobApplicationStatus').
        select2({
            width: '100%',
        });
});

$(document).on('click', '.schedule-slot-book', function (event) {
    let appliedJobId = $(event.currentTarget).attr('data-id');
    $.ajax({
        url: candidateAppliedJobUrl + '/' + appliedJobId + '/schedule-slot-book',
        type: 'POST',
        success: function (result) {
            if (result.success) {
                if (!isEmpty(result.data)){
                    //slot rejected
                    if (result.data.rejectedSlot) {
                        if (!isEmpty(result.data.employer_cancel_note)) {
                            $('#scheduleSlotBookValidationErrorsBox').removeClass('d-none')
                            .html(result.data.employer_fullName + Lang.get('messages.job_stage.cancel_your_selected_slot') + '<br>' + '<b>Reason</b>:- ' + result.data.employer_cancel_note);
                            $('#scheduleInterviewBtnSave,#rejectSlotBtnSave').addClass('d-none');
                        } else {
                            $('#scheduleSlotBookValidationErrorsBox').removeClass('d-none').html(Lang.get('messages.job_stage.you_have_rejected_all_slot'));
                            $('#scheduleInterviewBtnSave,#rejectSlotBtnSave').addClass('d-none');
                        }
                        $('#scheduleInterviewBtnSave,#rejectSlotBtnSave').addClass('d-none');
                    }
                    
                    if (result.data.scheduleSelect >= 0) {
                        $('#scheduleInterviewBtnSave,#rejectSlotBtnSave').addClass('d-none');
                    }
                    
                    if (!result.data.rejectedSlot) {
                        $('#scheduleInterviewBtnSave,#rejectSlotBtnSave').removeClass('d-none');
                        let index = 0;
                        $.each(result.data, function (i, v) {
                            if (!isEmpty(v.job_Schedule_Id)) {
                                index++;
                                let data = {
                                    'index': index,
                                    'notes': v.notes,
                                    'schedule_date': v.schedule_date,
                                    'schedule_time': v.schedule_time,
                                    'schedule_id': v.job_Schedule_Id,
                                }
                                $('.slot-main-div').append(prepareTemplateRender('#scheduleSlotBookHtmlTemplate', data));
                                $('.choose-slot-textarea').removeClass('d-none');
                                $('#scheduleSlotBookValidationErrorsBox').addClass('d-none');
                            }
                        });
                    }
                    
                    //display selected slot
                    if (result.data.selectSlot.length != 0) {
                        $.each(result.data.selectSlot, function (i, v) {
                            let data = {
                                'notes': v.notes,
                                'schedule_date': v.date,
                                'schedule_time': v.time,
                            };
                            $('.slot-main-div').append(prepareTemplateRender('#selectedSlotBookHtmlTemplate', data));
                        });
                        $('#selectedSlotBookValidationErrorsBox').removeClass('d-none')
                        .html(Lang.get('messages.job_stage.you_have_selected_this_slot'));
                    }
                    
                    //history
                    if (!isEmpty(result.data)){
                        $('#historyMainDiv').removeClass('d-none');
                        $.each(result.data, function (i, v) {
                            if ($.type(v) == 'object' && isEmpty(v.job_Schedule_Id)) {
                                let data = {
                                    'notes': v.notes,
                                    'companyName': v.company_name,
                                    'schedule_created_at': v.schedule_created_at,
                                };
                                $('#historyDiv').prepend(prepareTemplateRender('#chooseSlotHistoryHtmlTemplate', data));
                            }
                        });
                    } else {
                        $('#historyMainDiv').addClass('d-none');
                    }
                    if (result.data.scheduleSelect == 1) {
                        $('#scheduleInterviewBtnSave,#rejectSlotBtnSave').addClass('d-none');
                    }
                }
                $('#scheduleSlotBookModal').appendTo('body').modal('show');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

$('#scheduleSlotBookModal').on('hidden.bs.modal', function () {
    $('.slot-main-div').html('');
    $('.choose-slot-textarea textarea').val('');
    $('.choose-slot-textarea').addClass('d-none');
    $('#selectedSlotBookValidationErrorsBox').addClass('d-none')
    $('#historyDiv').html('');
    $('#scheduleInterviewBtnSave,#rejectSlotBtnSave').attr('disabled', false);
    $('#rejectSlotBtnSave').val('');
});

$('#rejectSlotBtnSave').click(function () {
    $(this).val('rejectSlot');
});
$('#scheduleInterviewBtnSave').click(function () {
    $('#rejectSlotBtnSave').val('');
});
$(document).on('submit', '#scheduleSlotBookForm', function (e) {
    e.preventDefault();
    $('#scheduleInterviewBtnSave,#rejectSlotBtnSave').attr('disabled', true);
    let appliedJobId = $('.schedule-slot-book').attr('data-id');
    let scheduleId;
    let formData = new FormData($(this)[0]);
    $.each($('.slot-book'), function (i) {
        if ($(this).prop('checked')) {
            scheduleId = $(this).data('schedule');
        }
    });
    formData.append('rejectSlot', $('#rejectSlotBtnSave').val());
    formData.append('schedule_id', scheduleId);
    $.ajax({
        url: candidateAppliedJobUrl + '/' + appliedJobId + '/choose-preference',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $('#scheduleSlotBookModal').modal('hide');
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
            $('#scheduleInterviewBtnSave,#rejectSlotBtnSave').attr('disabled', false);
        },
        complete: function () {
            processingBtn('#scheduleSlotBookForm', '#scheduleInterviewBtnSave');
        },
    });
});
