<?php

namespace App\Repositories;

use App\Models\Candidate;
use App\Models\Company;
use App\Models\FavouriteCompany;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\Post;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class DashboardRepository
 * @version July 7, 2020, 5:07 am UTC
 */
class DashboardRepository
{
    /**
     * @return mixed
     */
    public function getDashboardAssociatedData()
    {
        $data['totalUsers'] = User::count();
        $data['totalCandidates'] = User::whereOwnerType(Candidate::class)->count();
        $data['totalEmployers'] = User::whereOwnerType(Company::class)->count();
        $data['totalActiveJobs'] = Job::whereStatus(1)->without(['country', 'state', 'city'])->count();
        $data['totalVerifiedUsers'] = User::whereNotNull('is_verified')->count();
        $data['todayJobs'] = Job::without(['country', 'state', 'city'])->whereDate('created_at',
            Carbon::today())->count();
        $data['featuredJobs'] = Job::without(['country', 'state', 'city'])->has('activeFeatured')->count();
        $data['featuredEmployers'] = Company::has('activeFeatured')->count();
        $data['featuredJobsIncomes'] = Transaction::whereOwnerType(Job::class)->sum('amount');
        $data['featuredCompanysIncomes'] = Transaction::whereOwnerType(Company::class)->sum('amount');
        $data['subscriptionIncomes'] = Transaction::whereOwnerType(Subscription::class)->sum('amount');

        return $data;
    }

