<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class JobType
 *
 * @version June 22, 2020, 5:43 am UTC
 * @property string $name
 * @property string $description
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobType whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobType whereDescription($value)
 * @property int $is_default
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Candidate[] $candidateJobAlerts
 * @property-read int|null $candidate_job_alerts_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobType whereIsDefault($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Job[] $jobs
 * @property-read int|null $jobs_count
 */
class JobType extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|max:160|unique:job_types,name',
    ];
    public $table = 'job_types';
    public $fillable = [
        'name',
        'description',
        'company_id',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'name'        => 'string',
        'description' => 'string',
    ];

    /**
     * @return BelongsToMany
     */
    public function candidateJobAlerts()
    {
        return $this->belongsToMany(Candidate::class, 'jobs_alerts', 'job_type_id', 'candidate_id');
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
