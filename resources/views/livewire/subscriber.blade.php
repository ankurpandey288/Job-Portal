<div class="employee-card">
    <div class="row">
        @if(count($subscribers) > 0 || $searchBySubscriber != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchBySubscriber" id="searchBySubscriber"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($subscribers as $subscriber)
            @include('subscribers.subscriber_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchBySubscriber)
                        {{ __('messages.no_subscriber_found') }}
                    @else
                        {{ __('messages.no_subscriber_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($subscribers->count() > 0)
                    {{$subscribers->links()}}
                @endif
            </div>
        </div>
    </div>
</div>

