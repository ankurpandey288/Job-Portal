<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class RequiredDegreeLevel
 *
 * @version June 30, 2020, 12:30 pm UTC
 * @property string $name
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RequiredDegreeLevel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RequiredDegreeLevel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RequiredDegreeLevel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RequiredDegreeLevel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RequiredDegreeLevel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RequiredDegreeLevel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RequiredDegreeLevel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RequiredDegreeLevel extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|max:160|unique:required_degree_levels',
    ];
    public $table = 'required_degree_levels';
    public $fillable = [
        'name',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'   => 'integer',
        'name' => 'string',
    ];
}
