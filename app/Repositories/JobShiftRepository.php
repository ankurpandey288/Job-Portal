<?php

namespace App\Repositories;

use App\Models\JobShift;

/**
 * Class JobShiftRepository
 * @version June 23, 2020, 5:43 am UTC
 */
class JobShiftRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'shift',
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
        return JobShift::class;
    }
}
