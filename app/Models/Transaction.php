<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property int $user_id
 * @property int $subscription_id
 * @property string $invoice_id
 * @property float|null $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Subscription $subscription
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereOwnerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereUserId($value)
 * @mixin \Eloquent
 * @property int $owner_id
 * @property string $owner_type
 * @property-read mixed $type_name
 * @property-read Model|\Eloquent $type
 */
class Transaction extends Model
{
    /**
     * @var string
     */
    public $table = 'transactions';

    /**
     * @var array
     */
    public $fillable = [
        'user_id',
        'owner_id',
        'owner_type',
        'amount',
        'invoice_id',
    ];

    /**
     * @var array
     */
    public $casts = [
        'user_id'    => 'integer',
        'owner_id'   => 'integer',
        'amount'     => 'float',
        'invoice_id' => 'string',
        'owner_type' => 'string',
    ];

    protected $appends = ['type_name'];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function type()
    {
        return $this->morphTo('owner');
    }

    public function getTypeNameAttribute()
    {
        switch ($this->owner_type) {
            case Company::class:
                return 'Featured Company';
                break;
            case Job::class:
                return 'Featured Job';
                break;
            case Subscription::class:
                return 'Company Subscription';
                break;
            default:
                return 'N/A';
        }
    }
}
