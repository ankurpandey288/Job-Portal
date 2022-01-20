<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class NotificationController extends AppBaseController
{
    /**
     * @param  Notification  $notification
     *
     * @return JsonResponse
     */
    public function readNotification(Notification $notification)
    {
        $notification->read_at = Carbon::now();
        $notification->save();

        return $this->sendSuccess('Notification read successfully.');
    }

    /**
     * @return JsonResponse
     */
    public function readAllNotification()
    {
        Notification::whereReadAt(null)->where('user_id', getLoggedInUserId())->update(['read_at' => Carbon::now()]);

        return $this->sendSuccess('All Notification read successfully.');
    }
}
