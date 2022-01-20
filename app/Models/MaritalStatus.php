<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Language
 *
 * @version May 14, 2020, 5:43 am UTC
 * @property string $marital_status
 * @property string $description
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MaritalStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MaritalStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MaritalStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MaritalStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MaritalStatus whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MaritalStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MaritalStatus whereMaritalStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MaritalStatus whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MaritalStatus extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'marital_status' => 'required|unique:marital_status,marital_status|max:150',
    ];
    public $table = 'marital_status';
    public $fillable = [
        'marital_status',
        'description',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'             => 'integer',
        'marital_status' => 'string',
        'description'    => 'string',
    ];
}
