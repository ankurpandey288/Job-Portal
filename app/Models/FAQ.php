<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FAQ
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FAQ newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FAQ newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FAQ query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FAQ whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FAQ whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FAQ whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FAQ whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FAQ whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FAQ extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title'       => 'required|max:150',
        'description' => 'required',
    ];

    public $table = 'faqs';

    /**
     * @var string[]
     */
    public $fillable = [
        'title',
        'description',
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
