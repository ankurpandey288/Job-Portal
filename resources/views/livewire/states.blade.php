<div class="employee-card">
    <div class="row">
        @if(count($states) > 0 || $searchByState != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchByState" id="searchByState"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($states as $state)
            @include('states.state_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchByState)
                        {{ __('messages.state.no_state_found') }}
                    @else
                        {{ __('messages.state.no_state_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($states->count() > 0)
                    {{$states->links()}}
                @endif
            </div>
        </div>
    </div>
</div>

