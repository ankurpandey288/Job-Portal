@foreach($data['candidateExperiences'] as $candidateExperience)
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 candidate-experience"
         data-experience-id="{{ $loop->index }}"
         data-id="{{ $candidateExperience->id }}">
        <article class="article article-style-b ">
            <div class="article-details border-0">
                <div class="article-title">
                    <h5 class="experience-title">{{ Str::limit($candidateExperience->experience_title,50,'...') }}</h5>
                    <h6 class="text-muted">{{ $candidateExperience->company }}</h6>
                </div>
                <span class="text-muted">{{ \Carbon\Carbon::parse($candidateExperience->start_date)->format('jS M, Y')}} - </span>
                <span class="text-muted">
                    {{ ($candidateExperience->currently_working) ? __('messages.candidate_profile.present') : \Carbon\Carbon::parse($candidateExperience->end_date)->format('jS M, Y') }}
                </span>
                <span> | {{ $candidateExperience->country }}</span>
                @if(!empty($candidateExperience->description))
                    <p class="mb-0">{{ Str::limit($candidateExperience->description,225,'...') }}</p>
                @endif

                <div class="article-cta candidate-experience-edit-delete">
                    <a href="javascript:void(0)" class=" action-btn edit-experience" title="Edit"
                       data-id="{{ $candidateExperience->id }}"><i
                                class="fa fa-edit p-1"></i></a>
                    <a href="javascript:void(0)"
                       class="text-danger action-btn delete-experience" title="Delete"
                       data-id="{{ $candidateExperience->id }}"><i
                                class="fa fa-trash p-1"></i></a>
                </div>
            </div>
        </article>
    </div>
@endforeach
