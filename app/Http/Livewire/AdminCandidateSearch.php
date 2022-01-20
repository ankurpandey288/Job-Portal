<?php

namespace App\Http\Livewire;

use App\Models\Candidate;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Class AdminCandidateSearch
 */
class AdminCandidateSearch extends Component
{
    use WithPagination;

    /**
     * @var int
     */
    private $perPage = 8;

    /**
     * @var string
     */
    public $searchByAdminCandidate = '';
    public $status = '';
    public $immediateAvailable = '';
    public $jobSkills = '';

    /**
     * @var string
     */
    protected $paginationTheme = 'bootstrap';

    /**
     * @var string[]
     */
    protected $listeners = ['changeFilter', 'deleteCandidate'];

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
     * @param $candidateID
     */
    public function deleteCandidate($candidateID)
    {
        $candidate = Candidate::findOrFail($candidateID);
        $candidate->delete();
        $candidate->user->media()->delete();
        $candidate->user->delete();

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

    public function updatingSearchByAdminCandidate()
    {
        $this->resetPage();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        $candidates = $this->searchCandidate();

        return view('livewire.admin-candidate-search', compact('candidates'));
    }

    /**
     * @return mixed
     */
    public function searchCandidate()
    {
        /** @var Candidate $query */
        $query = Candidate::with(['user', 'industry', 'user.candidateSkill'])->select('candidates.*');

        $query->when(isset($this->searchByAdminCandidate),
            function (Builder $q) {
                $q->whereHas('user', function (Builder $q) {
                    $q->where('first_name', 'like',
                        '%'.strtolower($this->searchByAdminCandidate).'%')
                        ->orWhere('email', 'like', '%'.strtolower($this->searchByAdminCandidate).'%');
                });
            });

        $query->when(! empty($this->status) && $this->status == 1,
            function (Builder $q) {
                $q->whereHas('user', function (Builder $q) {
                    $q->where('is_active', '=', 1);
                });
            });

        $query->when(($this->status != '') && $this->status == 0,
            function (Builder $q) {
                $q->wherehas('user', function (Builder $q) {
                    $q->where('is_active', '=', 0);
                });
            });

        $query->when(isset($this->immediateAvailable) && $this->immediateAvailable != '',
            function (Builder $q) {
                $q->where('immediate_available', $this->immediateAvailable);
            });

        $query->when(($this->jobSkills != ''), function (Builder $q) {
            $q->whereHas('user.candidateSkill', function (Builder $query) {
                $query->where('skill_id', $this->jobSkills);
            });
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
