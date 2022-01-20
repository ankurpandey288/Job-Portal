<?php

namespace App\Http\Livewire;

use App\Models\State;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Class States
 */
class States extends Component
{
    use WithPagination;

    /**
     * @var string
     */
    public $searchByState = '';
    public $filterCountry = '';

    /**
     * @var int
     */
    private $perPage = 8;

    /**
     * @var string
     */
    protected $paginationTheme = 'bootstrap';

    /**
     * @var string[]
     */
    protected $listeners = ['changeFilter', 'refresh' => '$refresh', 'deleteState'];

    /**
     * @return string
     */
    public function paginationView()
    {
        return 'livewire.custom-pagenation-jobs';
    }

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
     * @param $param
     * @param $value
     */
    public function changeFilter($param, $value)
    {
        $this->resetPage();
        $this->$param = $value;
    }

    public function updatingSearchByState()
    {
        $this->resetPage();
    }

    /**
     * @param  int  $stateId
     */
    public function deleteState($stateId)
    {
        $state = State::findOrFail($stateId);
        $state->delete();
        $this->dispatchBrowserEvent('delete');
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        $states = $this->state();

        return view('livewire.states', compact('states'));
    }

    /**
     * @return LengthAwarePaginator
     */
    public function state()
    {
        $query = State::with('country')->select('states.*');

        $query->when(isset($this->filterCountry) && $this->filterCountry != '', function (Builder $q) {
            $q->where('states.country_id', '=', $this->filterCountry);
        });

        $query->when(isset($this->searchByState) && $this->searchByState != '', function (Builder $q) {
            $q->Where('name', 'like',
                '%'.strtolower($this->searchByState).'%');

            $q->whereHas('country', function (Builder $q) {
                $q->orWhere('name', 'like',
                    '%'.strtolower($this->searchByState).'%');
            });
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
