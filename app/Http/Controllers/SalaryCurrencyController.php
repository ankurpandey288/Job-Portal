<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Job;
use App\Models\SalaryCurrency;
use App\Queries\SalaryCurrencyDataTable;
use App\Repositories\SalaryCurrencyRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;

class SalaryCurrencyController extends AppBaseController
{
    /** @var SalaryCurrencyRepository */
    private $salaryCurrencyRepository;

    public function __construct(SalaryCurrencyRepository $salaryCurrencyRepo)
    {
        $this->salaryCurrencyRepository = $salaryCurrencyRepo;
    }

    /**
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new SalaryCurrencyDataTable())->get())->make(true);
        }

        return view('salary_currencies.index');
    }
}
