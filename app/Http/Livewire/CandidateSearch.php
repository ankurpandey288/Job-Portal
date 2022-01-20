<?php

namespace App\Http\Livewire;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class CandidateSearch extends Component
{
    use WithPagination;

    public $searchByCandidate = '';
    public $gender = '';
    public $searchBy = 'byJobTitle';
    public $location;
    public $min;
    public $max;

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

    public function updatingSearchByCandidate()
    {
        $this->resetPage();
    }

    public function updatinglocation()
    {
        $this->resetPage();
    }

    public function updatingMin()
    {
        $this->resetPage();
    }

    public function updatingMax()
    {
        $this->resetPage();
    }

    public function render()
    {
        $candidates = $this->searchCandidates();

        return view('livewire.candidate-search', compact('candidates'));
    }

    /**
     * @param $param
     *
     * @param $value
     */
    public function changeFilter($param, $value)
    {
        $this->resetPage();
        $this->$param = $value;
    }

    public function resetFilter()
    {
        $this->location = '';
        $this->min = '';
        $this->max = '';
        $this->searchByCandidate = '';
        $this->searchBy = 'byJobTitle';
        $this->gender = 'all';
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchCandidates()
    {
        /** @var Candidate $query */
        $query = Candidate::with(['user', 'jobApplications', 'industry'])->whereHas('user', function ($q) {
            $q->where('is_active', '=', 1);
        });

        $query->when($this->searchByCandidate != '' && $this->searchBy == 'byName', function (Builder $q) {
            $q->whereHas('user', function (Builder $query) {
                $query->where('first_name', 'like', '%'.strtolower($this->searchByCandidate).'%');
            });
        });

        $query->when($this->searchByCandidate != '' && $this->searchBy == 'byJobTitle', function (Builder $q) {
            $q->whereHas('penddingJobApplications.job', function (Builder $query) {
                $query->where('jobs.job_title', 'like', '%'.strtolower($this->searchByCandidate).'%');
            });
        });

        $query->when($this->location != '', function (Builder $q) {
            $q->whereHas('user', function (Builder $query) {
                $query->WhereHas('country', function (Builder $q) {
                    $q->where('name', 'like', '%'.$this->location.'%');
                });
                $query->orWhereHas('state', function (Builder $q) {
                    $q->where('name', 'like', '%'.$this->location.'%');
                });
                $query->orWhereHas('city', function (Builder $q) {
                    $q->where('name', 'like', '%'.$this->location.'%');
                });
            });
        });

        $query->when($this->gender == 'all', function (Builder $q) {
            $q->whereHas('user', function (Builder $q) {
                $q->whereIn('gender', [0, 1]);
            });
        });

        $query->when($this->gender == 'male', function (Builder $q) {
            $q->whereHas('user', function (Builder $q) {
                $q->where('gender', '=', 0);
            });
        });

        $query->when($this->gender == 'female', function (Builder $q) {
            $q->whereHas('user', function (Builder $q) {
                $q->where('gender', '=', 1);
            });
        });

        $query->when(! empty($this->min), function (Builder $q) {
            $q->where('expected_salary', '>', $this->min);
        });
        $query->when(! empty($this->max), function (Builder $q) {
            $q->where('expected_salary', '<', $this->max);
        });

        return $query->paginate(10);
    }
}
