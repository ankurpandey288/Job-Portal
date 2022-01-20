<?php

namespace App\Queries;

use App\Models\Language;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class LanguageDataTable
 */
class LanguageDataTable
{
    /**
     * @return Language|Builder
     */
    public function get()
    {
        /** @var Language $query */
        $query = Language::query()->select('languages.*');

        return $query;
    }
}
