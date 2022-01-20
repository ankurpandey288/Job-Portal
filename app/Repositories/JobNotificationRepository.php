<?php

namespace App\Repositories;

use App\Mail\JobNotification;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\EmailTemplate;
use App\Models\Job;
use Arr;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class JobNotificationRepository
 */
class JobNotificationRepository
{
    /**
     * @return mixed
     */
    public function getJobNotificationData()
    {
        $data['candidates'] = Candidate::with('user')->whereHas('user', function (Builder $q) {
            $q->where('is_active', true);
        })->get()->pluck('user.full_name', 'id');

        $now = Carbon::now()->toDateString();
        $data['jobs'] = Job::whereDate('job_expiry_date', '>=', $now)->where('status', '1')->orderBy('created_at',
            'desc')->get();

        $data['companies'] = Company::with('user')->whereHas('user', function (Builder $q) {
            $q->where('is_active', true);
        })->get()->pluck('user.full_name', 'id');

        return $data;
    }

    public function sendJobNotification($input)
    {
        $candidateIds = Arr::only($input, 'candidate_id')['candidate_id'];
        $jobIds = Arr::only($input, 'job_id')['job_id'];

        $candidates = Candidate::with('user')->whereIn('id', $candidateIds)->get();
        $jobs = Job::whereIn('id', $jobIds)->get();
        /** @var EmailTemplate $templateBody */
        $templateBody = EmailTemplate::whereTemplateName('Job Notification')->first();

        try {
            DB::beginTransaction();
            foreach ($candidates as $candidate) {
                $keyVariable = ['{{candidate_name}}', '{{from_name}}', '{{app_url}}', '{{date}}'];
                $value = [$candidate->user->full_name, config('app.name'), config('app.url'), now()->format('d-m-Y')];
                $body = str_replace($keyVariable, $value, $templateBody->body);
                $data['footer'] = \Str::after($body, '{{jobs}}');
                $data['body'] = \Str::before($body, '{{jobs}}');
                $data['jobs'] = $jobs;

                Mail::to($candidate->user->email)->send(new JobNotification($data));
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
