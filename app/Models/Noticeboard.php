<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Noticeboard
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Noticeboard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Noticeboard newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Noticeboard query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Noticeboard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Noticeboard whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Noticeboard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Noticeboard whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Noticeboard whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $is_active
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Noticeboard whereIsActive($value)
 */
class Noticeboard extends Model
{
    const STATUS = [
        1 => 'Active',
        0 => 'Deactive',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
    ];
    public $table = 'noticeboards';

    public $fillable = [
        'title',
        'description',
        'is_active',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'title'       => 'string',
        'description' => 'string',
    ];
}
