<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CompanySize
 *
 * @version June 20, 2020, 5:43 am UTC
 * @property string $size
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanySize newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanySize newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanySize query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanySize whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanySize whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanySize whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanySize whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CompanySize whereSize($value)
 */
class CompanySize extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'size' => 'required|unique:company_sizes,size|regex:/^\d*-*\d*$/',
    ];
    public $table = 'company_sizes';
    public $fillable = [
        'size',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'           => 'integer',
        'size' => 'string',
    ];
}
