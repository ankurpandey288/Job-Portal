@foreach($data['candidateEducations'] as $candidateEducation)
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 candidate-education"
         data-education-id="{{ $loop->index }}"
         data-id="{{ $candidateEducation->id }}">
        <article class="article article-style-b">
            <div class="article-details border-0">
                <div class="article-title">
                    <h5 class="education-degree-level">{{ $candidateEducation->degreeLevel->name }}</h5>
                    <h6 class="text-muted">{{ $candidateEducation->degree_title }}</h6>
                </div>
                <span class="text-muted">{{ $candidateEducation->year }} | {{ $candidateEducation->country }}</span>
                <p class="mb-0">{{ Str::limit($candidateEducation->institute,50,'...') }}</p>
                <div class="article-cta candidate-education-edit-delete">
                    <a href="javascript:void(0)" class="action-btn edit-education" title="Edit"
                       data-id="{{ $candidateEducation->id }}"><i
                                class="fa fa-edit p-1"></i></a>
                    <a href="javascript:void(0)"
                       class="text-danger action-btn delete-education" title="Delete"
                       data-id="{{ $candidateEducation->id }}"><i
                                class="fa fa-trash p-1"></i></a>
                </div>
            </div>
        </article>
    </div>
@endforeach
