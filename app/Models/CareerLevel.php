<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class CareerLevel
 *
 * @version July 7, 2020, 5:07 am UTC
 * @property string $level_name
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CareerLevel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CareerLevel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CareerLevel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CareerLevel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CareerLevel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CareerLevel whereLevelName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CareerLevel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CareerLevel extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'level_name' => 'required|max:150|unique:career_levels',
    ];
    public $table = 'career_levels';
    public $fillable = [
        'level_name',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'         => 'integer',
        'level_name' => 'string',
    ];
}
