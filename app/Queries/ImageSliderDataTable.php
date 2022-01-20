<?php

namespace App\Queries;

use App\Models\ImageSlider;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ImageSliderDataTable
 */
class ImageSliderDataTable
{
    /**
     * @return ImageSlider
     */
    public function get($input = [])
    {
        /** @var ImageSlider $query */
        $query = ImageSlider::query()->select('image_sliders.*');

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
