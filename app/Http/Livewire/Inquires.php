<?php

namespace App\Http\Livewire;

use App\Models\Inquiry;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Class Inquires
 */
class Inquires extends Component
{
    use WithPagination;

    /**
     * @var string
     */
    public $searchInquiry = '';

    /**
     * @var string[]
     */
    protected $listeners = ['refresh' => '$refresh', 'deleteInquiry'];

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
     * @param $inquiryId
     */
    public function deleteInquiry($inquiryId)
    {
        $inquiry = Inquiry::findOrFail($inquiryId);
        $inquiry->delete();
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
        $inquires = $this->inquiry();

        return view('livewire.inquires', compact('inquires'));
    }

    /**
     * @return LengthAwarePaginator
     */
    public function inquiry(): LengthAwarePaginator
    {
        $query = Inquiry::query()->orderByDesc('created_at')->select('inquiries.*');

        $query->when(isset($this->searchInquiry) && $this->searchInquiry != '', function (Builder $q) {
            $q->where('name', 'like',
                '%'.strtolower($this->searchInquiry).'%');
            $q->orWhere('subject', 'like',
                '%'.strtolower($this->searchInquiry).'%');
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
