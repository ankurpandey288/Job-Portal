<?php

namespace App\Queries;

use App\Models\CareerLevel;

/**
 * Class CareerLevelDataTable
 */
class CareerLevelDataTable
{
    /**
     * @return CareerLevel
     */
    public function get()
    {
        /** @var CareerLevel $query */
        $query = CareerLevel::query()->select('career_levels.*');

        return $query;
    }
}
