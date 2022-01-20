<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateJobStageRequest;
use App\Http\Requests\UpdateJobStageRequest;
use App\Models\JobApplication;
use App\Models\JobApplicationSchedule;
use App\Models\JobStage;
use App\Repositories\JobStageRepository;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;

class JobStageController extends AppBaseController
{
    /** @var JobStageRepository */
    private $jobStageRepository;

    public function __construct(JobStageRepository $jobStageRepository)
    {
        $this->jobStageRepository = $jobStageRepository;
    }

    /**
     * Display a listing of the JobType.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        return view('employer.job_stages.index');
    }

    /**
     * Store a newly created JobType in storage.
     *
     * @param  CreateJobStageRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateJobStageRequest $request): JsonResponse
    {
        $input = $request->all();
        $jobStageExists = JobStage::whereName($input['name'])
            ->where('company_id', '=', getLoggedInUser()->owner_id)
            ->exists();
        if ($jobStageExists) {
            return $this->sendError('The name has already been taken');
        }
        $input['company_id'] = getLoggedInUser()->owner_id;
        $this->jobStageRepository->create($input);

        return $this->sendSuccess('Job Stage saved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  JobStage  $jobStage
     * @return JsonResponse
     */
    public function edit(JobStage $jobStage)
    {
        return $this->sendResponse($jobStage, 'Job Stage Successfully.');
    }

    /**
     * Update the specified JobStage in storage.
     *
     * @param  UpdateJobStageRequest  $request
     * @param  JobStage  $jobStage
     * @return JsonResponse
     */
    public function update(UpdateJobStageRequest $request, JobStage $jobStage)
    {
        $input = $request->all();
        $jobStageExists = JobStage::whereName($input['name'])
            ->whereCompanyId(getLoggedInUser()->owner_id)
            ->where('id', '!=', $input['jobStageId'])->exists();
        if ($jobStageExists) {
            return $this->sendError('The name has already been taken');
        }
        $this->jobStageRepository->update($input, $jobStage->id);

        return $this->sendSuccess('Job Stage updated successfully.');
    }

    /**
     * Show the form for editing the specified JobStage.
     *
     * @param  JobStage  $jobStage
     * @return JsonResponse
     */
    public function show(JobStage $jobStage)
    {
        return $this->sendResponse($jobStage, 'Job Stage Retrieved Successfully.');
    }

    /**
     * Remove the specified JobStage from storage.
     *
     * @param  JobStage  $jobStage
     * @return JsonResponse
     */
    public function destroy(JobStage $jobStage)
    {
        $jobModels = [
            JobApplication::class,
        ];
        $result = canDelete($jobModels, 'job_stage_id', $jobStage->id);
        $jobScheduleModels = [
            JobApplicationSchedule::class,
        ];
        $jobScheduleResult = canDelete($jobScheduleModels, 'stage_id', $jobStage->id);
        if ($result) {
            return $this->sendError('Job Stage can\'t be deleted.');
        }
        if ($jobScheduleResult) {
            return $this->sendError('Job Stage can\'t be deleted.');
        }

        $jobStage->delete();

        return $this->sendSuccess('Job Stage deleted successfully.');
    }
}
