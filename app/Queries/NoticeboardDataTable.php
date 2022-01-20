<?php

namespace App\Queries;

use App\Models\Noticeboard;

/**
 * Class NoticeboardDataTable
 */
class NoticeboardDataTable
{
    /**
     * @return Noticeboard
     */
    public function get()
    {
        /** @var Noticeboard $query */
        $query = Noticeboard::query()->select('noticeboards.*');

        return $query;
    }
}
