<?php

namespace App\Queries;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

/**
 * Class JobDataTable
 */
class JobDataTable
{
    /**
     * @return Job
     */
    public function get($input = [])
    {
        /** @var Job $query */
        $query = Job::with([
            'appliedJobs' => function ($query) {
                $query->where('status', '!=', JobApplication::STATUS_DRAFT);
            },
        ], 'activeFeatured')->where('company_id', Auth::user()->owner_id);

        $query->when(isset($input['is_featured']) && $input['is_featured'] == 1,
            function (Builder $q) use ($input) {
                $q->has('activeFeatured');
            });

        $query->when(isset($input['is_featured']) && $input['is_featured'] == 0,
            function (Builder $q) use ($input) {
                $q->doesnthave('activeFeatured');
            });
        $query->when(isset($input['status']),
            function (Builder $q) use ($input) {
                $q->where('status', '=', $input['status']);
            });

        return $query;
    }

    /**
     * @param  array  $input
     * @return Job
     */
    public function getJobs($input = [])
    {
        /** @var Job $query */
        $query = Job::select('jobs.*');

        $query->when(isset($input['is_featured']) && $input['is_featured'] == 1,
            function (Builder $q) use ($input) {
                $q->has('activeFeatured');
            });
        $query->when(isset($input['is_featured']) && $input['is_featured'] == 0,
            function (Builder $q) use ($input) {
                $q->doesnthave('activeFeatured');
            });
        $query->when(isset($input['is_suspended']) && $input['is_suspended'] != Job::IS_SUSPENDED,
            function (Builder $q) use ($input) {
                $q->where('is_suspended', '=', $input['is_suspended']);
            });
        $query->when(isset($input['is_freelancer']) && $input['is_freelancer'] == 1,
            function (Builder $q) use ($input) {
                $q->where('is_freelance', '=', $input['is_freelancer']);
            });
        $query->when(isset($input['is_freelancer']) && $input['is_freelancer'] == 0,
            function (Builder $q) use ($input) {
                $q->where('is_freelance', '=', $input['is_freelancer']);
            });
        $query->when(isset($input['expiry_date']) && $input['expiry_date'] != '',
            function (Builder $q) use ($input) {
                $q->whereMonth('job_expiry_date', $input['expiry_date']);
            });
        $query->when(isset($input['is_job_active']) && $input['is_job_active'] != '',
            function (Builder $q) use ($input) {
                if ($input['is_job_active']) {
                    $q->where('job_expiry_date', '<', date('Y-m-d'));
                } else {
                    $q->where('job_expiry_date', '>=', date('Y-m-d'));
                }
            });

        return $query;
    }
}
