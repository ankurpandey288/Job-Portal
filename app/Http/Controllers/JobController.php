<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Country;
use App\Models\FeaturedRecord;
use App\Models\FrontSetting;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\Notification;
use App\Models\NotificationSetting;
use App\Models\ReportedJob;
use App\Models\State;
use App\Models\Transaction;
use App\Queries\JobDataTable;
use App\Queries\ReportedJobDataTable;
use App\Repositories\JobRepository;
use DataTables;
use Exception;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Throwable;

class JobController extends AppBaseController
{
    /** @var JobRepository */
    private $jobRepository;

    public function __construct(JobRepository $jobRepo)
    {
        $this->jobRepository = $jobRepo;
    }

    /**
     * Display a listing of the Job.
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
            return Datatables::of((new JobDataTable())->get($request->only(['is_featured', 'status'])))->make(true);
        }
        $statusArray = Job::STATUS;
        if (! $this->checkJobLimit()) {
            Flash::error('Job create limit exceeded of your account, Update your subscription plan.');
        }
        $isFeaturedEnable = FrontSetting::where('key', 'featured_jobs_enable')->first();
        $isFeaturedEnable = ($isFeaturedEnable) ? $isFeaturedEnable->value : 0;

        $maxFeaturedJob = FrontSetting::where('key', 'featured_jobs_quota')->first()->value;
        $totalFeaturedJob = Job::Has('activeFeatured')->count();
        $isFeaturedAvilabal = ($totalFeaturedJob >= $maxFeaturedJob) ? false : true;
        $featured = Job::IS_FEATURED;

        return view('employer.jobs.index',
            compact('statusArray', 'isFeaturedEnable', 'isFeaturedAvilabal', 'featured'));
    }

    /**
     * Show the form for creating a new Job.
     *
     * @return Factory|View
     */
    public function create()
    {
        $data = $this->jobRepository->prepareData();

        return view('employer.jobs.create')->with('data', $data);
    }

    /**
     * Store a newly created Job in storage.
     *
     * @param  CreateJobRequest  $request
     *
     * @throws Throwable
     * @return RedirectResponse|Redirector
     */
    public function store(CreateJobRequest $request)
    {
        $input = $request->all();
        $input['hide_salary'] = (isset($input['hide_salary'])) ? 1 : 0;
        $input['is_freelance'] = (isset($input['is_freelance'])) ? 1 : 0;
        $input['status'] = (isset($request->saveDraft)) ? Job::STATUS_DRAFT : Job::STATUS_OPEN;
        if ($input['status'] == Job::STATUS_OPEN) {
            if (! $this->checkJobLimit()) {
                return redirect()->back()->withInput()->withErrors(['error' => 'Job create limit exceeded of your account, Update your subscription plan.']);
            }
        }
        $job = $this->jobRepository->store($input);

        isset($request->saveDraft) ? Flash::success('Job Draft saved successfully.') : Flash::success('Job saved successfully.');

        return redirect(route('job.index'));
    }

    /**
     * Display the specified Job.
     *
     * @param  Job  $job
     *
     * @return Factory|View
     */
    public function show(Job $job)
    {
        return view('employer.jobs.show')->with('job', $job);
    }

    /**
     * Show the form for editing the specified Job.
     *
     * @param  Job  $job
     * @return Factory|View
     */
    public function edit(Job $job)
    {
        if ($job->company->user->id !== getLoggedInUserId()) {
            Flash::error('Job Not Found.');

            return redirect(route('job.index'));
        }
        if ($job->status == Job::STATUS_CLOSED) {
            return redirect(route('job.index'))->withErrors('Closed job can not be edited.');
        }
        $data = $this->jobRepository->prepareData();
        $data['jobTags'] = $job->jobsTag()->pluck('tag_id')->toArray();
        $states = $cities = null;
        if (isset($job->country_id)) {
            $states = getStates($job->country_id);
        }
        if (isset($job->state_id)) {
            $cities = getCities($job->state_id);
        }

        return view('employer.jobs.edit', compact('data', 'job', 'cities', 'states'));
    }

    /**
     * Update the specified Job in storage.
     *
     * @param  Job  $job
     * @param  UpdateJobRequest  $request
     *
     * @throws Throwable
     * @return RedirectResponse|Redirector
     */
    public function update(Job $job, UpdateJobRequest $request)
    {
        if ($job->status != Job::STATUS_OPEN) {
            if (! $this->checkJobLimit()) {
                return redirect()->back()->withInput()->withErrors(['error' => 'Job create limit exceeded of your account, Update your subscription plan.']);
            }
        }

        $input = $request->all();
        $input['hide_salary'] = (isset($input['hide_salary'])) ? 1 : 0;
        $input['is_freelance'] = (isset($input['is_freelance'])) ? 1 : 0;

        $job = $this->jobRepository->update($input, $job);

        Flash::success('Job updated successfully.');

        return redirect(route('job.index'));
    }

