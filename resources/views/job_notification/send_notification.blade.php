<div class="row mainJobNotification">
    <div class="form-group col-xl-3 col-md-3 col-sm-12 select-candidate-width">
        {{ Form::label('candidate_id', __('messages.front_home.candidates').':') }} <span class="text-danger">*</span>
        {{Form::select('candidate_id[]',$candidates, null, ['class' => 'form-control','id'=>'candidateId','multiple'=>true,'required'])}}

        <div class="mt-3">
            <label>{{__('messages.job_notification.select_all_jobs')}}: </label>
            <input type="checkbox" class="form-group ml-2 notification_select_all" id="ckbCheckAll">
        </div>
    </div>

    <div class="form-group col-xl-9 col-md-9 col-sm-12">
        <ul class="list-unstyled job-notification-ul">
            @forelse($jobs as $key => $job)
                <li class="media mt-4 notification">
                    <input type="checkbox" name="job_id[]" class="form-group mr-2 notification__checkbox jobCheck"
                           value="{{$job->id}}">
                    <div class="media-body">
                        <a href="{{ route('admin.jobs.show',$job->id) }}" target="_blank"
                           class="media-title mb-1 notification__title">{{ $job->job_title }}</a>
                        <div class="text-time">{{ $job->created_at->diffForHumans() }}</div>
                    </div>
                </li>
                @if ($key + 1 != count($jobs))
                    <hr>
                @endif
            @empty
                <h4>{{__('messages.job_notification.no_jobs_available')}}.</h4>
            @endforelse
            <li class="no-job-available d-none"><h4>{{__('messages.job_notification.no_jobs_available')}}.</h4></li>
        </ul>
    </div>

    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary','name' => 'save', 'id' => 'saveJobNotification']) }}
        <a href="{{ route('job-notification.index') }}"
           class="btn btn-secondary text-dark">{{__('messages.common.cancel')}}</a>
    </div>
</div>
