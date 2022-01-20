<?php

namespace App\Queries;

use App\Models\EmailTemplate;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class EmailTemplateDataTable
 */
class EmailTemplateDataTable
{
    /**
     * @return Builder
     */
    public function get(): Builder
    {
        /** @var EmailTemplate $query */
        return EmailTemplate::query()->select('email_templates.*');
    }
}
