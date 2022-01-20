<div class="employee-card">
    <div class="row">
        @if(count($maritalStatuses) > 0 || $searchByMaritalStatus != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchByMaritalStatus" id="searchByMaritalStatus"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($maritalStatuses as $maritalStatus)
            @include('marital_status.marital_status_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchByMaritalStatus)
                        {{ __('messages.marital_status.no_marital_status_found') }}
                    @else
                        {{ __('messages.marital_status.no_marital_status_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($maritalStatuses->count() > 0)
                    {{$maritalStatuses->links()}}
                @endif
            </div>
        </div>
    </div>
</div>

