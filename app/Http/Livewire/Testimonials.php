<?php

namespace App\Http\Livewire;

use App\Models\Testimonial;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Class Testimonials
 */
class Testimonials extends Component
{
    use WithPagination;

    /**
     * @var string
     */
    public $searchByTestimonial = '';

    /**
     * @var string[]
     */
    protected $listeners = ['refresh' => '$refresh', 'deleteTestimonial'];

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
     * @param $testimonialId
     */
    public function deleteTestimonial($testimonialId)
    {
        $testimonial = Testimonial::findOrFail($testimonialId);
        $testimonial->delete();
        $this->dispatchBrowserEvent('delete');
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        $testimonials = $this->testimonial();

        return view('livewire.testimonials', compact('testimonials'));
    }

    /**
     * @return LengthAwarePaginator
     */
    public function testimonial(): LengthAwarePaginator
    {
        $query = Testimonial::with('media')->select('testimonials.*');

        $query->when(isset($this->searchByTestimonial) && $this->searchByTestimonial != '', function (Builder $q) {
            $q->where('customer_name', 'like',
                '%'.strtolower($this->searchByTestimonial).'%');
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
