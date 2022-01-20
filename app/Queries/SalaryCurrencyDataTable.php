<?php

namespace App\Queries;

use App\Models\SalaryCurrency;

/**
 * Class SalaryCurrencyDataTable
 */
class SalaryCurrencyDataTable
{
    /**
     * @return SalaryCurrency
     */
    public function get()
    {
        /** @var SalaryCurrency $query */
        $query = SalaryCurrency::query()->select('salary_currencies.*');

        return $query;
    }
}
