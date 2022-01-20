<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\EmailJobToFriendRequest;
use App\Models\Job;
use App\Repositories\JobRepository;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;
use Laracasts\Flash\Flash;
use Share;

class JobController extends AppBaseController
{
    /** @var JobRepository */
    private $jobRepository;

    public function __construct(JobRepository $jobRepo)
    {
        $this->jobRepository = $jobRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $data = $this->jobRepository->prepareJobData();
        $data['input'] = $request->all();

        return view('web.jobs.index')->with($data);
    }

    /**
     * @param  string  $uniqueJobId
     *
     * @return Application|Factory|View
     */
    public function jobDetails($uniqueJobId)
    {
        $job = Job::whereJobId($uniqueJobId)->first();

        if (empty($job)) {
            Flash::error('Job not found');

            return redirect()->back();
        }

        if ($job->status == Job::STATUS_DRAFT && Auth::user()->hasRole('Candidate')) {
            abort(404);
        }

        $data['resumes'] = null;

        $data['isActive'] = $data['isApplied'] = $data['isJobAddedToFavourite'] = $data['isJobReportedAsAbuse'] = false;
        if (Auth::check() && Auth::user()->hasRole('Candidate')) {
            $data = $this->jobRepository->getJobDetails($job);
        }
        $data['jobsCount'] = Job::whereStatus(Job::STATUS_OPEN)->whereCompanyId($job->company_id)->count();

        // check job status is active or not
        $data['isActive'] = ($job->status == Job::STATUS_OPEN) ? true : false;

        $relatedJobs = Job::with('jobCategory', 'jobShift', 'company')->whereJobCategoryId($job->job_category_id);
        $data['getRelatedJobs'] = $relatedJobs->whereNotIn('id', [$job->id])->orderByDesc('created_at')->take(5)->get();
        $url = [
            "gmail"    => "https://plus.google.com/share?url=".url()->current(),
            "twitter"  => "https://twitter.com/intent/tweet?url=".url()->current(),
            "facebook" => "https://www.facebook.com/sharer/sharer.php?u=".url()->current(),
            "pinterest" => "http://pinterest.com/pin/create/button/?url=".url()->current(),
        ];

        return view('web.jobs.job_details', compact('job', 'url'))->with($data);
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResource
     */
    public function saveFavouriteJob(Request $request)
    {
        $input = $request->all();
        $favouriteJob = $this->jobRepository->storeFavouriteJobs($input);
        if ($favouriteJob) {
            return $this->sendResponse($favouriteJob, 'Favourite Job added successfully.');
        }

        return $this->sendResponse($favouriteJob, 'Favourite Job removed successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResource
     */
    public function reportJobAbuse(Request $request)
    {
        $input = $request->all();
        $this->jobRepository->storeReportJobAbuse($input);

        return $this->sendSuccess('Job Abuse reported successfully.');
    }

    /**
     * @param  EmailJobToFriendRequest  $request
     *
     * @return JsonResource
     */
    public function emailJobToFriend(EmailJobToFriendRequest $request)
    {
        $input = $request->all();
        $this->jobRepository->emailJobToFriend($input);

        return $this->sendSuccess('Job Emailed to friend successfully.');
    }
}
