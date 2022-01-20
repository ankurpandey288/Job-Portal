<?php

namespace App\Queries;

use App\Models\HeaderSlider;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class HeaderSliderDataTable
 */
class HeaderSliderDataTable
{
    /**
     * @return ImageSlider
     */
    public function get($input = [])
    {
        /** @var ImageSlider $query */
        $query = HeaderSlider::query()->select('header_sliders.*');

        $query->when(isset($input['is_active']) && $input['is_active'] == 1,
            function (Builder $q) use ($input) {
                $q->where('is_active', '=', $input['is_active']);
            });

        $query->when(isset($input['is_active']) && $input['is_active'] == 0,
            function (Builder $q) use ($input) {
                $q->where('is_active', '=', $input['is_active']);
            });

        return $query;
    }
}
