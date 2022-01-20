<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SalaryPeriod
 *
 * @version June 23, 2020, 5:43 am UTC
 * @property string $period
 * @property string $description
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalaryPeriod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalaryPeriod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalaryPeriod query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalaryPeriod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalaryPeriod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalaryPeriod wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalaryPeriod whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SalaryPeriod whereDescription($value)
 */
class SalaryPeriod extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'period' => 'required|unique:salary_periods,period|max:150',
    ];
    public $table = 'salary_periods';
    public $fillable = [
        'period',
        'description',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'period'      => 'string',
        'description' => 'string',
    ];
}
