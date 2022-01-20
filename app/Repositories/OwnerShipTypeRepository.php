<?php

namespace App\Repositories;

use App\Models\OwnerShipType;

/**
 * Class OwnerShipTypeRepository
 * @version June 22, 2020, 9:47 am UTC
 */
class OwnerShipTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
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
        return OwnerShipType::class;
    }
}
