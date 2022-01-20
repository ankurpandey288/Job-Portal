<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\CandidateEducation
 *
 * @property int $id
 * @property int $candidate_id
 * @property int $degree_level_id
 * @property string $country
 * @property string|null $state
 * @property string|null $city
 * @property string $institute
 * @property string $result
 * @property int $year
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Candidate $candidate
 * @method static Builder|CandidateEducation newModelQuery()
 * @method static Builder|CandidateEducation newQuery()
 * @method static Builder|CandidateEducation query()
 * @method static Builder|CandidateEducation whereCandidateId($value)
 * @method static Builder|CandidateEducation whereCity($value)
 * @method static Builder|CandidateEducation whereCountry($value)
 * @method static Builder|CandidateEducation whereCreatedAt($value)
 * @method static Builder|CandidateEducation whereDegreeLevelId($value)
 * @method static Builder|CandidateEducation whereId($value)
 * @method static Builder|CandidateEducation whereInstitute($value)
 * @method static Builder|CandidateEducation whereResult($value)
 * @method static Builder|CandidateEducation whereState($value)
 * @method static Builder|CandidateEducation whereUpdatedAt($value)
 * @method static Builder|CandidateEducation whereYear($value)
 * @mixin Eloquent
 * @property string $degree_title
 * @property-read \App\Models\RequiredDegreeLevel $degreeLevel
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateEducation whereDegreeTitle($value)
 * @property int|null $country_id
 * @property int|null $state_id
 * @property int|null $city_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateEducation whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateEducation whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CandidateEducation whereStateId($value)
 */
class CandidateEducation extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'degree_title' => 'required|max:150',
        'country_id'   => 'required',
        'institute'    => 'required|max:150',
        'result'       => 'required|max:150',
        'year'         => 'required',
    ];
    public $table = 'candidate_educations';
    public $fillable = [
        'candidate_id',
        'degree_level_id',
        'degree_title',
        'country_id',
        'state_id',
        'city_id',
        'institute',
        'result',
        'year',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'candidate_id'    => 'integer',
        'degree_level_id' => 'integer',
        'degree_title'    => 'string',
        'country_id'      => 'integer',
        'state_id'        => 'integer',
        'city_id'         => 'integer',
        'institute'       => 'string',
        'result'          => 'string',
        'year'            => 'integer',
    ];

    /**
     * @return BelongsTo
     */
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

    /**
     * @return BelongsTo
     */
    public function degreeLevel()
    {
        return $this->belongsTo(RequiredDegreeLevel::class, 'degree_level_id');
    }
}
