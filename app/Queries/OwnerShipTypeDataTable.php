<?php

namespace App\Queries;

use App\Models\OwnerShipType;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class OwnerShipTypeDataTable
 */
class OwnerShipTypeDataTable
{
    /**
     * @return OwnerShipType|Builder
     */
    public function get()
    {
        /** @var OwnerShipType $query */
        $query = OwnerShipType::query()->select('ownership_types.*');

        return $query;
    }
}
