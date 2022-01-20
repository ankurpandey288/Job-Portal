<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;
use App\Repositories\SettingRepository;
use Brotzka\DotenvEditor\Exceptions\DotEnvException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Laracasts\Flash\Flash;
use Spatie\MediaLibrary\MediaCollections\Exceptions\DiskDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

/**
 * Class SettingController
 */
class SettingController extends AppBaseController
{
    /** @var SettingRepository */
    private $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $envData = $this->settingRepository->getEnvData();
        $envData['mail']['MAIL_USERNAME'] = str_replace('"', '', $envData['mail']['MAIL_USERNAME']);
        $envData['mail']['MAIL_PASSWORD'] = str_replace('"', '', $envData['mail']['MAIL_PASSWORD']);
        $envData['mail']['MAIL_FROM_ADDRESS'] = str_replace('"', '', $envData['mail']['MAIL_FROM_ADDRESS']);
        $setting = Setting::pluck('value', 'key')->toArray();
        $setting['phone'] = preparePhoneNumber($setting['phone'], $setting['region_code']);
        $sectionName = ($request->section === null) ? 'general' : $request->section;

        return view("settings.$sectionName",
            compact('setting', 'sectionName'))->with($envData);
    }

    /**
     * @param  UpdateSettingRequest  $request
     *
     * @throws DotEnvException
     * @return RedirectResponse
     */
    public function update(UpdateSettingRequest $request)
    {
        $this->settingRepository->updateSetting($request->all());

        Flash::success('Setting updated successfully.');
        // in order to clear the cache for .env values
        if ($request->get('sectionName') == 'env_setting') {
            Artisan::call('optimize:clear');
            Artisan::call('config:cache');
        }

        return Redirect::back();
    }
}
