<ul class="dropdown-menu d-block position-relative w-100" role="menu">
    @if(!$jobSearchResult->isEmpty() || !$skills->isEmpty() || !$companies->isEmpty())
        @foreach($jobSearchResult as $jobSearch)
            <li>{{ $jobSearch->job_title }}</li>
        @endforeach
        @foreach($skills as $skill)
            <li>{{ $skill->name }}</li>
        @endforeach
        @foreach($companies as $company)
            <li>{{ $company->user->first_name  }} {{ $company->user->last_name  }}</li>
        @endforeach
    @else
        <li class="language-text">{{ __('messages.no_keyword_found') }}</li>
    @endif
</ul>
