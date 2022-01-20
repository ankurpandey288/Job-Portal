<?php

namespace App\Repositories;

use App\Models\MaritalStatus;

/**
 * Class MaritalStatusRepository
 * @version June 23, 2020, 5:43 am UTC
 */
class MaritalStatusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'marital_status',
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
        return MaritalStatus::class;
    }
}
