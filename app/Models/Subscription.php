<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Cashier\Subscription as CashierSubscription;

/**
 * App\Models\Subscription
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $stripe_id
 * @property string $stripe_status
 * @property string|null $stripe_plan
 * @property int|null $plan_id
 * @property int|null $quantity
 * @property string|null $trial_ends_at
 * @property string|null $ends_at
 * @property string|null $current_period_start
 * @property string|null $current_period_end
 * @property string|null $cancellation_reason
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Plan|null $plan
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereCancellationReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereCurrentPeriodEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereCurrentPeriodStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereStripePlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereStripeStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereTrialEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Cashier\SubscriptionItem[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\User $owner
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription active()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription cancelled()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription ended()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription incomplete()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription notCancelled()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription notOnGracePeriod()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription notOnTrial()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription onGracePeriod()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription onTrial()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription pastDue()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription recurring()
 * @property string $type
 * @property string|null $paypal_payment_id
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription wherePaypalPaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereType($value)
 * @property-read \App\Models\Plan|null $planCurrency
 */
class Subscription extends CashierSubscription
{
    protected $table = 'subscriptions';

    const TYPE = [
        1 => 'stripe',
        2 => 'paypal',
    ];

    /**
     * @return BelongsTo
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'stripe_plan', 'stripe_plan_id');
    }

    /**
     * @return BelongsTo
     */
    public function planCurrency()
    {
        return $this->belongsTo(Plan::class, 'plan_id', 'id');
    }
}
