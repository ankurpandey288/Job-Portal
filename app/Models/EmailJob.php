<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\EmailJob
 *
 * @property int $id
 * @property int $user_id
 * @property string $job_url
 * @property string $friend_name
 * @property string $friend_email
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailJob newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailJob newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailJob query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailJob whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailJob whereFriendEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailJob whereFriendName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailJob whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailJob whereJobUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailJob whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailJob whereUserId($value)
 * @mixin \Eloquent
 * @property int $job_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailJob whereJobId($value)
 */
class EmailJob extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'friend_name'  => 'required',
        'friend_email' => 'required|email:filter',
    ];
    public $table = 'email_jobs';
    public $fillable = [
        'user_id', 'job_id', 'job_url', 'friend_name', 'friend_email',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'           => 'integer',
        'user_id'      => 'integer',
        'job_id'       => 'integer',
        'job_url'      => 'string',
        'friend_name'  => 'string',
        'friend_email' => 'string',
    ];
}
