<section class="ptb40 bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <input wire:model.debounce.100ms="searchByCompany" type="text" id="searchByCompany"
                       placeholder="Search Company" class="form-control">
            </div>
        </div>
        <div class="job-post-wrapper mt10">
            <div class="row">
                <div class="col-md-12">
                    <div wire:loading wire:loading.class="col-md-12 text-center  font-weight-blod proceesing">
                        {{ __('web.company_details.processing') }}
                    </div>
                </div>
                @forelse($companies as $company)
                    @include('web.common.company_card')
                @empty
                    <div class="col-md-12">
                        <h5 class="text-black text-center">{{ __('web.companies_menu.no_company_found') }}</h5>
                    </div>
                @endforelse
            </div>

            @if($companies->count() > 0)
                {{$companies->links()}}
            @endif
        </div>
    </div>
</section>
