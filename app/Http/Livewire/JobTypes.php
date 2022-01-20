<?php

namespace App\Http\Livewire;

use App\Models\JobType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Class JobTypes
 */
class JobTypes extends Component
{
    use WithPagination;

    /**
     * @var string
     */
    public $searchByJobTypes = '';

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
    protected $listeners = ['refresh' => '$refresh', 'deleteJobType'];

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
     * @param  int  $jobTypeId
     */
    public function deleteJobType($jobTypeId)
    {
        $jobType = JobType::findOrFail($jobTypeId);
        $jobType->delete();
        $this->dispatchBrowserEvent('delete');
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        $jobTypes = $this->jobType();

        return view('livewire.job-types', compact('jobTypes'));
    }

    /**
     * @return LengthAwarePaginator
     */
    public function jobType()
    {
        $query = JobType::query()->select('job_types.*');

        $query->when(isset($this->searchByJobTypes) && $this->searchByJobTypes != '', function (Builder $q) {
            $q->where('name', 'like',
                '%'.strtolower($this->searchByJobTypes).'%');
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
