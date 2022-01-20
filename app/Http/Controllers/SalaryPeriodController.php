<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSalaryPeriodRequest;
use App\Http\Requests\UpdateSalaryPeriodRequest;
use App\Models\Job;
use App\Models\SalaryPeriod;
use App\Queries\SalaryPeriodDataTable;
use App\Repositories\SalaryPeriodRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;

class SalaryPeriodController extends AppBaseController
{
    /** @var SalaryPeriodRepository */
    private $salaryPeriodRepository;

    public function __construct(SalaryPeriodRepository $salaryPeriodRepo)
    {
        $this->salaryPeriodRepository = $salaryPeriodRepo;
    }

    /**
     * Display a listing of the SalaryPeriod.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        return view('salary_periods.index');
    }

    /**
     * Store a newly created SalaryPeriod in storage.
     *
     * @param  CreateSalaryPeriodRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateSalaryPeriodRequest $request)
    {
        $input = $request->all();
        $salaryPeriod = $this->salaryPeriodRepository->create($input);

        return $this->sendResponse($salaryPeriod, 'Salary Period saved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  SalaryPeriod  $salaryPeriod
     *
     * @return JsonResponse
     */
    public function edit(SalaryPeriod $salaryPeriod)
    {
        return $this->sendResponse($salaryPeriod, 'Salary Period Retrieved Successfully.');
    }

    /**
     * Show the form for editing the specified SalaryPeriod.
     *
     * @param  SalaryPeriod  $salaryPeriod
     *
     * @return JsonResource
     */
    public function show(SalaryPeriod $salaryPeriod)
    {
        return $this->sendResponse($salaryPeriod, 'Salary Period Retrieved Successfully.');
    }

    /**
     * Update the specified SalaryPeriod in storage.
     *
     * @param  UpdateSalaryPeriodRequest  $request
     * @param  SalaryPeriod  $salaryPeriod
     *
     * @return JsonResource
     */
    public function update(UpdateSalaryPeriodRequest $request, SalaryPeriod $salaryPeriod)
    {
        $input = $request->all();
        $this->salaryPeriodRepository->update($input, $salaryPeriod->id);

        return $this->sendSuccess('Salary Period updated successfully.');
    }

    /**
     * Remove the specified SalaryPeriod from storage.
     *
     * @param  SalaryPeriod  $salaryPeriod
     *
     * @throws Exception
     *
     * @return JsonResource
     */
    public function destroy(SalaryPeriod $salaryPeriod)
    {
        $jobModels = [
            Job::class,
        ];
        $result = canDelete($jobModels, 'salary_period_id', $salaryPeriod->id);
        if ($result) {
            return $this->sendError('Salary Period can\'t be deleted.');
        }
        $salaryPeriod->delete();

        return $this->sendSuccess('Salary Period deleted successfully.');
    }
}
