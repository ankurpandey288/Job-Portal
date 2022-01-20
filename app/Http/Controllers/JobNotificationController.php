<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Repositories\JobNotificationRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Laracasts\Flash\Flash;

class JobNotificationController extends AppBaseController
{
    /**
     * @var JobNotificationRepository
     */
    private $jobNotificationRepository;

    public function __construct(JobNotificationRepository $jobNotificationRepository)
    {
        $this->jobNotificationRepository = $jobNotificationRepository;
    }

    /**
     * @param  Request  $request
     *
     * @return Application|Factory|JsonResponse|View
     */
    public function index(Request $request)
    {
        $data = $this->jobNotificationRepository->getJobNotificationData();

        if ($request->ajax()) {
            return $this->sendResponse($data['jobs'], 'Jobs retrieved successfully.');
        }

        return view('job_notification.index')->with($data);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $jobNotification = $this->jobNotificationRepository->sendJobNotification($input);

        Flash::success('Job Notification send successfully.');

        return redirect(route('job-notification.index'));
    }

    /**
     * @param $id
     *
     * @return JsonResponse
     */
    public function getEmployerJobs($id)
    {
        $employerJobs = Company::where('id', $id)->with([
            'user', 'jobs' => function (HasMany $query) {
                $query->whereDate('job_expiry_date', '>=', Carbon::now()->toDateString())->where('status', '=', '1');
            },
        ])->first();

        return $this->sendResponse($employerJobs, 'Employer jobs retrieved successfully.');
    }
}
