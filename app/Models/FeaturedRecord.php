<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FeaturedRecord
 *
 * @property int $id
 * @property int $owner_id
 * @property string $owner_type
 * @property int $user_id
 * @property string|null $stripe_id
 * @property string $start_time
 * @property string $end_time
 * @property string|null $meta
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FeaturedRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FeaturedRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FeaturedRecord query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FeaturedRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FeaturedRecord whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FeaturedRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FeaturedRecord whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FeaturedRecord whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FeaturedRecord whereOwnerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FeaturedRecord whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FeaturedRecord whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FeaturedRecord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FeaturedRecord whereUserId($value)
 * @mixin \Eloquent
 */
class FeaturedRecord extends Model
{
    public $table = 'featured_records';

    public $fillable = [
        'owner_id',
        'owner_type',
        'user_id',
        'stripe_id',
        'start_time',
        'end_time',
        'meta',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
