<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SocialAccount
 *
 * @property int $id
 * @property int $user_id
 * @property string $provider
 * @property string $provider_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|SocialAccount newModelQuery()
 * @method static Builder|SocialAccount newQuery()
 * @method static Builder|SocialAccount query()
 * @method static Builder|SocialAccount whereCreatedAt($value)
 * @method static Builder|SocialAccount whereId($value)
 * @method static Builder|SocialAccount whereProvider($value)
 * @method static Builder|SocialAccount whereProviderId($value)
 * @method static Builder|SocialAccount whereUpdatedAt($value)
 * @method static Builder|SocialAccount whereUserId($value)
 * @mixin \Eloquent
 */
class SocialAccount extends Model
{
    const GOOGLE_PROVIDER = 'google';
    const FACEBOOK_PROVIDER = 'facebook';
    const LINKEDIN_PROVIDER = 'linkedin';

    const SOCIAL_PROVIDERS = [
        self::GOOGLE_PROVIDER,
        self::FACEBOOK_PROVIDER,
        self::LINKEDIN_PROVIDER,
    ];

    protected $table = 'social_accounts';

    protected $fillable = [
        'provider',
        'identifier',
        'device_id',
        'token',
        'token_secret',
    ];

    public static function facebookFields()
    {
        return [
            'first_name',
            'email',
            'gender',
            'id',
            'last_name',
            'name',
            'location',
            'verified',
            'birthday',
            'link',
            'locale',
        ];
    }
}
