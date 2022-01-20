<div class="employee-card">
    <div class="row">
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchByNoticeboard" id="searchByNoticeboard"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @forelse($noticeboards as $noticeboard)
            @include('noticeboards.noticeboard_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchByNoticeboard)
                        {{ __('messages.noticeboard.no_noticeboard_found') }}
                    @else
                        {{ __('messages.noticeboard.no_noticeboard_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($noticeboards->count() > 0)
                    {{$noticeboards->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
