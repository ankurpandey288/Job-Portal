<?php

namespace App\Http\Livewire;

use App\Models\Candidate;
use App\Models\CustomMedia;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Class CandidateResume
 */
class CandidateResume extends Component
{
    use WithPagination;

    /**
     * @var string
     */
    public $searchByResume = '';
    /**
     * @var string[]
     */
    protected $listeners = ['refresh' => '$refresh', 'deleteCandidateResume'];
    /**
     * @var string
     */
    protected $paginationTheme = 'bootstrap';
    /**
     * @var int
     */
    private $perPage = 8;

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
     * @param  int  $resumeId
     */
    public function deleteCandidateResume($resumeId)
    {
        $resume = Media::findOrFail($resumeId);
        $resume->delete();
        $this->dispatchBrowserEvent('delete');
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        $candidateResumes = $this->candidateResume();

        return view('livewire.candidate-resume', compact('candidateResumes'));
    }

    /**
     * @return LengthAwarePaginator
     */
    public function candidateResume()
    {
        $query = CustomMedia::query()->where('model_type', Candidate::class)->where('collection_name',
            Candidate::RESUME_PATH)->select('media.*')
            ->join('candidates', 'media.model_id', '=', 'candidates.id')
            ->join('users', 'candidates.user_id', '=', 'users.id')->with('candidate');

        $query->when(isset($this->searchByResume) && $this->searchByResume != '', function (Builder $q) {
            $q->where(function (Builder $q) {
                $q->orWhereJsonContains('custom_properties->title', strtolower($this->searchByResume));
                $q->orWhere('users.first_name', 'like', '%'.strtolower($this->searchByResume).'%');
                $q->orWhere('users.last_name', 'like', '%'.strtolower($this->searchByResume).'%');
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
