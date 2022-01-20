<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateJobShiftRequest;
use App\Http\Requests\UpdateJobShiftRequest;
use App\Models\Job;
use App\Models\JobShift;
use App\Queries\JobShiftDataTable;
use App\Repositories\JobShiftRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;

class JobShiftController extends AppBaseController
{
    /** @var JobShiftRepository */
    private $jobShiftRepository;

    public function __construct(JobShiftRepository $jobShiftRepo)
    {
        $this->jobShiftRepository = $jobShiftRepo;
    }

    /**
     * Display a listing of the JobShift.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        return view('job_shifts.index');
    }

    /**
     * Store a newly created JobShift in storage.
     *
     * @param  CreateJobShiftRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateJobShiftRequest $request): JsonResponse
    {
        $input = $request->all();
        $jobShift = $this->jobShiftRepository->create($input);

        return $this->sendResponse($jobShift,'Job Shift saved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  JobShift  $jobShift
     *
     * @return JsonResponse
     */
    public function edit(JobShift $jobShift)
    {
        return $this->sendResponse($jobShift, 'Job Shift Retrieved Successfully.');
    }

    /**
     * Show the form for editing the specified JobShift.
     *
     * @param  JobShift  $jobShift
     *
     * @return JsonResource
     */
    public function show(JobShift $jobShift)
    {
        return $this->sendResponse($jobShift, 'Job Shift Retrieved Successfully.');
    }

    /**
     * Update the specified JobShift in storage.
     *
     * @param  UpdateJobShiftRequest  $request
     * @param  JobShift  $jobShift
     *
     * @return JsonResource
     */
    public function update(UpdateJobShiftRequest $request, JobShift $jobShift)
    {
        $input = $request->all();
        $this->jobShiftRepository->update($input, $jobShift->id);

        return $this->sendSuccess('Job Shift updated successfully.');
    }

    /**
     * Remove the specified JobShift from storage.
     *
     * @param  JobShift  $jobShift
     *
     * @throws Exception
     *
     * @return JsonResource
     */
    public function destroy(JobShift $jobShift)
    {
        $jobModels = [
            Job::class,
        ];
        $result = canDelete($jobModels, 'job_shift_id', $jobShift->id);
        if ($result) {
            return $this->sendError('Job Shift can\'t be deleted.');
        }
        $jobShift->delete();

        return $this->sendSuccess('Job Shift deleted successfully.');
    }
}
