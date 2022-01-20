<?php

namespace App\Http\Livewire;

use App\Models\FavouriteJob;
use App\Models\Job;
use Auth;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class FavoriteJobs extends Component
{
    use WithPagination;

    public $searchByJob = '';
    public $filterFavouriteJobs = '';
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['removeJob', 'changeFilter', 'resetFilter'];
    private $perPage = 5;

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

    public function resetFilter()
    {
        $this->reset();
    }

    /**
     * @param  int  $id
     */
    public function removeJob($id)
    {
        $favouriteJob = FavouriteJob::findOrFail($id);
        $favouriteJob->delete($id);
        $this->dispatchBrowserEvent('deleted');
        $this->resetPage();
    }

    public function updatingSearchByJob()
    {
        $this->resetPage();
    }

    /**
     * @return Factory|View
     */
    public function render()
    {
        $favouriteJobs = $this->searchFavouriteJob();
        $jobStatus = Job::FAVORITE_JOB_STATUS;

        return view('livewire.favorite-jobs', compact('favouriteJobs', 'jobStatus'))->with('searchByJob');
    }

    /**
     * @return LengthAwarePaginator
     */
    public function searchFavouriteJob()
    {
        $query = FavouriteJob::with(['job.company.user', 'job'])->orderByDesc('created_at');
        $query->where('user_id', Auth::id());

        $query->when($this->searchByJob != '', function (Builder $query) {
            $query->where(function (Builder $query) {
                $query->whereHas('job.company.user', function (Builder $query) {
                    $query->where('first_name', 'like', '%'.strtolower($this->searchByJob).'%');
                });
                $query->orWhereHas('job', function (Builder $query) {
                    $query->where('job_title', 'like', '%'.strtolower($this->searchByJob).'%');
                    $query->orWhere('job_expiry_date', 'like', '%'.strtolower($this->searchByJob).'%');
                    $query->orWhereHas('country', function (Builder $q) {
                        $q->where('name', 'like', '%'.$this->searchByJob.'%');
                    });
                    $query->orWhereHas('state', function (Builder $q) {
                        $q->where('name', 'like', '%'.$this->searchByJob.'%');
                    });
                    $query->orWhereHas('city', function (Builder $q) {
                        $q->where('name', 'like', '%'.$this->searchByJob.'%');
                    });
                });
            });
        });

        $query->when($this->filterFavouriteJobs != '', function (Builder $query) {
            $query->whereHas('job', function (Builder $q) {
                $q->where('status', $this->filterFavouriteJobs);
            });
        });
        $query->where('user_id', Auth::id());

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
