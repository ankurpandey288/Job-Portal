<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class OwnerShipType
 *
 * @version June 22, 2020, 9:47 am UTC
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OwnerShipType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OwnerShipType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OwnerShipType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OwnerShipType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OwnerShipType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OwnerShipType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OwnerShipType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OwnerShipType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OwnerShipType extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'        => 'required|max:150|unique:ownership_types,name',
        'description' => 'nullable',
    ];
    public $table = 'ownership_types';
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
        'id' => 'integer',
    ];
}
