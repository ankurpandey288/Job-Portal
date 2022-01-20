<?php

namespace App\Http\Livewire;

use App\Models\SalaryPeriod;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Class SalaryPeriods
 */
class SalaryPeriods extends Component
{
    use WithPagination;

    /**
     * @var string
     */
    public $searchBySalaryPeriods = '';
    /**
     * @var string
     */
    protected $paginationTheme = 'bootstrap';
    /**
     * @var string[]
     */
    protected $listeners = ['refresh' => '$refresh', 'deleteSalaryPeriod'];
    /**
     * @var int
     */
    private $perPage = 16;

    /**
     * @return string
     */
    public function paginationView()
    {
        return 'livewire.custom-pagenation-jobs';
    }

    /**
     * @param $lastPage
     */
    public function nextPage($lastPage)
    {
        if ($this->page < $lastPage) {
            $this->page = $this->page + 1;
        }
    }

    public function previousPage()
    {
        if ($this->page > 1) {
            $this->page = $this->page - 1;
        }
    }

    /**
     * @param  int  $salaryPeriodId
     */
    public function deleteSalaryPeriod($salaryPeriodId)
    {
        $salaryPeriod = SalaryPeriod::findOrFail($salaryPeriodId);
        $salaryPeriod->delete();
        $this->dispatchBrowserEvent('delete');
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        $salaryPeriods = $this->salaryPeriod();

        return view('livewire.salary-periods', compact('salaryPeriods'));
    }

    /**
     * @return LengthAwarePaginator
     */
    public function salaryPeriod()
    {
        $query = SalaryPeriod::query()->select('salary_periods.*');

        $query->when(isset($this->searchBySalaryPeriods) && $this->searchBySalaryPeriods != '', function (Builder $q) {
            $q->where('period', 'like',
                '%'.strtolower($this->searchBySalaryPeriods).'%');
        });

        $all = $query->paginate($this->perPage);
        $currentPage = $all->currentPage();
        $lastPage = $all->lastPage();
        if ($currentPage > $lastPage) {
            $this->page = $lastPage;
            $all = $query->paginate($this->perPage);
        }

        return $all;
    }
}
