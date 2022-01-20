<?php

namespace App\Queries;

use App\Models\JobApplication;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class JobApplicationDataTable
 */
class JobApplicationDataTable
{
    /**
     * @param  array  $input
     *
     *
     * @return JobApplication
     */
    public function get($input = [])
    {
        /** @var JobApplication $query */
        $query = JobApplication::with(['job.currency', 'candidate.user', 'jobStage'])
            ->where('job_id', $input['job_id'])
            ->where('status', '!=', JobApplication::STATUS_DRAFT)
            ->select('job_applications.*');

        $query->when(isset($input['status']), function (Builder $q) use ($input){
           $q->where('status','=',$input['status']);
        });

        return $query;
    }
}
