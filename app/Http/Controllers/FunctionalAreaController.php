<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFunctionalAreaRequest;
use App\Http\Requests\UpdateFunctionalAreaRequest;
use App\Models\Candidate;
use App\Models\FunctionalArea;
use App\Models\Job;
use App\Queries\FunctionalAreaDataTable;
use App\Repositories\FunctionalAreaRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;

class FunctionalAreaController extends AppBaseController
{
    /** @var FunctionalAreaRepository */
    private $functionalAreaRepository;

    public function __construct(FunctionalAreaRepository $functionalAreaRepo)
    {
        $this->functionalAreaRepository = $functionalAreaRepo;
    }

    /**
     * Display a listing of the FunctionalArea.
     *
     * @param  Request  $request
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new FunctionalAreaDataTable())->get())->make(true);
        }

        return view('functional_areas.index');
    }

    /**
     * Store a newly created FunctionalArea in storage.
     *
     * @param  CreateFunctionalAreaRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateFunctionalAreaRequest $request): JsonResponse
    {
        $input = $request->all();
        $functionalArea = $this->functionalAreaRepository->create($input);

        return $this->sendResponse($functionalArea,'Functional Area saved successfully.');
    }

    /**
     * Show the form for editing the specified FunctionalArea.
     *
     * @param  FunctionalArea  $functionalArea
     *
     * @return JsonResponse
     */
    public function edit(FunctionalArea $functionalArea)
    {
        return $this->sendResponse($functionalArea, 'Functional Area successfully retrived.');
    }

    /**
     * Update the specified FunctionalArea in storage.
     *
     * @param  FunctionalArea  $functionalArea
     * @param  UpdateFunctionalAreaRequest  $request
     *
     * @return JsonResponse
     */
    public function update(UpdateFunctionalAreaRequest $request, FunctionalArea $functionalArea)
    {
        $input = $request->all();
        $this->functionalAreaRepository->update($input, $functionalArea->id);

        return $this->sendSuccess('Functional Area updated successfully.');
    }

    /**
     * Remove the specified FunctionalArea from storage.
     *
     * @param  FunctionalArea  $functionalArea
     *
     * @throws Exception
     *
     * @return JsonResource
     */
    public function destroy(FunctionalArea $functionalArea)
    {
        $Models = [
            Candidate::class,
            Job::class,
        ];
        $result = canDelete($Models, 'functional_area_id', $functionalArea->id);
        if ($result) {
            return $this->sendError('Functional Area can\'t be deleted.');
        }
        $functionalArea->delete();

        return $this->sendSuccess('Functional Area deleted successfully.');
    }
}
