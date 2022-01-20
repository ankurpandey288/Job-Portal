<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\NotificationSetting
 *
 * @property int $id
 * @property string $key
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereValue($value)
 * @mixin \Eloquent
 * @property string|null $type
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationSetting whereType($value)
 */
class NotificationSetting extends Model
{
    public $table = 'notification_settings';
    public $fillable = [
        'key',
        'value',
        'type',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'key'   => 'required',
        'value' => 'required',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'    => 'integer',
        'key'   => 'string',
        'value' => 'string',
    ];
}
