<?php

namespace App\Repositories;

use App\Models\Setting;
use App\DotenvEditor;
use Brotzka\DotenvEditor\Exceptions\DotEnvException;
use Illuminate\Support\Arr;
use Spatie\MediaLibrary\MediaCollections\Exceptions\DiskDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

/**
 * Class SettingRepository
 */
class SettingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'key',
        'value',
    ];

    /**
     * {@inheritdoc}
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * {@inheritdoc}
     */
    public function model()
    {
        return Setting::class;
    }

    /**
     * @return mixed
     */
    public function getEnvData()
    {
        $env = new DotenvEditor();
        $key = $env->getContent();
        $data['mail'] = collect($key)->only([
            'MAIL_MAILER', 'MAIL_HOST', 'MAIL_PORT', 'MAIL_USERNAME', 'MAIL_PASSWORD', 'MAIL_FROM_ADDRESS',
        ])->toArray();
        $data['facebook'] = collect($key)->only([
            'FACEBOOK_APP_ID', 'FACEBOOK_APP_SECRET', 'FACEBOOK_REDIRECT',
        ])->toArray();
        $data['pusher'] = collect($key)->only([
            'PUSHER_APP_ID', 'PUSHER_APP_KEY', 'PUSHER_APP_SECRET', 'PUSHER_APP_CLUSTER',
        ])->toArray();
        $data['stripe'] = collect($key)->only([
            'STRIPE_KEY', 'STRIPE_SECRET', 'STRIPE_WEBHOOK_SECRET_KEY',
        ])->toArray();
        $data['paypal'] = collect($key)->only(['PAYPAL_CLIENT_ID', 'PAYPAL_SECRET'])->toArray();
        $data['linkedIn'] = collect($key)->only(['LINKEDIN_CLIENT_ID', 'LINKEDIN_CLIENT_SECRET'])->toArray();
        $data['google'] = collect($key)->only([
            'GOOGLE_CLIENT_ID', 'GOOGLE_CLIENT_SECRET', 'GOOGLE_REDIRECT',
        ])->toArray();
        $data['cookie'] = collect($key)->only(['COOKIE_CONSENT_ENABLED'])->toArray();

        return $data;
    }

    /**
     * @param  array  $input
     *
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     * @throws DotEnvException
     *
     * @return bool
     */
    public function updateSetting($input)
    {
        $env = new DotenvEditor();
        $inputArr = Arr::except($input, ['_token']);

        if ($inputArr['sectionName'] == 'env_setting') {
            $env->setAutoBackup(true);

            if (! empty($inputArr['mail_username'])) {
                $inputArr['mail_username'] = '"'.$inputArr['mail_username'].'"';
            }

            if (! empty($inputArr['mail_password'])) {
                $inputArr['mail_password'] = '"'.$inputArr['mail_password'].'"';
            }

            if (! empty($inputArr['mail_from_address'])) {
                $inputArr['mail_from_address'] = '"'.$inputArr['mail_from_address'].'"';
            }

            $envData = [
                'MAIL_MAILER'               => (empty($inputArr['mail_mailer'])) ? '' : $inputArr['mail_mailer'],
                'MAIL_HOST'                 => (empty($inputArr['mail_host'])) ? '' : $inputArr['mail_host'],
                'MAIL_PORT'                 => (empty($inputArr['mail_port'])) ? '' : $inputArr['mail_port'],
                'MAIL_USERNAME'             => (empty($inputArr['mail_username'])) ? '' : $inputArr['mail_username'],
                'MAIL_PASSWORD'             => (empty($inputArr['mail_password'])) ? '' : $inputArr['mail_password'],
                'MAIL_FROM_ADDRESS'         => (empty($inputArr['mail_from_address'])) ? '' : $inputArr['mail_from_address'],
                'FACEBOOK_APP_ID'           => (empty($inputArr['facebook_app_id'])) ? '' : $inputArr['facebook_app_id'],
                'FACEBOOK_APP_SECRET'       => (empty($inputArr['facebook_app_secret'])) ? '' : $inputArr['facebook_app_secret'],
                'FACEBOOK_REDIRECT'         => (empty($inputArr['facebook_redirect'])) ? '' : $inputArr['facebook_redirect'],
                'PUSHER_APP_ID'             => (empty($inputArr['pusher_app_id'])) ? '' : $inputArr['pusher_app_id'],
                'PUSHER_APP_KEY'            => (empty($inputArr['pusher_app_key'])) ? '' : $inputArr['pusher_app_key'],
                'PUSHER_APP_SECRET'         => (empty($inputArr['pusher_app_secret'])) ? '' : $inputArr['pusher_app_secret'],
                'PUSHER_APP_CLUSTER'        => (empty($inputArr['pusher_app_cluster'])) ? '' : $inputArr['pusher_app_cluster'],
                'STRIPE_KEY'                => (empty($inputArr['stripe_key'])) ? '' : $inputArr['stripe_key'],
                'STRIPE_SECRET'             => (empty($inputArr['stripe_secret'])) ? '' : $inputArr['stripe_secret'],
                'STRIPE_WEBHOOK_SECRET_KEY' => (empty($inputArr['stripe_webhook_key'])) ? '' : $inputArr['stripe_webhook_key'],
                'PAYPAL_CLIENT_ID'          => (empty($inputArr['paypal_client_id'])) ? '' : $inputArr['paypal_client_id'],
                'PAYPAL_SECRET'             => (empty($inputArr['paypal_secret'])) ? '' : $inputArr['paypal_secret'],
                'LINKEDIN_CLIENT_ID'        => (empty($inputArr['linkedin_client_id'])) ? '' : $inputArr['linkedin_client_id'],
                'LINKEDIN_CLIENT_SECRET'    => (empty($inputArr['linkedin_client_secret'])) ? '' : $inputArr['linkedin_client_secret'],
                'GOOGLE_CLIENT_ID'          => (empty($inputArr['google_client_id'])) ? '' : $inputArr['google_client_id'],
                'GOOGLE_CLIENT_SECRET'      => (empty($inputArr['google_client_secret'])) ? '' : $inputArr['google_client_secret'],
                'GOOGLE_REDIRECT'           => (empty($inputArr['google_redirect'])) ? '' : $inputArr['google_redirect'],
                'COOKIE_CONSENT_ENABLED'    => (isset($inputArr['cookie_consent_enabled'])) ? 'true' : 'false',
            ];

            foreach ($envData as $key => $value) {
                $this->createOrUpdateEnv($env, $key, $value);
            }
        }

        if ($inputArr['sectionName'] == 'social_settings') {
            $inputArr['facebook_url'] = (empty($inputArr['facebook_url'])) ? '' : $inputArr['facebook_url'];
            $inputArr['twitter_url'] = (empty($inputArr['twitter_url'])) ? '' : $inputArr['twitter_url'];
            $inputArr['google_plus_url'] = (empty($inputArr['google_plus_url'])) ? '' : $inputArr['google_plus_url'];
            $inputArr['linkedIn_url'] = (empty($inputArr['linkedIn_url'])) ? '' : $inputArr['linkedIn_url'];
        }
        if ($inputArr['sectionName'] == 'general') {
            $inputArr['enable_google_recaptcha'] = (! isset($inputArr['enable_google_recaptcha'])) ? false : $inputArr['enable_google_recaptcha'];
        }
        foreach ($inputArr as $key => $value) {
            /** @var Setting $setting */
            $setting = Setting::where('key', $key)->first();
            if (! $setting) {
                continue;
            }

            if (in_array($key, ['logo', 'favicon','footer_logo']) && ! empty($value)) {
                $this->fileUpload($setting, $value);
                continue;
            }

            $setting->update(['value' => $value]);
        }

        return true;
    }

    /**
     * @param  Setting  $setting
     * @param $file
     *
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     *
     * @return mixed
     */
    public function fileUpload($setting, $file)
    {
        $setting->clearMediaCollection(Setting::PATH);
        $media = $setting->addMedia($file)->toMediaCollection(Setting::PATH, config('app.media_disc'));
        $setting->update(['value' => $media->getFullUrl()]);

        return $setting;
    }

    /**
     * @param $env
     * @param $key
     * @param $value
     *
     * @return bool
     */
    public function createOrUpdateEnv($env, $key, $value): bool
    {
        if (! $env->keyExists($key)) {
            $env->addData([
                $key => $value,
            ]);

            return true;
        }
        $env->changeEnv([
            $key => $value,
        ]);

        return true;
    }
}
