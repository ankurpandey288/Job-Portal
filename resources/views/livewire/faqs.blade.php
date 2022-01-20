<div class="employee-card">
    <div class="row">
        @if(count($faqs) > 0 || $searchByFaq != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchByFaq" id="searchByFaq"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($faqs as $faq)
            @include('faqs.faq_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchByFaq)
                        {{ __('messages.faq.no_faq_found') }}
                    @else
                        {{ __('messages.faq.no_faq_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($faqs->count() > 0)
                    {{$faqs->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
