<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostCategoryRequest;
use App\Http\Requests\UpdatePostCategoryRequest;
use App\Models\Post;
use App\Models\PostCategory;
use App\Queries\PostCategoryDataTable;
use App\Repositories\PostCategoryRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;

class PostCategoryController extends AppBaseController
{
    /** @var PostCategoryRepository */
    private $postCategoryRepository;

    public function __construct(PostCategoryRepository $postCategoryRepository)
    {
        $this->postCategoryRepository = $postCategoryRepository;
    }

    /**
     * Display a listing of the BlogCategory.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new PostCategoryDataTable())->get())->make(true);
        }

        return view('blog_categories.index');
    }

    /**
     * Store a newly created BlogCategory in storage.
     *
     * @param  CreatePostCategoryRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreatePostCategoryRequest $request)
    {
        $input = $request->all();
        $this->postCategoryRepository->create($input);

        return $this->sendSuccess('Post category saved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  PostCategory  $postCategory
     *
     * @return JsonResponse
     */
    public function edit(PostCategory $postCategory)
    {
        return $this->sendResponse($postCategory, 'Post category Retrieved Successfully.');
    }

    /**
     * Show the form for editing the specified BlogCategory.
     *
     * @param  PostCategory  $postCategory
     *
     * @return JsonResource
     */
    public function show(PostCategory $postCategory)
    {
        return $this->sendResponse($postCategory, 'Post category Retrieved Successfully.');
    }

    /**
     * Update the specified BlogCategory in storage.
     *
     * @param  UpdatePostCategoryRequest  $request
     *
     * @param  PostCategory  $postCategory
     *
     * @return JsonResource
     */
    public function update(UpdatePostCategoryRequest $request, PostCategory $postCategory)
    {
        $input = $request->all();
        $this->postCategoryRepository->update($input, $postCategory->id);

        return $this->sendSuccess('Post category updated successfully.');
    }

    /**
     * Remove the specified BlogCategory from storage.
     *
     * @param  PostCategory  $postCategory
     *
     * @throws Exception
     *
     * @return JsonResource
     */
    public function destroy(PostCategory $postCategory)
    {
        $postCategory->delete();

        return $this->sendSuccess('Post category deleted successfully.');
    }
}
