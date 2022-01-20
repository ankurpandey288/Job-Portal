<div>
    @if(count($jobSchedules) > 0)
        @foreach($jobSchedules as $batch => $jobSchedule)
            <div class="slot-box-inner mb-3">
                <div class="slot-box-inner-heading d-flex justify-content-between align-items-center">
                    <h1>{{__('messages.job_stage.batch')}} {{$batch}}</h1>
                    @if(!$isStatusNotSend)
                    <a href="javascript:void(0)" class="btn btn-primary form-btn float-right batch-slot" data-batch="{{ $batch }}">
                        {{ __('messages.common.add') }}
                    </a>
                    @endif
                </div>
                @foreach($jobSchedule as $key => $value)
                    <div class="slot-data mb-3 {{$value->status == \App\Models\JobApplicationSchedule::STATUS_REJECTED ? 'slot-box-danger' : ''}}{{$value->status == \App\Models\JobApplicationSchedule::STATUS_SEND ? 'slot-box-success' : ''}}">
                        <div class="row p-3">
                            <div class="col-sm-1 d-flex justify-content-center align-items-center">
                                <h6>{{$loop->iteration}}.</h6>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label name="date">{{ __('messages.job_stage.date').':' }}</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" class="form-control" name=""
                                           value="{{ $value->date }}" disabled required>
                                </div>
                                <div class="form-group mb-0">
                                    <label name="time">{{ __('messages.job_stage.time').':' }}</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" class="form-control" name=""
                                           value="{{ $value->time }}" disabled required>
                                </div>
                            </div>
                            <div class="form-group col-sm-6 mb-0">
                                <label name="notes" class="d-flex justify-content-between">{{ __('messages.job.notes').':' }}
                                    <div class="h-100" style="margin-top: -10px;">
                                        @if(!$isStatusNotSend)
                                        <a title="{{ __('messages.common.edit') }}"
                                           class="btn mt-1 mb-1 mr-2 btn-warning action-btn edit-btn"
                                           href="javascript:void(0)" data-id="{{$value->id}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        @endif
                                        <a title="{{ __('messages.common.delete') }}" class="btn btn-danger action-btn delete-btn h-100"                                                            data-id="{{$value->id}}" href="javascript:void(0)">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </label>
                                <textarea class="form-control textarea-sizing" name=""
                                          disabled>{{ $value->notes }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row p-3 choose-slot-textarea {{ ($value->status == \App\Models\JobApplicationSchedule::STATUS_SEND) ? '' : 'd-none' }}">
                        {{ Form::label('candidate_slot', __('messages.job_stage.candidate_note').':') }}
                        <textarea name="choose_slot_notes" class="textarea-sizing" disabled
                                  placeholder="Enter Notes...">{{ $value->rejected_slot_notes }}</textarea>
                        {{ Form::label('candidate_slot', __('messages.job_stage.your_note').':', ['class' => 'mt-3']) }}
                        <span class="text-danger mt-3">*</span>
                        <textarea name="cancel_slot_notes"
                                  class="textarea-sizing  cancel-slot-notes" required
                                  placeholder="Enter Cancel Reason..."></textarea>
                        <a href="javascript:void(0)"
                           class="btn btn-danger form-btn float-right cancel-slot mt-4 mx-auto"
                           data-schedule="{{$value->id}}">{{ __('messages.job_stage.cancel_slot') }}</a>
                    </div>
                @endforeach

                <?php
                $candidateRejectedSlot = $jobSchedule->where('status', App\Models\JobApplicationSchedule::STATUS_REJECTED)
                    ->where('employer_cancel_slot_notes', '==', null)->count();
                $employerRejectedSlot = $jobSchedule->where('status', App\Models\JobApplicationSchedule::STATUS_REJECTED)
                    ->where('employer_cancel_slot_notes', '!=', null)->count();
                ?>
                @if($candidateRejectedSlot > 0)
                    <div class="row p-3 choose-slot-textarea
                                {{ ($value->status == \App\Models\JobApplicationSchedule::STATUS_REJECTED && empty($value->employer_cancel_slot_notes)) ? '' : 'd-none' }}">
                        <div class="col-sm-12 d-flex flex-column">
                            <span><b>Reason:-</b> {{ $value->rejected_slot_notes }}</span>
                            <span name="choose_slot_notes">
                                {{ $value->jobApplication->candidate->user->full_name . __('messages.job_stage.cancel_this_slot') }}
                            </span>
                        </div>
                    </div>
                @endif
                @if($employerRejectedSlot > 0 && !empty($value->rejected_slot_notes))
                    <div class="row p-3 choose-slot-textarea
{{ ($value->status == \App\Models\JobApplicationSchedule::STATUS_REJECTED && !empty($value->employer_cancel_slot_notes)) ? '' : 'd-none' }}">
                        <div class="col-sm-12 d-flex flex-column">
                            <span><b>Reason:-</b> {{ $value->employer_cancel_slot_notes }}</span>
                            <span name="choose_slot_notes">
                                You cancel this slot for date:- {{ $value->date }} and time:- {{ $value->time }}
                            </span>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    @else
        <div class="col-lg-12 col-md-12 d-flex justify-content-center">
            <h5>{{ __('messages.job_stage.no_slot_available') }} </h5>
        </div>
    @endif
</div>
