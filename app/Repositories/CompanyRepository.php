<?php

namespace App\Repositories;

use App\Models\Company;
use App\Models\CompanySize;
use App\Models\FavouriteCompany;
use App\Models\Industry;
use App\Models\Job;
use App\Models\Notification;
use App\Models\NotificationSetting;
use App\Models\OwnerShipType;
use App\Models\ReportedToCompany;
use App\Models\User;
use Arr;
use Auth;
use Carbon\Carbon;
use DB;
use Exception;
use Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
use PragmaRX\Countries\Package\Countries;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Throwable;

/**
 * Class CompanyRepository
 * @version June 22, 2020, 12:34 pm UTC
 */
class CompanyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ceo',
        'established_in',
        'website',
        'is_active',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Company::class;
    }

    /**
     * @return mixed
     */
    public function prepareData()
    {
        $countries = new Countries();
        $data['industries'] = Industry::pluck('name', 'id');
        $data['ownerShipTypes'] = OwnerShipType::pluck('name', 'id');
        $data['companySize'] = CompanySize::pluck('size', 'id');
        $data['countries'] = getCountries();

        return $data;
    }

    /**
     * @param  array  $input
     *
     * @throws Throwable
     *
     * @return bool
     */
    public function store($input)
    {
        try {
            DB::beginTransaction();
            $input['unique_id'] = getUniqueCompanyId();
            $company = $this->create(Arr::only($input, (new Company())->getFillable()));

            // Create User
            $input['password'] = Hash::make($input['password']);
            $input['first_name'] = $input['name'];
            $input['owner_id'] = $company->id;
            $input['owner_type'] = Company::class;
            $input['is_verified'] = isset($input['is_verified']) ? 1 : 0;
            $userInput = Arr::only($input,
                [
                    'first_name', 'email', 'phone', 'password', 'owner_id', 'owner_type', 'country_id', 'state_id',
                    'city_id', 'is_active', 'dob', 'gender',
                    'facebook_url', 'twitter_url', 'linkedin_url', 'google_plus_url', 'pinterest_url', 'is_verified',
                    'region_code',
                ]);

            /** @var User $user */
            $user = User::create($userInput);
            $companyRole = Role::whereName('Employer')->first();
            $user->assignRole($companyRole);
            $company->update(['user_id' => $user->id]);

            if ((isset($input['image']))) {
                $user->addMedia($input['image'])
                    ->toMediaCollection(User::PROFILE, config('app.media_disc'));
            }

            /** @var SubscriptionRepository $subscriptionRepo */
            $subscriptionRepo = app(SubscriptionRepository::class);
            $subscriptionRepo->createStripeCustomer($user);

            if ($user->is_verified) {
                $user->update(['email_verified_at' => Carbon::now()]);
            } else {
                $user->sendEmailVerificationNotification();
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     * @param  Company  $company
     *
     * @throws Throwable
     *
     * @return bool|Builder|Builder[]|Collection|Model
     */
    public function update($input, $company)
    {
        try {
            DB::beginTransaction();

            $company->update($input);

            $input['first_name'] = $input['name'];
            $userInput = Arr::only($input,
                [
                    'first_name', 'email', 'phone', 'password', 'country_id', 'state_id', 'city_id', 'is_active',
                    'facebook_url', 'twitter_url', 'linkedin_url', 'google_plus_url', 'pinterest_url', 'region_code',
                ]);
            /** @var User $user */
            $user = $company->user;
            $user->phone = preparePhoneNumber($user->phone, $user->region_code);
            $user->update($userInput);

            if ((isset($input['image']))) {
                $user->clearMediaCollection(User::PROFILE);
                $user->addMedia($input['image'])
                    ->toMediaCollection(User::PROFILE, config('app.media_disc'));
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param $companyId
     *
     * @return mixed
     */
    public function isCompanyAddedToFavourite($companyId)
    {
        return FavouriteCompany::where('user_id', Auth::id())
            ->where('company_id', $companyId)
            ->exists();
    }

    /**
     * @param $companyId
     *
     * @return mixed
     */
    public function isReportedToCompany($companyId)
    {
        return ReportedToCompany::where('user_id', Auth::id())
            ->where('company_id', $companyId)
            ->exists();
    }

    /**
     * @param $companyId
     *
     * @return mixed
     */
    public function getCompanyDetail($companyId)
    {
        $data['companyDetail'] = Company::with('user')->findOrFail($companyId);
        $data['jobDetails'] = Job::with('jobShift', 'company', 'jobCategory')->where('company_id', $companyId)->get();
        $data['isCompanyAddedToFavourite'] = $this->isCompanyAddedToFavourite($companyId);
        $data['isReportedToCompany'] = $this->isReportedToCompany($companyId);

        return $data;
    }

    /**
     * @param  array  $input
     * @throws Exception
     *
     * @return bool
     */
    public function storeFavouriteJobs($input)
    {
        $favouriteJob = FavouriteCompany::where('user_id', $input['userId'])
            ->where('company_id', $input['companyId'])
            ->exists();
        if (! $favouriteJob) {
            $companyUser = User::findOrFail(Company::findOrFail($input['companyId'])->user_id);
            FavouriteCompany::create([
                'user_id'    => $input['userId'],
                'company_id' => $input['companyId'],
            ]);
            $user = getLoggedInUser();
            NotificationSetting::whereKey(Notification::FOLLOW_COMPANY)->first()->value == 1 ?
                addNotification([
                    Notification::FOLLOW_COMPANY,
                    $companyUser->id,
                    Notification::EMPLOYER,
                    $user->first_name.' '.$user->last_name.' started following You.',
                ]) : false;

            return true;
        }

        FavouriteCompany::where('user_id', $input['userId'])
            ->where('company_id', $input['companyId'])
            ->delete();

        return false;
    }

    /**
     * @param  array  $input
     *
     *
     * @return bool
     */
    public function storeReportToCompany($input)
    {
        $jobReportedAsAbuse = ReportedToCompany::where('user_id', $input['userId'])
            ->where('company_id', $input['companyId'])
            ->exists();

        if (! $jobReportedAsAbuse) {
            $reportedCompanyNote = trim($input['note']);
            if (empty($reportedCompanyNote)) {
                throw ValidationException::withMessages([
                    'note' => 'The Note Field is required',
                ]);
            }
            ReportedToCompany::create([
                'user_id' => $input['userId'],
                'company_id' => $input['companyId'],
                'note' => $input['note'],
            ]);

            return true;
        }

        FavouriteCompany::where('user_id', $input['userId'])
            ->where('company_id', $input['companyId'])
            ->delete();

        return true;
    }

    /**
     * @param $reportedToCompany
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getReportedToCompany($reportedToCompany)
    {
        $query = ReportedToCompany::with([
            'user', 'company.user',
        ])->select('reported_to_companies.*')->findOrFail($reportedToCompany);

        return $query;
    }

    public function get($input = [])
    {
        /** @var Company $query */
        $query = Company::with(['user' => function($query) {
            $query->without(['country', 'state', 'city']);
        }, 'activeFeatured'])->select('companies.*');

        $query->when(isset($input['is_featured']) && $input['is_featured'] == 1,
            function (Builder $q) use ($input) {
                $q->has('activeFeatured');
            });

        $query->when(isset($input['is_featured']) && $input['is_featured'] == 0,
            function (Builder $q) use ($input) {
                $q->doesnthave('activeFeatured');
            });

        $query->when(isset($input['is_status']) && $input['is_status'] == 1,
            function (Builder $q) use ($input) {
                $q->wherehas('user', function (Builder $q) {
                    $q->where('is_active', '=', 1);
                });
            });

        $query->when(isset($input['is_status']) && $input['is_status'] == 0,
            function (Builder $q) use ($input) {
                $q->wherehas('user', function (Builder $q) {
                    $q->where('is_active', '=', 0);
                });
            });

        $subQuery = $query->get();

        $result = $data = [];
        $subQuery->map(function (Company $company) use ($data, &$result) {
            $data['id'] = $company->id;
            $data['user'] = [
                'full_name'         => $company->user->full_name,
                'first_name'        => $company->user->first_name,
                'last_name'         => $company->user->last_name,
                'email'             => $company->user->email,
                'is_active'         => $company->user->is_active,
                'email_verified_at' => $company->user->email_verified_at,
            ];
            $data['company_url'] = $company->company_url;
            $data['active_featured'] = $company->activeFeatured;

            $result[] = $data;
        });

        return $result;
    }
}
