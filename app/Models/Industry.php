<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Industry
 *
 * @version June 20, 2020, 5:43 am UTC
 * @property string $name
 * @property string $description
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Industry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Industry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Industry query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Industry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Industry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Industry whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Industry whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Industry whereDescription($value)
 */
class Industry extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|unique:industries,name|max:150',
    ];
    public $table = 'industries';
    public $fillable = [
        'name',
        'description',
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
}