    /**
     * @param $input
     *
     * @return array
     */
    public function getWeeklyChartData($input): array
    {
        try {
            $startDate = isset($input['start_date']) ? Carbon::parse($input['start_date']) : '';
            $endDate = isset($input['end_date']) ? Carbon::parse($input['end_date']) : '';
            $data = [];
            $employer = Company::whereHas('user', function (Builder $query) {
                $query->where('is_active', 1);
            })->addSelect([\DB::raw('DAY(created_at) as day,created_at')])
                ->addSelect([\DB::raw('Month(created_at) as month,created_at')])
                ->addSelect([\DB::raw('YEAR(created_at) as year,created_at')])
                ->orderBy('created_at')
                ->get();
            $candidate = Candidate::whereHas('user', function (Builder $query) {
                $query->where('is_active', 1);
            })->addSelect([\DB::raw('DAY(created_at) as day,created_at')])
                ->addSelect([\DB::raw('Month(created_at) as month,created_at')])
                ->addSelect([\DB::raw('YEAR(created_at) as year,created_at')])
                ->orderBy('created_at')
                ->get();
            $period = CarbonPeriod::create($startDate, $endDate);

            foreach ($period as $date) {
                $data['totalEmployerCount'][] = $employer->where('day', $date->format('d'))->where('month', $date->format('m'))->count();
                $data['totalCandidateCount'][] = $candidate->where('day', $date->format('d'))->where('month', $date->format('m'))->count();
                $data['weeklyLabels'][] = $date->format('d-m-y');
            }

            return $data;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param $input
     *
     * @return array
     */
    public function getPostStatisticsChartData($input): array
    {
        try {
            $startDate = isset($input['start_date']) ? Carbon::parse($input['start_date']) : '';
            $endDate = isset($input['end_date']) ? Carbon::parse($input['end_date']) : '';
            $data = [];
            $posts = Post::addSelect([\DB::raw('DAY(created_at) as day,created_at')])
                ->addSelect([\DB::raw('Month(created_at) as month,created_at')])
                ->addSelect([\DB::raw('YEAR(created_at) as year,created_at')])
                ->orderBy('created_at')
                ->get();

            $period = CarbonPeriod::create($startDate, $endDate);

            foreach ($period as $date) {
                $data['totalPostCount'][] = $posts->where('day', $date->format('d'))->where('month', $date->format('m'))->where('year', $date->format('Y'))->count();
                $data['weeklyPostLabels'][] = $date->format('d-m-y');
            }

            return $data;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @return mixed
     */
    public function getRegisteredCandidatesData()
    {
        return Candidate::with('user')->orderByDesc('created_at')->limit(5)->get();
    }

    /**
     * @return mixed
     */
    public function getRegisteredEmployersData()
    {
        return Company::with('user', 'activeFeatured')->orderByDesc('created_at')->limit(5)->get();
    }

    /**
     * @return mixed
     */
    public function getRecentJobsData()
    {
        return Job::with(['company', 'jobCategory', 'jobType', 'jobShift', 'activeFeatured'])->orderBy('created_at',
            'desc')->limit(5)->get();
    }

    /**
     * @return mixed
     */
    public function getEmployerDashboardData()
    {
        $user = Auth::user();
        $jobIds = Job::whereCompanyId($user->owner_id)->pluck('id');
        $data['jobApplicationsCount'] = JobApplication::whereIn('job_id', $jobIds)->count();
        $data['totalJobs'] = count($jobIds);
        $data['pausedJobCount'] = Job::whereCompanyId($user->owner_id)->where('status', Job::STATUS_PAUSED)->count();
        $data['closedJobCount'] = Job::whereCompanyId($user->owner_id)->where('status', Job::STATUS_CLOSED)->count();
        $data['jobCount'] = Job::whereCompanyId($user->owner_id)->where('status', Job::STATUS_OPEN)->count();
        $data['followersCount'] = FavouriteCompany::whereCompanyId($user->owner_id)->count();

        return $data;
    }

    /**
     * @return Job[]|Builder[]|Collection
     */
    public function getEmployerRecentJobsData()
    {
        $user = Auth::user();
        $jobs = Job::whereCompanyId($user->owner_id)->orderByDesc('created_at')->limit(5)->get();

        return $jobs;
    }

    /**
     * @return Builder[]|Collection
     */
    public function getEmployerRecentFollowerData()
    {
        $user = Auth::user();
        $followers = FavouriteCompany::with('user')->where('company_id',
            $user->owner_id)->orderByDesc('created_at')->limit(5)->get();

        return $followers;
    }

    /**
     * @param  string  $startDate
     * @param  string  $endDate
     *
     * @throws Exception
     * @return array
     */
    public function getDate($startDate, $endDate)
    {
        $dateArr = [];
        $subStartDate = '';
        $subEndDate = '';
        if (! ($startDate && $endDate)) {
            $data = [
                'dateArr'   => $dateArr,
                'startDate' => $subStartDate,
                'endDate'   => $subEndDate,
            ];

            return $data;
        }
        $end = trim(substr($endDate, 0, 10));
        $start = Carbon::parse($startDate)->toDateString();
        /** @var \Illuminate\Support\Carbon $startDate */
        $startDate = Carbon::createFromFormat('Y-m-d', $start);
        /** @var \Illuminate\Support\Carbon $endDate */
        $endDate = Carbon::createFromFormat('Y-m-d', $end);

        while ($startDate <= $endDate) {
            $dateArr[] = $startDate->copy()->format('Y-m-d');
            $startDate->addDay();
        }
        $start = current($dateArr);
        $endDate = end($dateArr);
        $subStartDate = Carbon::parse($start)->startOfDay()->format('Y-m-d H:i:s');
        $subEndDate = Carbon::parse($endDate)->endOfDay()->format('Y-m-d H:i:s');

        $data = [
            'dateArr'   => $dateArr,
            'startDate' => $subStartDate,
            'endDate'   => $subEndDate,
        ];

        return $data;
    }

    /**
     * @param  array  $input
     *
     * @return mixed
     */
    public function getEmployerDashboardChartData($input = [])
    {
        $dateS = Carbon::parse($input['start_date']);
        $dateE = Carbon::parse($input['end_date']);
        $jobTitleId = $input['job_status'];
        $gender = $input['gender'];
        $user = getLoggedInUser();
        $jobIds = Job::where('company_id', $user->owner_id)->when($jobTitleId, function (Builder $query) use ($jobTitleId) {
            $query->where('id', $jobTitleId);
        })->pluck('id');

        $jobApplications = JobApplication::when($gender != '', function (Builder $query) use ($gender) {
            $query->whereHas('candidate.user', function (Builder $query) use ($gender) {
                $query->where('gender', '=', $gender);
            });
        })->whereIn('job_id', $jobIds)->whereBetween('created_at',
            [$dateS->format('Y-m-d').' 00:00:00', $dateE.' 23:59:59'])
            ->groupBy('date')
            ->orderBy('date')
            ->get([
                DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as date'),
                DB::raw('count(*) as total'),
            ])
            ->keyBy('date')
            ->map(function ($item) {
                $item->date = Carbon::parse($item->date);

                return $item;
            });
        $period = CarbonPeriod::create($dateS, $dateE);

        // get all date labels
        $labelsData = array_map(function ($datePeriod) {
            return $datePeriod->format('M d');
        }, iterator_to_array($period));

        // get all job Application in date period
        $jobApplicationData = array_map(function ($datePeriod) use ($jobApplications) {
            $date = $datePeriod->format('Y-m-d');

            return $jobApplications->has($date) ? $jobApplications->get($date)->total : 0;
        }, iterator_to_array($period));

        $data['jobApplicationCounts'] = $jobApplicationData;
        $data['dateLabels'] = $labelsData;

        return $data;
    }
}
