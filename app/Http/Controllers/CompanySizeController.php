<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanySizeRequest;
use App\Http\Requests\UpdateCompanySizeRequest;
use App\Models\Company;
use App\Models\CompanySize;
use App\Queries\CompanySizeDataTable;
use App\Repositories\CompanySizeRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;

class CompanySizeController extends AppBaseController
{
    /** @var CompanySizeRepository */
    private $companySizeRepository;

    public function __construct(CompanySizeRepository $companySizeRepo)
    {
        $this->companySizeRepository = $companySizeRepo;
    }

    /**
     * Display a listing of the CompanySize.
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
            return Datatables::of((new CompanySizeDataTable())->get())->make(true);
        }

        return view('company_sizes.index');
    }

    /**
     * Store a newly created CompanySize in storage.
     *
     * @param  CreateCompanySizeRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateCompanySizeRequest $request): JsonResponse
    {
        $input = $request->all();
        $companySize = $this->companySizeRepository->create($input);

        return $this->sendResponse($companySize, 'Company Size saved successfully.');
    }

    /**
     * Show the form for editing the specified CompanySize.
     *
     * @param  CompanySize  $companySize
     *
     * @return JsonResource
     */
    public function edit(CompanySize $companySize)
    {
        return $this->sendResponse($companySize, 'Company Size Retrieved Successfully.');
    }

    /**
     * Update the specified CompanySize in storage.
     *
     * @param  UpdateCompanySizeRequest  $request
     * @param  CompanySize  $companySize
     *
     * @return JsonResource
     */
    public function update(UpdateCompanySizeRequest $request, CompanySize $companySize)
    {
        $input = $request->all();
        $this->companySizeRepository->update($input, $companySize->id);

        return $this->sendSuccess('Company Size updated successfully.');
    }

    /**
     * Remove the specified CompanySize from storage.
     *
     * @param  CompanySize  $companySize
     *
     * @throws Exception
     *
     * @return JsonResource
     */
    public function destroy(CompanySize $companySize)
    {
        $companyModels = [
            Company::class,
        ];
        $result = canDelete($companyModels, 'company_size_id', $companySize->id);
        if ($result) {
            return $this->sendError('Company Size can\'t be deleted.');
        }
        $companySize->delete();

        return $this->sendSuccess('Company Size deleted successfully.');
    }
}
