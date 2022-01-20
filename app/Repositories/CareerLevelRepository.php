<?php

namespace App\Repositories;

use App\Models\CareerLevel;
use App\Repositories\BaseRepository;

/**
 * Class CareerLevelRepository
 * @version July 7, 2020, 5:07 am UTC
 */
class CareerLevelRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'level_name',
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
        return CareerLevel::class;
    }
}
