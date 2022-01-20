<div class="employee-card">
    <div class="row">
        @if(count($skills) > 0 || $searchBySkills != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchBySkills" id="searchBySkills"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($skills as $skill)
            @include('skills.skill_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchBySkills)
                        {{ __('messages.skill.no_skill_found') }}
                    @else
                        {{ __('messages.skill.no_skill_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($skills->count() > 0)
                    {{$skills->links()}}
                @endif
            </div>
        </div>
    </div>
</div>

