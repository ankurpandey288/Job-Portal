<div class="row resumes">
    <div class="col-md-12">
        <h4>{{ $user->full_name }}</h4>
        <div class="mt-3">
            @isset($user->candidate->full_location)
            <p class="mb-1"><i class="fas fa-map-marker-alt"></i> {{ $user->candidate->full_location}}</p>
            @endisset
            <p class="mb-1"><i class="fas fa-envelope"></i> {{ $user->email}}</p>
            <p>{{ $user->phone}}</p>
        </div>
    </div>
    <div class="col-md-12">
        @if($user->candidateSkill->count())
            <h1 class="text-center"><i class="fas fa-list-ul graduate-icon text-primary"></i></h1>
            <div class="section_title">
                <div class="section_header_title">{{ __('messages.candidate.candidate_skill') }}</div>
            </div>
            <ul class="pl-3">
                @foreach($user->candidateSkill as $skill)
                    <li class="font-weight-bold">{{ $skill->name }}</li>
                @endforeach
            </ul>
        @endif
    </div>
    <div class="col-md-12">
        @if($candidateEducations->count())
            <h1 class="text-center"><i class="fas fa-user-graduate graduate-icon text-primary"></i></h1>
            <div class="section_title">
                <div class="section_header_title">{{ __('messages.candidate_profile.education') }}</div>
            </div>
        @endif
        <div class="row">
            @foreach($candidateEducations as $candidateEducation)
                <div class="col-6 mt-3">
                    <h5 class="">{{ $candidateEducation->degreeLevel->name }}</h5>
                    <h6 class="text-muted">{{ $candidateEducation->degree_title }}</h6>
                    <span class="text-muted">{{ $candidateEducation->year }} | {{ $candidateEducation->country }}</span>
                    <p class="mb-0">{{ $candidateEducation->institute }}</p>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-12">
        @if($candidateExperiences->count())
        <h1 class="text-center"><i class="fas fa-briefcase graduate-icon text-primary"></i></h1>
        <div class="section_title">
            <div class="section_header_title">{{ __('messages.candidate_profile.experience') }}</div>
        </div>
        @endif
        <div class="row">
            @foreach($candidateExperiences as $candidateExperience)
                <div class="col-6 mt-3">
                    <h5>{{ $candidateExperience->company }}</h5>
                    <h6>{{ $candidateExperience->country }}</h6>
                    <span class="text-muted">{{ \Carbon\Carbon::parse($candidateExperience->start_date)->format('jS M, Y')}} - </span>
                    @if($candidateExperience->currently_working)
                        <span class="text-muted">{{ __('messages.candidate_profile.present') }}</span>
                    @else
                        <span class="text-muted"> {{\Carbon\Carbon::parse($candidateExperience->end_date)->format('jS M, Y')}} </span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-12">
        @if($user->is_online_profile_availbal)
        <h1 class="text-center"><i class="fas fa-link graduate-icon text-primary"></i></h1>
        <div class="section_title">
            <div class="section_header_title">{{ __('messages.candidate_profile.online_profile') }}</div>
        </div>
        @endif
        <a class="font-weight-bold d-block mb-2" href="{{ $user->facebook_url }}"
           target="_blank" id="facebook_url">{{ $user->facebook_url }}</a>
        <a class="font-weight-bold d-block mb-2" href="{{ $user->twitter_url }}"
           target="_blank" id="twitter_url">{{ $user->twitter_url }}</a>
        <a class="font-weight-bold d-block mb-2" href="{{ $user->linkedin_url }}"
           target="_blank" id="linkedin_url">{{ $user->linkedin_url }}</a>
        <a class="font-weight-bold d-block mb-2" href="{{ $user->google_plus_url }}"
           target="_blank" id="google_plus_url">{{ $user->google_plus_url }}</a>
        <a class="font-weight-bold d-block mb-2" href="{{ $user->pinterest_url }}"
           target="_blank" id="pinterest_url">{{ $user->pinterest_url }}</a>
    </div>
</div>
