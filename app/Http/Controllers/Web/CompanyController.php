<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\AppBaseController;
use App\Models\Company;
use App\Repositories\CompanyRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;

class CompanyController extends AppBaseController
{
    /** @var CompanyRepository */
    private $companyRepository;

    public function __construct(CompanyRepository $companyRepo)
    {
        $this->companyRepository = $companyRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // redirect to jobs listing page
    }

    /**
     * @param $uniqueId
     *
     * @return Application|Factory|View
     */
    public function getCompaniesDetails($uniqueId)
    {
        $company = Company::whereUniqueId($uniqueId)->first();

        $data = $this->companyRepository->getCompanyDetail($company->id);

        return view('web.company.company_details')->with($data);
    }

    /**
     * @param  Request  $request
     *
     * @return Application|Factory|View
     */
    public function getCompaniesLists(Request $request)
    {
        return view('web.company.index');
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function saveFavouriteCompany(Request $request)
    {
        $input = $request->all();
        $favouriteJob = $this->companyRepository->storeFavouriteJobs($input);
        if ($favouriteJob) {
            return $this->sendResponse($favouriteJob, 'Follow Company successfully.');
        }

        return $this->sendResponse($favouriteJob, 'Unfollow Company successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResource
     */
    public function reportToCompany(Request $request)
    {
        $input = $request->all();
        $this->companyRepository->storeReportToCompany($input);

        return $this->sendSuccess('Report to company successfully.');
    }
}
