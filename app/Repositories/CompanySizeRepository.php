<?php

namespace App\Repositories;

use App\Models\CompanySize;

/**
 * Class CompanySizeRepository
 * @version June 20, 2020, 5:43 am UTC
 */
class CompanySizeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'size',
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
        return CompanySize::class;
    }
}
