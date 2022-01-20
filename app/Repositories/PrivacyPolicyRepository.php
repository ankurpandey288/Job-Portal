<?php

namespace App\Repositories;

use App\Models\Setting;

/**
 * Class PrivacyPolicyRepository
 */
class PrivacyPolicyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'key',
        'value',
    ];

    /**
     * {@inheritdoc}
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * {@inheritdoc}
     */
    public function model()
    {
        return Setting::class;
    }
}
