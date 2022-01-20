<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Plan
 *
 * @property int $id
 * @property string $name
 * @property string|null $stripe_plan_id
 * @property int $allowed_jobs
 * @property float $amount
 * @property int $is_trial_plan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereAllowedJobs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereIsTrialPlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereStripePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subscription[] $activeSubscriptions
 * @property-read int|null $active_subscriptions_count
 * @method static \Illuminate\Database\Query\Builder|Plan onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Plan withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Plan withoutTrashed()
 * @property int $salary_currency_id
 * @property-read \App\Models\SalaryCurrency $salaryCurrency
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereSalaryCurrencyId($value)
 */
class Plan extends Model
{
    use SoftDeletes;
    /**
     * @var string
     */
    protected $table = 'plans';

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'         => 'required|max:180|unique:plans,name',
        'amount'       => 'required|numeric|min:1|max:99999',
        'allowed_jobs' => 'required|numeric|min:1|max:99999',
    ];
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'stripe_plan_id',
        'allowed_jobs',
        'amount',
        'salary_currency_id',
        'is_trial_plan',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'name'           => 'string',
        'stripe_plan_id' => 'string',
        'allowed_jobs'   => 'integer',
        'amount'         => 'double',
        'is_trial_plan'  => 'boolean',
    ];

    /**
     * @return BelongsTo
     */
    public function activeSubscriptions()
    {
        return $this->hasMany(Subscription::class, 'plan_id', 'id')
            ->Where('ends_at', '=', null);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function salaryCurrency()
    {
        return $this->belongsTo(SalaryCurrency::class, 'salary_currency_id', 'id');
    }
}
