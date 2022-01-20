<?php

namespace App\Repositories;

use App\Models\SalaryCurrency;

/**
 * Class SalaryCurrencyRepository
 * @version July 7, 2020, 6:41 am UTC
 */
class SalaryCurrencyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'currency_name',
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
        return SalaryCurrency::class;
    }
}
