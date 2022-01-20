<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Notification
 *
 * @property int $id
 * @property int $type
 * @property int $notification_for
 * @property int $user_id
 * @property string $title
 * @property mixed|null $text
 * @property string|null $read_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereNotificationFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUserId($value)
 * @mixin \Eloquent
 * @property array|null $meta
 * @property-read string $notification_for_text
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereMeta($value)
 */
class Notification extends Model
{
    public $table = 'notifications';

    public $fillable = [
        'type',
        'notification_for',
        'user_id',
        'title',
        'text',
        'meta',
        'read_at',
    ];

    protected $casts = [
        'type'             => 'integer',
        'notification_for' => 'integer',
        'user_id'          => 'integer',
        'title'            => 'string',
        'text'             => 'text',
        'meta'             => 'array',
    ];

    const CANDIDATE = 1;
    const EMPLOYER = 2;
    const ADMIN = 3;

    const notificationType = [
        self::JOB_APPLICATION_SUBMITTED     => 'APPLICATION SUBMITTED',
        self::MARK_JOB_FEATURED             => 'MARK JOB FEATURED',
        self::MARK_COMPANY_FEATURED         => 'MARK COMPANY FEATURED',
        self::CANDIDATE_SELECTED_FOR_JOB    => 'SELECTED FOR JOB',
        self::CANDIDATE_REJECTED_FOR_JOB    => 'REJECTED FOR JOB',
        self::CANDIDATE_SHORTLISTED_FOR_JOB => 'SHORTLISTED FOR JOB',
        self::NEW_EMPLOYER_REGISTERED       => 'EMPLOYER REGISTERED',
        self::NEW_CANDIDATE_REGISTERED      => 'CANDIDATE REGISTERED',
        self::EMPLOYER_PURCHASE_PLAN        => 'PURCHASE PLAN',
        self::FOLLOW_COMPANY                => 'FOLLOW COMPANY',
        self::FOLLOW_JOB                    => 'FOLLOW JOB',
        self::JOB_ALERT                     => 'JOB ALERT',
        self::MARK_COMPANY_FEATURED_ADMIN   => 'MARK COMPANY FEATURED',
        self::MARK_JOB_FEATURED_ADMIN       => 'MARK JOB FEATURED',
    ];

    const JOB_APPLICATION_SUBMITTED = 1;
    const MARK_JOB_FEATURED = 2;
    const MARK_COMPANY_FEATURED = 3;
    const CANDIDATE_SELECTED_FOR_JOB = 4;
    const CANDIDATE_REJECTED_FOR_JOB = 5;
    const CANDIDATE_SHORTLISTED_FOR_JOB = 6;
    const NEW_EMPLOYER_REGISTERED = 7;
    const NEW_CANDIDATE_REGISTERED = 8;
    const EMPLOYER_PURCHASE_PLAN = 9;
    const FOLLOW_COMPANY = 10;
    const FOLLOW_JOB = 11;
    const JOB_ALERT = 12;
    const MARK_COMPANY_FEATURED_ADMIN = 13;
    const MARK_JOB_FEATURED_ADMIN = 14;

    /**
     * @return string
     */
    public function getNotificationForTextAttribute()
    {
        if (! empty($this->type)) {
            return self::notificationType[$this->type];
        }
    }
}