    /**
     * Remove the specified Job from storage.
     *
     * @param  Job  $job
     *
     * @throws Exception
     * @return RedirectResponse|Redirector
     */
    public function destroy(Job $job)
    {
        $jobAppliedCount = $job->appliedJobs()->whereIn('status',
            [JobApplication::STATUS_APPLIED, JobApplication::STATUS_DRAFT])->count();
        if ($jobAppliedCount > 0) {
            return $this->sendError('Job applied by candidate cannot be deleted.');
        }

        $this->jobRepository->delete($job->id);

        return $this->sendSuccess('Job deleted successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @return mixed
     */
    public function getStates(Request $request)
    {
        $postal = $request->get('postal');

        $states = getStates($postal);

        return $this->sendResponse($states, 'Retrieved successfully');
    }

    /**
     * @param  Request  $request
     *
     * @return mixed
     */
    public function getCities(Request $request)
    {
        $state = $request->get('state');
        $cities = getCities($state);

        return $this->sendResponse($cities, 'Retrieved successfully');
    }

    /**
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Application|Factory|View
     */
    public function getJobs(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new JobDataTable())->getJobs($request->only([
                'is_featured', 'is_suspended', 'is_freelancer', 'expiry_date', 'is_job_active',
            ])))->make(true);
        }

        $featured = Job::IS_FEATURED;
        $suspended = Job::IS_SUSPENDED;
        $freelancer = Job::IS_FREELANCER;
        $jobsActiveExpire = Job::JOBS_ACTIVE;

