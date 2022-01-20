<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\CandidateExperience
 *
 * @property int $id
 * @property int $candidate_id
 * @property string $experience_title
 * @property string $company
 * @property string $country
 * @property string|null $state
 * @property string|null $city
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property bool $currently_working
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|CandidateExperience newModelQuery()
 * @method static Builder|CandidateExperience newQuery()
 * @method static Builder|CandidateExperience query()
 * @method static Builder|CandidateExperience whereCandidateId($value)
 * @method static Builder|CandidateExperience whereCity($value)
 * @method static Builder|CandidateExperience whereCompany($value)
 * @method static Builder|CandidateExperience whereCountry($value)
 * @method static Builder|CandidateExperience whereCreatedAt($value)
 * @method static Builder|CandidateExperience whereCurrentlyWorking($value)
 * @method static Builder|CandidateExperience whereDescription($value)
 * @method static Builder|CandidateExperience whereEndDate($value)
 * @method static Builder|CandidateExperience whereExperienceTitle($value)
 * @method static Builder|CandidateExperience whereId($value)
 * @method static Builder|CandidateExperience whereStartDate($value)
 * @method static Builder|CandidateExperience whereState($value)
 * @method static Builder|CandidateExperience whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read \App\Models\Candidate $candidate
 * @property int|null $country_id
 * @property int|null $state_id
 * @property int|null $city_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateExperience whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateExperience whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateExperience whereStateId($value)
 */
class CandidateExperience extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'experience_title' => 'required|max:150',
        'company'          => 'required|max:150',
        'country_id'       => 'required',
        'start_date'       => 'required',
    ];
    public $table = 'candidate_experiences';
    public $fillable = [
        'candidate_id',
        'experience_title',
        'company',
        'country_id',
        'state_id',
        'city_id',
        'start_date',
        'end_date',
        'currently_working',
        'description',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'candidate_id'      => 'integer',
        'experience_title'  => 'string',
        'company'           => 'string',
        'country_id'        => 'integer',
        'state_id'          => 'integer',
        'city_id'           => 'integer',
        'start_date'        => 'date',
        'end_date'          => 'date',
        'currently_working' => 'boolean',
        'description'       => 'string',
    ];

    /**
     * @return BelongsTo
     */
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }
}
