<?php

namespace App\Http\Livewire;

use App\Models\FavouriteCompany;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Followers extends Component
{
    use WithPagination;

    public $searchByFollowers = '';
    /**
     * @var int
     */
    private $perPage = 6;

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

    public function updatingSearchByFollowers()
    {
        $this->resetPage();
    }

    /**
     * @return Factory|View
     */
    public function render()
    {
        $followers = $this->searchFollowers();

        return view('livewire.followers', compact('followers'));
    }

    /**
     * @return LengthAwarePaginator
     */
    public function searchFollowers()
    {
        $query = FavouriteCompany::with(['user'])->where('company_id',
            getLoggedInUser()->owner_id)->orderBy('created_at', 'desc');

        if (! empty($this->searchByFollowers)) {
            $query->whereHas('user', function (Builder $query) {
                $query->where('first_name', 'like', '%'.strtolower($this->searchByFollowers).'%');
                $query->orWhere('email', 'like', '%'.strtolower($this->searchByFollowers).'%');
                $query->orWhere('phone', 'like', '%'.strtolower($this->searchByFollowers).'%');
            });
        }

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
