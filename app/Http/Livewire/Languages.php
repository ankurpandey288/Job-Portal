<?php

namespace App\Http\Livewire;

use App\Models\Language;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Class Languages
 */
class Languages extends Component
{
    use WithPagination;

    /**
     * @var string
     */
    public $searchLanguage = '';

    /**
     * @var string[]
     */
    protected $listeners = ['refresh' => '$refresh', 'deleteLanguage'];

    /**
     * @var int
     */
    private $perPage = 8;

    /**
     * @return string
     */
    public function paginationView(): string
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
     * @param $languageId
     */
    public function deleteLanguage($languageId)
    {
        $language = Language::findOrFail($languageId);
        $language->delete();
        $this->dispatchBrowserEvent('delete');
    }

    public function updatingSearchSalaryCurrencies()
    {
        $this->resetPage();
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        $languages = $this->languages();

        return view('livewire.languages', compact('languages'));
    }

    /**
     * @return LengthAwarePaginator
     */
    public function languages(): LengthAwarePaginator
    {
        $query = language::query()->select('languages.*');

        $query->when(isset($this->searchLanguage) && $this->searchLanguage != '', function (Builder $q) {
            $q->where('language', 'like',
                '%'.strtolower($this->searchLanguage).'%');
            $q->orWhere('iso_code', 'like',
                '%'.strtolower($this->searchLanguage).'%');
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
