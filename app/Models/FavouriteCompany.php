<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\FavouriteCompany
 *
 * @property int $id
 * @property int $user_id
 * @property int company_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FavouriteJob newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FavouriteJob newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FavouriteJob query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FavouriteJob whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FavouriteJob whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FavouriteJob whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FavouriteJob whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FavouriteJob whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\User $user
 * @property int $company_id
 */
class FavouriteCompany extends Model
{
    public $table = 'favourite_companies';
    public $fillable = [
        'user_id',
        'company_id',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id'    => 'integer',
        'company_id' => 'integer',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->with(['media']);
    }

    /**
     * @return BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
