<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\FavouriteJob
 *
 * @property int $id
 * @property int $user_id
 * @property int $job_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FavouriteJob newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FavouriteJob newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FavouriteJob query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FavouriteJob whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FavouriteJob whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FavouriteJob whereJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FavouriteJob whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FavouriteJob whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Job $job
 * @property-read \App\Models\User $user
 */
class FavouriteJob extends Model
{
    public $table = 'favourite_jobs';
    public $fillable = [
        'user_id',
        'job_id',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'job_id'  => 'integer',
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
