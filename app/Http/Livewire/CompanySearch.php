<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class CompanySearch extends Component
{
    use WithPagination;

    public $searchByCompany = '';
    protected $isFeatured = '';

    public function mount($isFeatured)
    {
        $this->isFeatured = $isFeatured;
    }

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

    public function updatingSearchByCompany()
    {
        $this->resetPage();
    }

    public function render()
    {
        /** @var User $user */
        $companies = Company::with(['user.media', 'jobs', 'activeFeatured'])
            ->whereHas('user', function (Builder $query) {
                $query->where('first_name', 'like', '%'.strtolower($this->searchByCompany).'%')->where('is_active', '=',
                    1);
            })
            ->when(! empty($this->isFeatured), function (Builder $query) {
                $query->has('activeFeatured');
            })
            ->withCount(['jobs' => function (Builder $q) {
                $q->where('status', '!=', Job::STATUS_DRAFT);
                $q->where('status', '!=', Job::STATUS_CLOSED);
            }])->paginate(20);

        return view('livewire.company-search', compact('companies'));
    }
}
