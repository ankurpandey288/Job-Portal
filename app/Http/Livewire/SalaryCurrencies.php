<?php

namespace App\Http\Livewire;

use App\Models\SalaryCurrency;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Class SalaryCurrencies
 */
class SalaryCurrencies extends Component
{
    use WithPagination;

    /**
     * @var string
     */
    public $searchSalaryCurrencies = '';

    /**
     * @var string[]
     */
    protected $listeners = ['refresh' => '$refresh', 'deleteSalaryCurrencies'];

    /**
     * @var int
     */
    private $perPage = 8;

    /**
     * @return string
     */
    public function paginationView(): string
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
     * @param $salaryCurrenciesId
     */
    public function deleteCountry($salaryCurrenciesId)
    {
        $salaryCurrencies = SalaryCurrency::findOrFail($salaryCurrenciesId);
        $salaryCurrencies->delete();
        $this->dispatchBrowserEvent('delete');
    }

    public function updatingSearchSalaryCurrencies()
    {
        $this->resetPage();
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        $salaryCurrencies = $this->salaryCurrencies();

        return view('livewire.salary-currencies', compact('salaryCurrencies'));
    }

    /**
     * @return LengthAwarePaginator
     */
    public function salaryCurrencies(): LengthAwarePaginator
    {
        $query = SalaryCurrency::query()->select('salary_currencies.*');

        $query->when(isset($this->searchSalaryCurrencies) && $this->searchSalaryCurrencies != '', function (Builder $q) {
            $q->where('currency_name', 'like',
                '%'.strtolower($this->searchSalaryCurrencies).'%');
            $q->orWhere('currency_code', 'like',
                '%'.strtolower($this->searchSalaryCurrencies).'%');
            $q->orWhere('currency_icon', 'like',
                '%'.strtolower($this->searchSalaryCurrencies).'%');
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
