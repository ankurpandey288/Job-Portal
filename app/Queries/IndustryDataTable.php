<?php

namespace App\Queries;

use App\Models\Industry;

/**
 * Class IndustryDataTable
 */
class IndustryDataTable
{
    /**
     * @return Industry
     */
    public function get()
    {
        /** @var Industry $query */
        $query = Industry::query()->select('industries.*');

        return $query;
    }
}
