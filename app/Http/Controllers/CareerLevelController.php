<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCareerLevelRequest;
use App\Http\Requests\UpdateCareerLevelRequest;
use App\Models\Candidate;
use App\Models\CareerLevel;
use App\Models\Job;
use App\Queries\CareerLevelDataTable;
use App\Repositories\CareerLevelRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;

class CareerLevelController extends AppBaseController
{
    /** @var CareerLevelRepository */
    private $careerLevelRepository;

    public function __construct(CareerLevelRepository $careerLevelRepo)
    {
        $this->careerLevelRepository = $careerLevelRepo;
    }

    /**
     * Display a listing of the CareerLevel.
     *
     * @param  Request  $request
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new CareerLevelDataTable())->get())->make(true);
        }

        return view('career_levels.index');
    }

    /**
     * Store a newly created CareerLevel in storage.
     *
     * @param  CreateCareerLevelRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateCareerLevelRequest $request): JsonResponse
    {
        $input = $request->all();
        $careerLevel = $this->careerLevelRepository->create($input);

        return $this->sendResponse($careerLevel,'Career Level saved successfully.');
    }

    /**
     * Show the form for editing the specified CareerLevel.
     *
     * @param  CareerLevel  $careerLevel
     *
     * @return JsonResource
     */
    public function edit(CareerLevel $careerLevel)
    {
        return $this->sendResponse($careerLevel, 'Career Level successfully retrieved.');
    }

    /**
     * Update the specified CareerLevel in storage.
     *
     * @param  UpdateCareerLevelRequest  $request
     *
     * @param  CareerLevel  $careerLevel
     *
     * @return JsonResource
     */
    public function update(UpdateCareerLevelRequest $request, CareerLevel $careerLevel)
    {
        $input = $request->all();
        $this->careerLevelRepository->update($input, $careerLevel->id);

        return $this->sendSuccess('Career Level updated successfully.');
    }

    /**
     * Remove the specified CareerLevel from storage.
     *
     * @param  CareerLevel  $careerLevel
     *
     * @throws Exception
     *
     * @return JsonResource
     */
    public function destroy(CareerLevel $careerLevel)
    {
        $Models = [
            Candidate::class,
            Job::class,
        ];
        $result = canDelete($Models, 'career_level_id', $careerLevel->id);
        if ($result) {
            return $this->sendError('Career Level can\'t be deleted.');
        }
        $careerLevel->delete();

        return $this->sendSuccess('Career Level deleted successfully.');
    }
}
