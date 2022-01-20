<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class BlogPost extends Component
{
    use WithPagination;

    public $post;
    public $searchByPost = '';
    public $categoryFilter = '';
    protected $listeners = ['deletePost', 'filterPost'];

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

    public function updatingSearchByPost()
    {
        $this->resetPage();
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        $posts = $this->searchPost();
        $category = $this->getBlogCategory();

        return view('livewire.blog-post', compact('posts', 'category'));
    }

    /**
     * @param $postId
     */
    public function deletePost($postId)
    {
        $post = Post::findOrFail($postId);
        $post->delete();
        $this->dispatchBrowserEvent('delete');
    }

    /**
     * @param $categoryId
     */
    public function filterPost($categoryId)
    {
        $this->categoryFilter = $categoryId;
        $this->resetPage();
    }

    /**
     * @return LengthAwarePaginator
     */
    public function searchPost()
    {
        $query = Post::with('postAssignCategories', 'media');

        if (! empty($this->searchByPost)) {
            $query->where('title', 'like', '%'.strtolower($this->searchByPost).'%');
        }
        if (! empty($this->categoryFilter)) {
            $query->whereHas('postAssignCategories', function (Builder $q) {
                $q->where('post_categories_id', '=', $this->categoryFilter);
            });
        }
        $all = $query->paginate(8);
        $currentPage = $all->currentPage();
        $lastPage = $all->lastPage();
        if ($currentPage > $lastPage) {
            $this->page = $lastPage;
        }

        return $query->paginate(8);
    }

    /**
     * @return mixed
     */
    public function getBlogCategory()
    {
        $query = PostCategory::orderBy('name')->toBase();

        return $query->pluck('name', 'id');
    }
}
