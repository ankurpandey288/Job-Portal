<?php

namespace App\Http\Livewire;

use App\Models\Skill;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Class Skills
 */
class Skills extends Component
{
    use WithPagination;

    /**
     * @var string
     */
    public $searchBySkills = '';
    /**
     * @var string[]
     */
    protected $listeners = ['refresh' => '$refresh', 'deleteSkill'];
    /**
     * @var string
     */
    protected $paginationTheme = 'bootstrap';
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
     * @param $skillId
     */
    public function deleteSkill($skillId)
    {
        $skill = Skill::findOrFail($skillId);
        $skill->delete();
        $this->dispatchBrowserEvent('delete');
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        $skills = $this->skill();

        return view('livewire.skills', compact('skills'));
    }

    /**
     * @return LengthAwarePaginator
     */
    public function skill()
    {
        $query = Skill::query()->select('skills.*');
        $query->when(isset($this->searchBySkills) && $this->searchBySkills != '', function (Builder $q) {
            $q->where('name', 'like',
                '%'.strtolower($this->searchBySkills).'%');
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
