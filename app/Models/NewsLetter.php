<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\NewsLetter
 *
 * @property int $id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewsLetter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewsLetter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewsLetter query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewsLetter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewsLetter whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewsLetter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewsLetter whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class NewsLetter extends Model
{
    public $table = 'news_letters';

    public $fillable = [
        'email',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'    => 'integer',
        'email' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'email' => 'required|email:filter|unique:news_letters,email',
    ];
}
