<div class="employee-card">
    <div class="row">
        @if(count($languages) > 0 || $searchLanguage != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchLanguage" id="searchLanguage"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($languages as $language)
            @include('languages.language_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchLanguage)
                        {{ __('messages.language.no_language_found') }}
                    @else
                        {{ __('messages.language.no_language_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($languages->count() > 0)
                    {{$languages->links()}}
                @endif
            </div>
        </div>
    </div>
</div>

