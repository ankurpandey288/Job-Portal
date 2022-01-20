<?php

namespace App\Repositories;

use App\Models\RequiredDegreeLevel;
use App\Repositories\BaseRepository;

/**
 * Class RequiredDegreeLevelRepository
 * @version June 30, 2020, 12:30 pm UTC
 */
class RequiredDegreeLevelRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
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
        return RequiredDegreeLevel::class;
    }
}
