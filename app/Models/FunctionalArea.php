<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class FunctionalArea
 *
 * @version July 4, 2020, 7:26 am UTC
 * @property string $name
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FunctionalArea newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FunctionalArea newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FunctionalArea query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FunctionalArea whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FunctionalArea whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FunctionalArea whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FunctionalArea whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FunctionalArea extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|unique:functional_areas|max:150',
    ];
    public $table = 'functional_areas';
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
