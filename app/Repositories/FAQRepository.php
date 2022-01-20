<?php

namespace App\Repositories;

use App\Models\FAQ;

/**
 * Class FAQRepository
 */
class FAQRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return FAQ::class;
    }
}
