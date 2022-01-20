<?php

namespace App\Http\Controllers;

use App\Models\NotificationSetting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Laracasts\Flash\Flash;

class NotificationSettingsController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $notificationSetting = NotificationSetting::all()->groupBy('type');

        return view('notification_settings.index', compact('notificationSetting'));
    }

    /**
     * @param  Request  $request
     *
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $inputArr = $request->all();
        $notificationArray = array_fill_keys(array_keys(Arr::except($inputArr, ['_token'])), 1);

        DB::table('notification_settings')->update(['value' => 0]);
        foreach ($notificationArray as $key => $value) {
            /** @var NotificationSetting $notificationSetting */
            $notificationSetting = NotificationSetting::where('key', $key)->first();
            if (! $notificationSetting) {
                continue;
            }
            $notificationSetting->update(['value' => $value]);
        }
        Flash::success('Notification settings updated successfully.');

        return Redirect::back();
    }
}
