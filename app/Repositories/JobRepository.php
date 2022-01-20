<?php

namespace App\Repositories;

use App\Mail\EmailJobToFriend;
use App\Mail\EmailToCandidate;
use App\Models\Candidate;
use App\Models\CareerLevel;
use App\Models\Company;
use App\Models\EmailJob;
use App\Models\EmailTemplate;
use App\Models\FavouriteJob;
use App\Models\FrontSetting;
use App\Models\FunctionalArea;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobCategory;
use App\Models\JobShift;
use App\Models\JobType;
use App\Models\Notification;
use App\Models\NotificationSetting;
use App\Models\Plan;
use App\Models\ReportedJob;
use App\Models\RequiredDegreeLevel;
use App\Models\SalaryCurrency;
use App\Models\SalaryPeriod;
use App\Models\Skill;
use App\Models\Tag;
use App\Models\User;
use DB;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use PragmaRX\Countries\Package\Countries;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class JobRepository
 * @version July 12, 2020, 12:34 pm UTC
 */
class JobRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'job_title',
        'is_freelance',
        'hide_salary',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Job::class;
    }

    /**
     * @return array
     */
    public function prepareJobData()
    {
        $data['jobTypes'] = JobType::withCount(['jobs' => function ($q){
            $q->where('status', '=',Job::STATUS_OPEN);
        }])->toBase()->get();
        $data['jobCategories'] = JobCategory::toBase()->pluck('name', 'id');
        $data['jobSkills'] = Skill::toBase()->pluck('name', 'id');
        $data['genders'] = Job::NO_PREFERENCE;
        $data['careerLevels'] = CareerLevel::toBase()->pluck('level_name', 'id');
        $data['functionalAreas'] = FunctionalArea::toBase()->pluck('name', 'id');
        $data['advertise_image'] = FrontSetting::where('key', '=', 'advertise_image')->toBase()->first();

        return $data;
    }

    /**
     * @return mixed
     */
    public function prepareData()
    {
        $countries = new Countries();
        $data['jobType'] = JobType::pluck('name', 'id');
        $data['jobCategory'] = JobCategory::pluck('name', 'id');
        $data['careerLevels'] = CareerLevel::pluck('level_name', 'id');
        $data['jobShift'] = JobShift::pluck('shift', 'id');
        $data['currencies'] = SalaryCurrency::pluck('currency_name', 'id');
        $data['salaryPeriods'] = SalaryPeriod::pluck('period', 'id');
        $data['functionalArea'] = FunctionalArea::pluck('name', 'id');
        $data['preference'] = Job::NO_PREFERENCE;
        $data['jobSkill'] = Skill::pluck('name', 'id');
        $data['jobTag'] = Tag::pluck('name', 'id');
        $data['requiredDegreeLevel'] = RequiredDegreeLevel::pluck('name', 'id');
        $data['countries'] = getCountries();
        $data['companies'] = Company::with('user')->get()->where('user.is_active', '=', 1)
            ->pluck('user.full_name', 'id')->sort();

        return $data;
    }

    /**
     * @return mixed
     */
    public function getUniqueJobId()
    {
        $jobUniqueId = Str::random(12);
        while (true) {
            $isExist = Job::whereJobId($jobUniqueId)->exists();
            if ($isExist) {
                self::getUniqueJobId();
            }
            break;
        }

        return $jobUniqueId;
    }

    /**
     * @param  array  $input
     *
     * @throws \Throwable
     * @return bool
     */
    public function store($input)
    {
        try {
            DB::beginTransaction();

            $input['salary_from'] = (float) removeCommaFromNumbers($input['salary_from']);
            $input['salary_to'] = (float) removeCommaFromNumbers($input['salary_to']);
            $input['company_id'] = (isset($input['company_id'])) ? $input['company_id'] : Auth::user()->owner_id;
            $input['job_id'] = $this->getUniqueJobId();
            /** @var Job $job */
            if (isset($input['state_id']) && ! is_numeric($input['state_id'])) {
                $input['state_id'] = null;
            }
            if (Auth::user()->hasRole('Admin')) {
                $input['is_created_by_admin'] = 1;
            }

            $job = $this->create($input);

            if (isset($input['jobsSkill']) && ! empty($input['jobsSkill'])) {
                $job->jobsSkill()->sync($input['jobsSkill']);
            }
            if (isset($input['jobTag']) && ! empty($input['jobTag'])) {
                $job->jobsTag()->sync($input['jobTag']);
            }
            /** @var JobType $jobType */
            $jobType = JobType::with('candidateJobAlerts')->whereId($input['job_type_id'])->first();
            $userIds = $jobType->candidateJobAlerts->where('job_alert', '=', 1)->pluck('user_id');
            $notificationAlertUserIds = $jobType->candidateJobAlerts->pluck('user_id');
            $users = User::whereIn('id', $userIds)->get();
            $notificationAlertUsers = User::whereIn('id', $notificationAlertUserIds)->get();
            if ($job->status != Job::STATUS_DRAFT) {
                foreach ($notificationAlertUsers as $user) {
                    NotificationSetting::whereKey(Notification::JOB_ALERT)->first()->value == 1 ?
                        addNotification([
                            Notification::JOB_ALERT,
                            $user->id,
                            Notification::CANDIDATE,
                            'New job posted with '.$job->job_title.', if you are interested then you can apply for this job.',
                        ]) : false;
                }
                /** @var EmailTemplate $templateBody */
                $templateBody = EmailTemplate::whereTemplateName('Job Alert')->first();
                foreach ($users as $user) {
                    $job->name = $user->full_name;
                    $keyVariable = ['{{job_name}}', '{{job_url}}', '{{job_title}}', '{{from_name}}'];
                    $value = [$job->name, asset('/job-details/'.$job->job_id), $job->job_title, config('app.name')];
                    $body = str_replace($keyVariable, $value, $templateBody->body);
                    $data['body'] = $body;
                    Mail::to($user->email)->send(new EmailToCandidate($data));
                }
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     * @param  Job  $job
     *
     * @throws \Throwable
     * @return bool|Builder|Builder[]|Collection|Model
     */
    public function update($input, $job)
    {
        try {
            DB::beginTransaction();
            $input['salary_from'] = (float) removeCommaFromNumbers($input['salary_from']);
            $input['salary_to'] = (float) removeCommaFromNumbers($input['salary_to']);
            // update Job
            if (isset($input['state_id']) && ! is_numeric($input['state_id'])) {
                $input['state_id'] = null;
            }
            if ($job->status == Job::STATUS_DRAFT) {
                $job->status = Job::STATUS_OPEN;
            }
            $job->update($input);

            if (isset($input['jobsSkill']) && ! empty($input['jobsSkill'])) {
                $job->jobsSkill()->sync($input['jobsSkill']);
            }
            if (isset($input['jobTag']) && ! empty($input['jobTag'])) {
                $job->jobsTag()->sync($input['jobTag']);
            } else {
                $job->jobsTag()->sync([]);
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  int  $jobId
     *
     * @return mixed
     */
    public function isJobAddedToFavourite($jobId)
    {
        return FavouriteJob::where('user_id', Auth::user()->id)->where('job_id', $jobId)->exists();
    }

    /**
     * @param  int  $jobId
     *
     * @return mixed
     */
    public function isJobReportedAsAbuse($jobId)
    {
        return ReportedJob::where('user_id', Auth::user()->id)->where('job_id', $jobId)->exists();
    }

    /**
     * @param  Job  $job
     *
     * @return mixed
     */
    public function getJobDetails(Job $job)
    {
        /** @var User $user */
        $user = Auth::user();

        /** @var Candidate $candidate */
        $candidate = Candidate::findOrFail($user->candidate->id);

        /** @var JobApplicationRepository $jobApplicationRepo */
        $jobApplicationRepo = app(JobApplicationRepository::class);

        // check candidate is already applied for job
        $data['isApplied'] = $jobApplicationRepo->checkJobStatus($job->id, $candidate->id,
            JobApplication::STATUS_APPLIED);

        // check job is drafted
        $data['isJobDrafted'] = $data['isJobApplicationRejected'] = $data['isJobApplicationCompleted'] = false;
        if (! $data['isApplied']) {
            // check job is drafted or not
            $data['isJobDrafted'] = $jobApplicationRepo->checkJobStatus($job->id, $candidate->id,
                JobApplication::STATUS_DRAFT);

            $data['isJobApplicationRejected'] = $jobApplicationRepo->checkJobStatus($job->id, $candidate->id,
                JobApplication::REJECTED);

            $data['isJobApplicationCompleted'] = $jobApplicationRepo->checkJobStatus($job->id, $candidate->id,
                JobApplication::COMPLETE);
        }

        $data['isJobAddedToFavourite'] = $this->isJobAddedToFavourite($job->id);
        $data['isJobReportedAsAbuse'] = $this->isJobReportedAsAbuse($job->id);

        return $data;
    }

    /**
     * @param $input
     *
     * @return bool
     */
    public function storeFavouriteJobs($input)
    {
        $job = Job::findOrFail($input['jobId']);
        $jobUser = Company::with('user')->findOrFail($job->company_id);
        $favouriteJob = FavouriteJob::where('user_id', $input['userId'])->where('job_id', $input['jobId'])->exists();
        if (! $favouriteJob) {
            FavouriteJob::create([
                'user_id' => $input['userId'],
                'job_id'  => $input['jobId'],
            ]);
            $loggedInUser = getLoggedInUser();
            NotificationSetting::whereKey(Notification::FOLLOW_JOB)->first()->value == 1 ?
                addNotification([
                    Notification::FOLLOW_JOB,
                    $jobUser->user->id,
                    Notification::EMPLOYER,
                    $loggedInUser->first_name.' '.$loggedInUser->last_name.' started following '.$job->job_title.'.',
                ]) : false;

            return true;
        } else {
            FavouriteJob::where('user_id', $input['userId'])->where('job_id', $input['jobId'])->delete();

            return false;
        }
    }

    /**
     * @param $input
     *
     *
     * @return bool
     */
    public function storeReportJobAbuse($input)
    {
        $jobReportedAsAbuse = ReportedJob::where('user_id', $input['userId'])->where('job_id',
            $input['jobId'])->exists();
        if (! $jobReportedAsAbuse) {
            $reportedJobNote = trim($input['note']);
            if (empty($reportedJobNote)) {
                throw ValidationException::withMessages([
                    'note' => 'The Note Field is required',
                ]);
            }
            ReportedJob::create([
                'user_id' => $input['userId'],
                'job_id'  => $input['jobId'],
                'note'    => $input['note'],
            ]);

            return true;
        }

        return false;
    }

    /**
     * @param $input
     *
     * @return bool
     */
    public function emailJobToFriend($input)
    {
        try {
            DB::beginTransaction();

            /** @var EmailJob $emailJob */
            $emailJob = EmailJob::create($input);
            /** @var EmailTemplate $templateBody */
            $templateBody = EmailTemplate::whereTemplateName('Email Job To Friend')->first()['body'];
            $keyVariable = ['{{friend_name}}', '{{job_url}}', '{{from_name}}'];
            $value = [$emailJob->friend_name, $emailJob->job_url, config('app.name')];
            $body = str_replace($keyVariable, $value, $templateBody);
            $data['body'] = $body;
            Mail::to($input['friend_email'])->send(new EmailJobToFriend($data));

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @throws Exception
     *
     * @return bool
     */
    public function canCreateMoreJobs()
    {
        /** @var Company $company */
        $company = Company::whereUserId(Auth::id())->first();

        /** @var SubscriptionRepository $subscriptionRepo */
        $subscriptionRepo = app(SubscriptionRepository::class);
        // retrieve user's subscription
        $subscription = $subscriptionRepo->getUserSubscription($company->user_id);

        if ($subscription) {
            // retrieve job count
            $jobCount = Job::whereStatus(Job::STATUS_OPEN)->where('company_id', $company->id)->where('is_created_by_admin',0)->count();

            $maxJobCount = Plan::whereId($subscription->plan_id)->value('allowed_jobs');

            if ($maxJobCount > $jobCount) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $reportedJobID
     *
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getReportedJobs($reportedJobID)
    {
        return ReportedJob::with(['user.candidate', 'job.company'])->without([
            'user.media', 'user.country', 'user.state', 'user.city',
        ])->select('reported_jobs.*')->orderBy('created_at',
            'desc')->findOrFail($reportedJobID);
    }
}
