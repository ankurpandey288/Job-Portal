<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Language
 *
 * @version July 3, 2020, 9:12 am UTC
 * @property int $id
 * @property string $language
 * @property string|null $iso_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereIsoCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $candidate
 * @property-read int|null $candidate_count
 */
class Language extends Model
{
    public $table = 'languages';

    public $fillable = [
        'language',
        'iso_code',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'language' => 'required|unique:languages,language|max:150',
        'iso_code' => 'required|unique:languages,iso_code|max:150',
    ];

    /**
     * @return BelongsToMany
     */
    public function candidate()
    {
        return $this->belongsToMany(User::class, 'candidate_language');
    }
}
