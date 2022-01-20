<div class="employee-card">
    <div class="row">
        @if(count($salaryPeriods) > 0 || $searchBySalaryPeriods != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchBySalaryPeriods" id="searchBySalaryPeriods"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($salaryPeriods as $salaryPeriod)
            @include('salary_periods.salary_period_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchBySalaryPeriods)
                        {{ __('messages.salary_period.no_salary_period_found') }}
                    @else
                        {{ __('messages.salary_period.no_salary_period_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($salaryPeriods->count() > 0)
                    {{$salaryPeriods->links()}}
                @endif
            </div>
        </div>
    </div>
</div>

