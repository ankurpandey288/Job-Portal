<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class JobShift
 *
 * @version June 23, 2020, 5:43 am UTC
 * @property string $shift
 * @property string $description
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobShift newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobShift newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobShift query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobShift whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobShift whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobShift whereShift($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobShift whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobShift whereDescription($value)
 */
class JobShift extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'shift' => 'required|max:160|unique:job_shifts,shift',
    ];
    public $table = 'job_shifts';
    public $fillable = [
        'shift',
        'description',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'shift'       => 'string',
        'description' => 'string',
    ];
}
