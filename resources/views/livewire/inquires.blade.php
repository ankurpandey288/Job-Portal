<div class="employee-card">
    <div class="row">
        @if(count($inquires) > 0 || $searchInquiry != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchInquiry" id="searchInquiry"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($inquires as $inquiry)
            @include('inquires.inquiry_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchInquiry)
                        {{ __('messages.inquiry.no_inquiry_found') }}
                    @else
                        {{ __('messages.inquiry.no_inquiry_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($inquires->count() > 0)
                    {{$inquires->links()}}
                @endif
            </div>
        </div>
    </div>
</div>

