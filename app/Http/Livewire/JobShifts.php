<?php

namespace App\Http\Livewire;

use App\Models\JobShift;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Class JobShifts
 */
class JobShifts extends Component
{
    use WithPagination;

    /**
     * @var string
     */
    public $searchByJobShifts = '';
    /**
     * @var string
     */
    protected $paginationTheme = 'bootstrap';
    /**
     * @var string[]
     */
    protected $listeners = ['refresh' => '$refresh', 'deleteJobShift'];
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
     * @param  int  $jobShiftId
     */
    public function deleteJobShift($jobShiftId)
    {
        $jobShift = JobShift::findOrFail($jobShiftId);
        $jobShift->delete();
        $this->dispatchBrowserEvent('delete');
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        $jobShifts = $this->jobShift();

        return view('livewire.job-shifts', compact('jobShifts'));
    }

    /**
     * @return LengthAwarePaginator
     */
    public function jobShift()
    {
        $query = JobShift::query()->select('job_shifts.*');

        $query->when(isset($this->searchByJobShifts) && $this->searchByJobShifts != '', function (Builder $q) {
            $q->where('shift', 'like',
                '%'.strtolower($this->searchByJobShifts).'%');
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
