<?php

namespace App\Queries;

use App\Models\Inquiry;

/**
 * Class InquiryDataTable
 */
class InquiryDataTable
{
    /**
     * @return Inquiry
     */
    public function get()
    {
        /** @var Inquiry $query */
        $query = Inquiry::query()->select('inquiries.*');

        return $query;
    }
}
