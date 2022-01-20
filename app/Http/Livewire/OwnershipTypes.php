<?php

namespace App\Http\Livewire;

use App\Models\OwnerShipType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Class OwnershipTypes
 */
class OwnershipTypes extends Component
{
    use WithPagination;

    /**
     * @var string
     */
    public $searchByOwnershipType = '';

    /**
     * @var string
     */
    protected $paginationTheme = 'bootstrap';

    /**
     * @var string[]
     */
    protected $listeners = ['refresh' => '$refresh', 'deleteOwnershipType'];

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
     * @param $ownershipTypeId
     */
    public function deleteOwnershipType($ownershipTypeId)
    {
        $ownershipType = OwnerShipType::findOrFail($ownershipTypeId);
        $ownershipType->delete();
        $this->dispatchBrowserEvent('delete');
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        $ownershipTypes = $this->ownershipType();

        return view('livewire.ownership-types', compact('ownershipTypes'));
    }

    /**
     * @return LengthAwarePaginator
     */
    public function ownershipType(): LengthAwarePaginator
    {
        $query = OwnerShipType::query()->select('ownership_types.*');

        $query->when(isset($this->searchByOwnershipType) && $this->searchByOwnershipType != '', function (Builder $q) {
            $q->where('name', 'like',
                '%'.strtolower($this->searchByOwnershipType).'%');
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
