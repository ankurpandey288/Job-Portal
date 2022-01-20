<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\ReportedJob
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportedJob newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportedJob newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportedJob query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property int $job_id
 * @property string $note
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportedJob whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportedJob whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportedJob whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportedJob whereJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportedJob whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReportedJob whereUserId($value)
 * @property-read \App\Models\Job $job
 * @property-read \App\Models\User $user
 */
class ReportedJob extends Model
{
    public $table = 'reported_jobs';
    public $fillable = [
        'user_id',
        'job_id',
        'note',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'job_id'  => 'integer',
        'note'    => 'string',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
}
