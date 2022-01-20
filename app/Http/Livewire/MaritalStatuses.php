<?php

namespace App\Http\Livewire;

use App\Models\MaritalStatus;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Class MaritalStatuses
 */
class MaritalStatuses extends Component
{
    use WithPagination;

    /**
     * @var string
     */
    public $searchByMaritalStatus = '';
    /**
     * @var string
     */
    protected $paginationTheme = 'bootstrap';
    /**
     * @var string[]
     */
    protected $listeners = ['refresh' => '$refresh', 'deleteMaritalStatus'];
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
     * @param $maritalStatusId
     */
    public function deleteMaritalStatus($maritalStatusId)
    {
        $maritalStatus = MaritalStatus::findOrFail($maritalStatusId);
        $maritalStatus->delete();
        $this->dispatchBrowserEvent('delete');
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        $maritalStatuses = $this->maritalStatus();

        return view('livewire.marital-statuses', compact('maritalStatuses'));
    }

    /**
     * @return LengthAwarePaginator
     */
    public function maritalStatus()
    {
        $query = MaritalStatus::query()->select('marital_status.*');

        $query->when(isset($this->searchByMaritalStatus) && $this->searchByMaritalStatus != '', function (Builder $q) {
            $q->where('marital_status', 'like',
                '%'.strtolower($this->searchByMaritalStatus).'%');
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
