<?php

namespace App\Queries;

use App\Models\FAQ;

/**
 * Class FAQDataTable
 */
class FAQDataTable
{
    /**
     * @return FAQ
     */
    public function get()
    {
        /** @var FAQ $query */
        $query = FAQ::query()->select('faqs.*');

        return $query;
    }
}
