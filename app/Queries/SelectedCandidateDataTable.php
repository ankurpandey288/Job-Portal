<?php

namespace App\Queries;

use App\Models\BrandingSliders;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BrandingSliderDataTable
 */
class SelectedCandidateDataTable
{
    /**
     * @param  array  $input
     *
     * @return Builder[]|Collection
     */
    public function get(array $input = [])
    {
        $query = JobApplication::with('candidate.user','job.company')
            ->whereIn('status',[JobApplication::SHORT_LIST,JobApplication::COMPLETE]);

        $query->when(isset($input['status']),
            function (Builder $query) use ($input) {
                $query->where('status', '=', $input['status']);
            });

        return $query->get();
    }
}
