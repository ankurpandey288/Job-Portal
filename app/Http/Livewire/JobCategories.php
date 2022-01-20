<?php

namespace App\Http\Livewire;

use App\Models\JobCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Class JobCategories
 */
class JobCategories extends Component
{
    use WithPagination;

    /**
     * @var string
     */
    public $searchByJobCategory = '';
    public $filterFeatured = '';

    /**
     * @var int
     */
    private $perPage = 16;

    /**
     * @var string
     */
    protected $paginationTheme = 'bootstrap';

    /**
     * @var string[]
     */
    protected $listeners = ['changeFilter', 'refresh' => '$refresh', 'deleteJobCategory'];

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
     * @param $param
     * @param $value
     */
    public function changeFilter($param, $value)
    {
        $this->resetPage();
        $this->$param = $value;
    }

    /**
     * @param  int  $jobCategoryId
     */
    public function deleteJobCategory($jobCategoryId)
    {
        $jobCategory = JobCategory::findOrFail($jobCategoryId);
        $jobCategory->delete();
        $this->dispatchBrowserEvent('delete');
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        $jobCategories = $this->jobCategory();

        return view('livewire.job-categories', compact('jobCategories'));
    }

    /**
     * @return LengthAwarePaginator
     */
    public function jobCategory()
    {
        $query = JobCategory::query()->select('job_categories.*');

        $query->when(isset($this->searchByJobCategory) && $this->searchByJobCategory != '', function (Builder $q) {
            $q->where('name', 'like',
                '%'.strtolower($this->searchByJobCategory).'%');
        });

        $query->when(isset($this->filterFeatured) && $this->filterFeatured != '',
            function (Builder $q) {
                $q->where('is_featured', '=', $this->filterFeatured);
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
