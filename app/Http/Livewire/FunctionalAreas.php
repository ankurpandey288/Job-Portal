<?php

namespace App\Http\Livewire;

use App\Models\FunctionalArea;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Class FunctionalAreas
 */
class FunctionalAreas extends Component
{
    use WithPagination;

    /**
     * @var string
     */
    public $searchByFunctionalAreaName = '';

    /**
     * @var string
     */
    protected $paginationTheme = 'bootstrap';

    /**
     * @var string[]
     */
    protected $listeners = ['refresh' => '$refresh', 'deleteFunctionalArea'];

    /**
     * @var int
     */
    private $perPage = 16;

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
     * @param $functionalAreaId
     */
    public function deleteFunctionalArea($functionalAreaId)
    {
        $functionalArea = FunctionalArea::findOrFail($functionalAreaId);
        $functionalArea->delete();
        $this->dispatchBrowserEvent('delete');
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        $functionalAreas = $this->functionalArea();

        return view('livewire.functional-areas', compact('functionalAreas'));
    }

    /**
     * @return LengthAwarePaginator
     */
    public function functionalArea(): LengthAwarePaginator
    {
        $query = FunctionalArea::query()->select('functional_areas.*');

        $query->when(isset($this->searchByFunctionalAreaName) && $this->searchByFunctionalAreaName != '', function (Builder $q) {
            $q->where('name', 'like',
                '%'.strtolower($this->searchByFunctionalAreaName).'%');
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
