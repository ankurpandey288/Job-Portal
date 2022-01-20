<?php

namespace App\Queries;

use App\Models\BrandingSliders;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class BrandingSliderDataTable
 */
class BrandingSliderDataTable
{
    /**
     * @param  array  $input
     *
     * @return BrandingSliders
     */
    public function get($input = [])
    {
        /** @var BrandingSliders $query */
        $query = BrandingSliders::query()->select('branding_sliders.*');

        $query->when(isset($input['is_active']) && $input['is_active'] != 2,
            function (Builder $q) use ($input) {
                $q->where('is_active', $input['is_active']);
            });

        return $query;
    }
}
