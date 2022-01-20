<div class="employee-card">
    <div class="row">
        @if(count($candidateResumes) > 0 || $searchByResume != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchByResume" id="searchByResume"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($candidateResumes as $candidateResume)
                @include('resumes.resume_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchByResume)
                        {{ __('messages.resumes.no_resume_found') }}
                    @else
                        {{ __('messages.resumes.no_resume_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($candidateResumes->count() > 0)
                    {{$candidateResumes->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
