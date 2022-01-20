<div class="employee-card">
    <div class="row">
        @if(count($companySizes) > 0 || $searchByCompanySize != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchByCompanySize" id="searchByCompanySize"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($companySizes as $companySize)
            @include('company_sizes.company_size_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchByCompanySize)
                        {{ __('messages.company_size.no_company_size_found') }}
                    @else
                        {{ __('messages.company_size.no_company_size_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($companySizes->count() > 0)
                    {{$companySizes->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
