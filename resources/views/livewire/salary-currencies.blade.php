<div class="employee-card">
    <div class="row">
        @if(count($salaryCurrencies) > 0 || $searchSalaryCurrencies != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchSalaryCurrencies" id="searchSalaryCurrencies"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($salaryCurrencies as $salaryCurrency)
            @include('salary_currencies.salary_currencies_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchSalaryCurrencies)
                        {{ __('messages.salary_currency.no_salary_currency_found') }}
                    @else
                        {{ __('messages.salary_currency.no_salary_currency_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($salaryCurrencies->count() > 0)
                    {{$salaryCurrencies->links()}}
                @endif
            </div>
        </div>
    </div>
</div>

