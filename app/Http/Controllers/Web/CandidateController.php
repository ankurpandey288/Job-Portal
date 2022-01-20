<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\AppBaseController;
use App\Models\Candidate;
use App\Repositories\Candidates\CandidateRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CandidateController extends AppBaseController
{
    /** @var CandidateRepository */
    private $candidateRepository;

    public function __construct(CandidateRepository $candidateRepo)
    {
        $this->candidateRepository = $candidateRepo;
    }

    /**
     * @param $uniqueId
     *
     * @return Application|Factory|View
     */
    public function getCandidateDetails($uniqueId)
    {
        $candidate = Candidate::whereUniqueId($uniqueId)->first();
        $data = $this->candidateRepository->getCandidateDetail($candidate->id);

        return view('web.candidate.candidate_details')->with($data);
    }

    /**
     * @param Request $request
     *
     * @return Application|Factory|View
     */
    public function getCandidatesLists(Request $request)
    {
        return view('web.candidate.index');
    }
}
