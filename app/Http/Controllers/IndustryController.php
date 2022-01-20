<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIndustryRequest;
use App\Http\Requests\UpdateIndustryRequest;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\Industry;
use App\Queries\IndustryDataTable;
use App\Repositories\IndustryRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;

class IndustryController extends AppBaseController
{
    /** @var IndustryRepository */
    private $industryRepository;

    public function __construct(IndustryRepository $industryRepo)
    {
        $this->industryRepository = $industryRepo;
    }

    /**
     * Display a listing of the Industry.
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
            return Datatables::of((new IndustryDataTable())->get())->make(true);
        }

        return view('industries.index');
    }

    /**
     * Store a newly created Industry in storage.
     *
     * @param  CreateIndustryRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateIndustryRequest $request): JsonResponse
    {
        $input = $request->all();
        $industry = $this->industryRepository->create($input);

        return $this->sendResponse($industry, 'Industry saved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Industry  $industry
     *
     * @return JsonResponse
     */
    public function edit(Industry $industry)
    {
        return $this->sendResponse($industry, 'Industry Retrieved Successfully.');
    }

    /**
     * Show the form for editing the specified Industry.
     *
     * @param  Industry  $industry
     *
     * @return JsonResource
     */
    public function show(Industry $industry)
    {
        return $this->sendResponse($industry, 'Industry Retrieved Successfully.');
    }

    /**
     * Update the specified Industry in storage.
     *
     * @param  UpdateIndustryRequest  $request
     * @param  Industry  $industry
     *
     * @return JsonResource
     */
    public function update(UpdateIndustryRequest $request, Industry $industry)
    {
        $input = $request->all();
        $this->industryRepository->update($input, $industry->id);

        return $this->sendSuccess('Industry updated successfully.');
    }

    /**
     * Remove the specified Industry from storage.
     *
     * @param  Industry  $industry
     *
     * @throws Exception
     *
     * @return JsonResource
     */
    public function destroy(Industry $industry)
    {
        $Models = [
            Candidate::class,
            Company::class,
        ];
        $result = canDelete($Models, 'industry_id', $industry->id);
        if ($result) {
            return $this->sendError('Industry can\'t be deleted.');
        }
        $industry->delete();

        return $this->sendSuccess('Industry deleted successfully.');
    }
}
