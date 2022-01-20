<?php

namespace App\Http\Livewire;

use App\Models\NewsLetter;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Class Subscriber
 */
class Subscriber extends Component
{
    use WithPagination;

    /**
     * @var string
     */
    public $searchBySubscriber = '';
    /**
     * @var string[]
     */
    protected $listeners = ['deleteSubscriber'];
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
     * @param  int  $subscriberId
     */
    public function deleteSubscriber($subscriberId)
    {
        $subscriber = NewsLetter::findOrFail($subscriberId);
        $subscriber->delete();
        $this->dispatchBrowserEvent('delete');
    }

    public function updatingSearchBySubscriber()
    {
        $this->resetPage();
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        $subscribers = $this->subscriber();

        return view('livewire.subscriber', compact('subscribers'));
    }

    /**
     * @return LengthAwarePaginator
     */
    public function subscriber()
    {
        $query = NewsLetter::query()->select('news_letters.*');

        $query->when(isset($this->searchBySubscriber) && $this->searchBySubscriber != '', function (Builder $q) {
            $q->where('email', 'like',
                '%'.strtolower($this->searchBySubscriber).'%');
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
