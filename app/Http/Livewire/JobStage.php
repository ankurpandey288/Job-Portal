<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Class JobStage
 */
class JobStage extends Component
{
    use WithPagination;

    /**
     * @var int
     */
    private $perPage = 15;

    /**
     * @var string
     */
    public $searchByJobStage = '';

    /**
     * @var string
     */
    protected $paginationTheme = 'bootstrap';

    /**
     * @var string[]
     */
    protected $listeners = ['refresh' => '$refresh', 'deleteJobStage'];

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
     * @return Application|Factory|View
     */
    public function render()
    {
        $jobStages = $this->jobStage();
        
        return view('livewire.job-stage', compact('jobStages'));
    }

    /**
     * @return LengthAwarePaginator
     */
    public function jobStage()
    {
        $companyId = Company::whereUserId(getLoggedInUserId())->without('user')->first();
        $query = \App\Models\JobStage::whereCompanyId($companyId->id)->select('job_stages.*');

        $query->when(isset($this->searchByJobStage) && $this->searchByJobStage != '', function (Builder $q) {
            $q->where('name', 'like',
                '%'.strtolower($this->searchByJobStage).'%');
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
