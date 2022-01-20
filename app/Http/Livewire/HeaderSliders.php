<?php

namespace App\Http\Livewire;

use App\Models\HeaderSlider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Class HeaderSliders
 */
class HeaderSliders extends Component
{
    use WithPagination;

    /**
     * @var string
     */
    public $status = '';

    /**
     * @var string[]
     */
    protected $listeners = ['refresh' => '$refresh', 'deleteHeaderSlider', 'changeFilter'];

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
     * @param $headerSliderId
     */
    public function deleteHeaderSlider($headerSliderId)
    {
        $headerSlider = HeaderSlider::findOrFail($headerSliderId);
        $headerSlider->delete();
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

    public function updatingSearchByEmployee()
    {
        $this->resetPage();
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        $headerSliders = $this->headerSlider();

        return view('livewire.header-sliders', compact('headerSliders'));
    }

    /**
     * @return LengthAwarePaginator
     */
    public function headerSlider(): LengthAwarePaginator
    {
        $query = HeaderSlider::with('media')->select('header_sliders.*');

        $query->when(($this->status != '') && $this->status == 1,
            function (Builder $q) {
                $q->where('is_active', '=', 1);
            });

        $query->when(($this->status != '') && $this->status == 0,
            function (Builder $q) {
                $q->where('is_active', '=', 0);
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
