<div class="employee-card">
    <div class="row">
        @if(count($reportedEmployers) > 0 || $searchByEmployee != '' || $filterReportedDate != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchByEmployee" id="searchByEmployee"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($reportedEmployers as $reportedEmployee)
            @include('employer.companies.reported_employee_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchByEmployee)
                        {{ __('messages.company.no_reported_employer_found') }}
                    @else
                        {{ __('messages.company.no_employee_reported_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($reportedEmployers->count() > 0)
                    {{$reportedEmployers->links()}}
                @endif
            </div>
        </div>
    </div>
</div>

