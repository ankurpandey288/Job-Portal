<?php

namespace App\Queries;

use App\Models\CompanySize;

/**
 * Class CompanySizeDataTable
 */
class CompanySizeDataTable
{
    /**
     * @return CompanySize
     */
    public function get()
    {
        /** @var CompanySize $query */
        $query = CompanySize::query()->select('company_sizes.*');

        return $query;
    }
}
