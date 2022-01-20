<?php

namespace App\Queries;

use App\Models\FunctionalArea;

/**
 * Class FunctionalAreaDataTable
 */
class FunctionalAreaDataTable
{
    /**
     * @return FunctionalArea
     */
    public function get()
    {
        /** @var FunctionalArea $query */
        $query = FunctionalArea::query()->select('functional_areas.*');

        return $query;
    }
}
