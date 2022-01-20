<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use App\Queries\TagDataTable;
use App\Repositories\JobTagRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;

class TagController extends AppBaseController
{
    /** @var JobTagRepository */
    private $jobTagRepository;

    public function __construct(JobTagRepository $jobTagRepo)
    {
        $this->jobTagRepository = $jobTagRepo;
    }

    /**
     * Display a listing of the JobTag.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        return view('job_tags.index');
    }

    /**
     * Store a newly created JobTag in storage.
     *
     * @param  CreateTagRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateTagRequest $request): JsonResponse
    {
        $input = $request->all();
        $jobTag = $this->jobTagRepository->create($input);

        return $this->sendResponse($jobTag,'Job Tag saved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Tag  $tag
     *
     * @return JsonResponse
     */
    public function edit(Tag $tag)
    {
        return $this->sendResponse($tag, 'Job Tag Retrieved Successfully.');
    }

    /**
     * Show the form for editing the specified JobTag.
     *
     * @param  Tag  $tag
     *
     * @return JsonResource
     */
    public function show(Tag $tag)
    {
        return $this->sendResponse($tag, 'Job Tag Retrieved Successfully.');
    }

    /**
     * Update the specified JobTag in storage.
     *
     * @param  UpdateTagRequest  $request
     * @param  Tag  $jobTag
     *
     * @return JsonResource
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $input = $request->all();
        $this->jobTagRepository->update($input, $tag->id);

        return $this->sendSuccess('Job Tag updated successfully.');
    }

    /**
     * Remove the specified JobTag from storage.
     *
     * @param  Tag  $jobTag
     *
     * @throws Exception
     *
     * @return JsonResource
     */
    public function destroy(Tag $tag)
    {
        $jobTag = $tag->jobs()->pluck('tag_id')->toArray();
        if (in_array($tag->id, $jobTag)) {
            return $this->sendError('Job Tag can\'t be deleted.');
        } else {
            $tag->delete();
        }

        return $this->sendSuccess('Job Tag deleted successfully.');
    }
}
