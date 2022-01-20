<?php

namespace App\Http\Livewire;

use App\Models\ReportedJob;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Class ReportedJobs
 */
class ReportedJobs extends Component
{
    use WithPagination;

    /**
     * @var int
     */
    private $perPage = 8;

    /**
     * @var string
     */
    public $searchByReportedJob = '';
    public $filterReportedDate = '';

    /**
     * @var string
     */
    protected $paginationTheme = 'bootstrap';

    /**
     * @var string[]
     */
    protected $listeners = ['deleteReportedJob', 'changeFilter'];

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
     * @param  int  $reportedJobId
     */
    public function deleteReportedJob($reportedJobId)
    {
        $reportedJob = ReportedJob::findOrFail($reportedJobId);
        $reportedJob->delete();
        $this->dispatchBrowserEvent('delete');
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
     * @return Application|Factory|View
     */
    public function render()
    {
        $reportedJobs = $this->reportedJob();

        return view('livewire.reported-jobs', compact('reportedJobs'));
    }

    /**
     * @return LengthAwarePaginator
     */
    public function reportedJob()
    {
        $query = ReportedJob::with(['user.candidate', 'job.company', 'user' => function($query) {
            $query->without(['media', 'country', 'state', 'city']);
        }])->select('reported_jobs.*')->orderBy('created_at',
            'desc');

        $query->when(isset($this->filterReportedDate) && $this->filterReportedDate != '', function (Builder $q) {
            $q->whereMonth('reported_jobs.created_at', $this->filterReportedDate);
        });

        $query->when(isset($this->searchByReportedJob) && $this->searchByReportedJob != '', function (Builder $q) {
            if ($this->filterReportedDate == '') {
                $q->whereHas('job', function (Builder $q) {
                    $q->where('job_title', 'like',
                        '%'.strtolower($this->searchByReportedJob).'%');
                })
                    ->orWhereHas('user', function (Builder $q) {
                        $q->where('first_name', 'like', '%'.$this->searchByReportedJob.'%');
                    })
                    ->orWhereHas('user', function (Builder $q) {
                        $q->where('last_name', 'like', '%'.$this->searchByReportedJob.'%');
                    });
            } else {
                $q->whereHas('job', function (Builder $q) {
                    $q->where('job_title', 'like',
                        '%'.strtolower($this->searchByReportedJob).'%')->whereMonth('reported_jobs.created_at',
                        $this->filterReportedDate);
                })
                    ->orWhereHas('user', function (Builder $q) {
                        $q->where('first_name', 'like',
                            '%'.$this->searchByReportedJob.'%')->whereMonth('reported_jobs.created_at',
                            $this->filterReportedDate);
                    })
                    ->orWhereHas('user', function (Builder $q) {
                        $q->where('last_name', 'like',
                            '%'.$this->searchByReportedJob.'%')->whereMonth('reported_jobs.created_at',
                            $this->filterReportedDate);
                    });
            }
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
