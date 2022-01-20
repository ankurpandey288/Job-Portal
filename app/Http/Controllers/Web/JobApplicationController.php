<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\ApplyJobRequest;
use App\Mail\EmailToEmployer;
use App\Models\Candidate;
use App\Models\EmailTemplate;
use App\Models\Job;
use App\Models\Notification;
use App\Models\NotificationSetting;
use App\Repositories\JobApplicationRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class JobApplicationController extends AppBaseController
{
    /** @var JobApplicationRepository */
    private $jobApplicationRepository;

    public function __construct(JobApplicationRepository $jobApplicationRepo)
    {
        $this->jobApplicationRepository = $jobApplicationRepo;
    }

    /**
     * @param  string  $jobId
     *
     * @return Factory|View
     */
    public function showApplyJobForm($jobId)
    {
        $data = $this->jobApplicationRepository->showApplyJobForm($jobId);

        if (count($data['resumes']) <= 0) {
            return redirect()->back()->with('warning', 'There are no resume uploaded.');
        }

        return view('web.jobs.apply_job.apply_job')->with($data);
    }

    /**
     * @param  ApplyJobRequest  $request
     *
     * @return mixed
     */
    public function applyJob(ApplyJobRequest $request)
    {
        $input = $request->all();

        $this->jobApplicationRepository->store($input);

        /** @var Job $job */
        $job = Job::with(['company.user', 'appliedJobs'])->findOrFail($input['job_id']);
        $employerId = $job->company->user->id;

        $input['application_type'] != 'draft' ? NotificationSetting::whereKey(Notification::JOB_APPLICATION_SUBMITTED)->first()->value == 1 ?
            addNotification([
                Notification::JOB_APPLICATION_SUBMITTED,
                $employerId,
                Notification::EMPLOYER,
                'Job Application submitted for '.$job->job_title,
            ]) : false : false;

        $candidateUniqueId = Candidate::whereUserId(getLoggedInUserId())->value('unique_id');
        $templateBody = EmailTemplate::whereTemplateName('Candidate Job Applied')->first();
        $keyVariable = [
            '{{employer_fullName}}', '{{candidate_name}}', '{{candidate_details_url}}', '{{job_title}}', '{{from_name}}',
        ];
        $value = [
            $job->company->user->full_name, getLoggedInUser()->full_name,
            asset('/candidate-details/'.$candidateUniqueId), $job->job_title, config('app.name'),
        ];
        $body = str_replace($keyVariable, $value, $templateBody->body);
        $data['body'] = $body;

        Mail::to($job->company->user->email)->send(new EmailToEmployer($data));

        return $input['application_type'] == 'draft' ?
            $this->sendResponse($job->job_id, 'Job Application Drafted Successfully') :
            $this->sendResponse($job->job_id, 'Job Applied Successfully');
    }
}