        return view('jobs.index', compact('featured', 'suspended', 'freelancer', 'jobsActiveExpire'));
    }

    /**
     * @return Factory|View
     */
    public function createJob()
    {
        $data = $this->jobRepository->prepareData();
        $countries = Country::pluck('name', 'id');
        $states = State::toBase()->pluck('name', 'id');

        return view('jobs.create', compact('countries', 'states'))->with('data', $data);
    }

    /**
     * @param  CreateJobRequest  $request
     *
     * @throws Throwable
     *
     * @return RedirectResponse|Redirector
     */
    public function storeJob(CreateJobRequest $request)
    {
        $input = $request->all();
        $input['hide_salary'] = (isset($input['hide_salary'])) ? 1 : 0;
        $input['is_freelance'] = (isset($input['is_freelance'])) ? 1 : 0;
        $input['status'] = Job::STATUS_OPEN;
        $this->jobRepository->store($input);

        Flash::success('Job saved successfully.');

        return redirect(route('admin.jobs.index'));
    }

    /**
     * Show the form for editing the specified Job.
     *
     * @param  Job  $job
     * @return Factory|View
     */
    public function editJob(Job $job)
    {
        if ($job->status == Job::STATUS_CLOSED) {
            Flash::error('Closed job can not be edited.');
            return redirect(route('admin.jobs.index'));
        }
        $data = $this->jobRepository->prepareData();
        $data['jobTags'] = $job->jobsTag()->pluck('tag_id')->toArray();
        $states = $cities = null;
        if (isset($job->country_id)) {
            $states = getStates($job->country_id);
        }
        if (isset($job->state_id)) {
            $cities = getCities($job->state_id);
        }
        $countries = Country::pluck('name', 'id');

        return view('jobs.edit', compact('data', 'job', 'cities', 'states', 'countries'));
    }

    /**
     * Update the specified Job in storage.
     *
     * @param  Job  $job
     * @param  UpdateJobRequest  $request
     *
     * @throws Throwable
     * @return RedirectResponse|Redirector
     */
    public function updateJob(Job $job, UpdateJobRequest $request)
    {
        $input = $request->all();
        $input['hide_salary'] = (isset($input['hide_salary'])) ? 1 : 0;
        $input['is_freelance'] = (isset($input['is_freelance'])) ? 1 : 0;

        $this->jobRepository->update($input, $job);

        Flash::success('Job updated successfully.');

        return redirect(route('admin.jobs.index'));
    }

    /**
     * Display the specified Job.
     *
     * @param  Job  $job
     *
     * @return Factory|View
     */
    public function showJobs(Job $job)
    {
        $job = Job::with('company.user')->whereId($job->id)->first();

        return view('jobs.show')->with('job', $job);
    }

    /**
     * Remove the specified Job from storage.
     *
     * @param  Job  $job
     *
     * @throws Exception
     * @return RedirectResponse|Redirector
     */
    public function delete(Job $job)
    {
        $jobAppliedCount = $job->appliedJobs()->where('status', JobApplication::STATUS_APPLIED)->count();
        if ($jobAppliedCount > 0) {
            return $this->sendError('Job applied by candidate cannot be deleted.');
        }

        $this->jobRepository->delete($job->id);

        return $this->sendSuccess('Job deleted successfully.');
    }

    /**
     * @param  Job  $job
     *
     * @return mixed
     */
    public function changeIsSuspended(Job $job)
    {
        $isSuspended = $job->is_suspended;
        $job->update(['is_suspended' => ! $isSuspended]);

        return $this->sendSuccess('Status changed successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @return Application|Factory|View
     */
    public function showReportedJobs(Request $request)
    {
        $reportedJob = ReportedJob::all();

        return view('employer.jobs.reported_jobs', compact('reportedJob'));
    }

    /**
     * @param $id
     * @param $status
     *
     * @throws Exception
     * @return mixed
     */
    public function changeJobStatus($id, $status)
    {
        /** @var Job $job */
        $job = Job::findOrFail($id);
        if ($job->status != Job::STATUS_OPEN && $status == Job::STATUS_OPEN) {
            if (! $this->checkJobLimit()) {
                return $this->sendError('Job create limit exceeded of your account, Update your subscription plan.');
            }
        }

        $job->update(['status' => $status]);

        return $this->sendSuccess('Status changed successfully.');
    }

    /**
     * @param  ReportedJob  $reportedJob
     *
     * @throws Exception
     *
     * @return mixed
     */
    public function deleteReportedJobs(ReportedJob $reportedJob)
    {
        $reportedJob->delete();

        return $this->sendSuccess('Reported Jobs deleted successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @return mixed
     */
    public function showReportedJobNote(ReportedJob $reportedJob)
    {
        $data = $this->jobRepository->getReportedJobs($reportedJob->id);
        $data['date'] = \Carbon\Carbon::parse($data->created_at)->formatLocalized('%d %b, %Y');

        return $this->sendResponse($data, 'Retrieved successfully.');
    }

    /**
     * @throws Exception
     *
     * @return RedirectResponse|bool
     */
    public function checkJobLimit()
    {
        $job = $this->jobRepository->canCreateMoreJobs();

        if (! $job) {
            return false;
        }

        return true;
    }

    /**
     * @param $jobId
     *
     * @return mixed
     */
    public function makeFeatured($jobId)
    {
        $user = getLoggedInUser();
        $addDays = FrontSetting::where('key', 'featured_jobs_days')->first()->value;
        $price = FrontSetting::where('key', 'featured_jobs_price')->first()->value;
        $maxFeaturedJob = FrontSetting::where('key', 'featured_jobs_quota')->first()->value;
        $totalFeaturedJob = Job::Has('activeFeatured')->count();
        $isFeaturedAvailable = ($totalFeaturedJob >= $maxFeaturedJob) ? false : true;
        $employerUser = Job::with('company.user')->findOrFail($jobId);

        if ($isFeaturedAvailable) {
            $featuredRecord = [
                'owner_id'   => $jobId,
                'owner_type' => Job::class,
                'user_id'    => $user->id,
                'start_time' => Carbon::now(),
                'end_time'   => Carbon::now()->addDays($addDays),
            ];
            FeaturedRecord::create($featuredRecord);
            NotificationSetting::whereKey(Notification::MARK_JOB_FEATURED_ADMIN)->where('type',
                'admin')->first()->value == 1 ?
                addNotification([
                    Notification::MARK_JOB_FEATURED_ADMIN,
                    $employerUser->company->user->id,
                    Notification::EMPLOYER,
                    $user->first_name.' '.$user->last_name.' mark '.$employerUser->job_title.' as Featured.',
                ]) : false;
            $transaction = [
                'owner_id'   => $jobId,
                'owner_type' => Job::class,
                'user_id'    => $user->id,
                'amount'     => $price,
            ];
            Transaction::create($transaction);

            return $this->sendSuccess('Job Make Featured successfully.');
        }

        return $this->sendError('Featured Quota is Not available.');
    }

    /**
     * @param $jobId
     *
     * @return mixed
     */
    public function makeUnFeatured($jobId)
    {
        /** @var FeaturedRecord $unFeatured */
        $unFeatured = FeaturedRecord::where('owner_id', $jobId)->where('owner_type', Job::class)->first();
        $unFeatured->delete();

        return $this->sendSuccess('Job Make UnFeatured successfully.');
    }
}
