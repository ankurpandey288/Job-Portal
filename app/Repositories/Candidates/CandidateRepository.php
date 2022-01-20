<?php

namespace App\Repositories\Candidates;

use App\Models\Candidate;
use App\Models\CandidateEducation;
use App\Models\CandidateExperience;
use App\Models\CareerLevel;
use App\Models\FunctionalArea;
use App\Models\Industry;
use App\Models\JobType;
use App\Models\Language;
use App\Models\MaritalStatus;
use App\Models\SalaryCurrency;
use App\Models\Skill;
use App\Models\User;
use App\ReportedToCandidate;
use App\Repositories\BaseRepository;
use Arr;
use Auth;
use Carbon\Carbon;
use DB;
use Exception;
use Hash;
use Illuminate\Validation\ValidationException;
use PragmaRX\Countries\Package\Countries;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Models\Role;
use Str;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Throwable;

/**
 * Class CandidateRepository
 * @version July 20, 2020, 5:48 am UTC
 */
class CandidateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'father_name',
        'marital_status_id',
        'national_id_card',
        'experience',
        'career_level_id',
        'industry_id',
        'functional_area_id',
        'current_salary',
        'expected_salary',
        'immediate_available',
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
        return Candidate::class;
    }

    /**
     * @return mixed
     */
    public function prepareData()
    {
        $countries = new Countries();
        $data['countries'] = getCountries();
        $data['maritalStatus'] = MaritalStatus::toBase()->pluck('marital_status', 'id');
        $data['careerLevel'] = CareerLevel::toBase()->pluck('level_name', 'id');
        $data['industry'] = Industry::toBase()->pluck('name', 'id');
        $data['functionalArea'] = FunctionalArea::toBase()->pluck('name', 'id');
        $data['skills'] = Skill::toBase()->pluck('name', 'id');
        $data['language'] = Language::toBase()->pluck('language', 'id');
        $data['currency'] = SalaryCurrency::toBase()->pluck('currency_name', 'id');

        return $data;
    }

    /**
     * @return mixed
     */
    public function getUniqueCandidateId()
    {
        $candidateUniqueId = Str::random(12);
        while (true) {
            $isExist = Candidate::whereUniqueId($candidateUniqueId)->exists();
            if ($isExist) {
                self::getUniqueCandidateId();
            }
            break;
        }

        return $candidateUniqueId;
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
            $input['is_active'] = isset($input['is_active']) ? 1 : 0;
            $input['is_verified'] = isset($input['is_verified']) ? 1 : 0;
            $input['password'] = Hash::make($input['password']);
            $input['dob'] = (! empty($input['dob'])) ? $input['dob'] : null;
            $input['current_salary'] = removeCommaFromNumbers($input['current_salary']);
            $input['expected_salary'] = removeCommaFromNumbers($input['expected_salary']);
            $input['unique_id'] = $this->getUniqueCandidateId();
            $candidateRole = Role::whereName('Candidate')->first();
            /** @var User $user */
            $user = User::create(Arr::only($input, (new User())->getFillable()));

            $candidate = Candidate::create(
                array_merge(array_filter(Arr::only($input, (new Candidate())->getFillable())),
                    ['user_id' => $user->id])
            );
            $candidate->update(['immediate_available' => $input['immediate_available']]);

            $ownerId = $candidate->id;
            $ownerType = Candidate::class;

            $user->update(['owner_id' => $ownerId, 'owner_type' => $ownerType]);
            $user->assignRole($candidateRole);

            //Update Candidate Skills
            if (isset($input['candidateSkills']) && ! empty($input['candidateSkills'])) {
                $user->candidateSkill()->sync($input['candidateSkills']);
            }

            //update Candidate Languages
            if (isset($input['candidateLanguage']) && ! empty($input['candidateLanguage'])) {
                $user->candidateLanguage()->sync($input['candidateLanguage']);
            }

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

        return true;
    }

    /**
     * @param  array  $input
     *
     * @throws Throwable
     *
     * @return bool
     */
    public function updateProfile($input)
    {
        try {
            DB::beginTransaction();
            $input['dob'] = (! empty($input['dob'])) ? $input['dob'] : null;
            $input['current_salary'] = removeCommaFromNumbers($input['current_salary']);
            $input['expected_salary'] = removeCommaFromNumbers($input['expected_salary']);

            /** @var User $user */
            $user = Auth::user();

            $userInput = Arr::only($input,
                [
                    'first_name', 'last_name', 'email', 'password', 'phone',
                    'country_id', 'state_id', 'city_id', 'gender', 'dob', 'facebook_url', 'twitter_url', 'linkedin_url',
                    'pinterest_url', 'google_plus_url', 'region_code',
                ]);

            $user->update($userInput);

            if ((isset($input['image']))) {
                $user->clearMediaCollection(User::PROFILE);
                $user->addMedia($input['image'])
                    ->toMediaCollection(User::PROFILE, config('app.media_disc'));
            }

            $input['available_at'] = $input['immediate_available'] == 0 ? $input['available_at'] : null;
            $user->candidate->update($input);

            //Update Candidate Skills
            if (isset($input['candidateSkills']) && ! empty($input['candidateSkills'])) {
                $user->candidateSkill()->sync($input['candidateSkills']);
            }

            //update Candidate Languages
            if (isset($input['candidateLanguage']) && ! empty($input['candidateLanguage'])) {
                $user->candidateLanguage()->sync($input['candidateLanguage']);
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
     *
     * @throws Throwable
     *
     * @return bool
     */
    public function updateGeneralInformation($input)
    {
        try {
            DB::beginTransaction();
            /** @var User $user */
            $user = Auth::user();
            $userInput = Arr::only($input, [
                'first_name', 'last_name', 'country_id', 'state_id', 'city_id', 'phone', 'facebook_url',
                'twitter_url',
                'linkedin_url',
                'google_plus_url',
                'pinterest_url',
            ]);
            $user->update($userInput);
            $user->candidate->update($input);
            //Update Candidate Skills
            if (isset($input['candidateSkills']) && ! empty($input['candidateSkills'])) {
                $user->candidateSkill()->sync($input['candidateSkills']);
            }
            DB::commit();

            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     *
     * @return bool
     */
    public function uploadResume($input)
    {
        try {
            $user = Auth::user();
            /** @var Candidate $candidate */
            $candidate = Candidate::findOrFail($user->candidate->id);
            $input['is_default'] = isset($input['is_default']) ? true : false;
            if ($input['is_default']) {
               $media = Media::where('model_type', '=', Candidate::class)->where('model_id', '=', $candidate->id)->where('custom_properties->is_default', '=', true)->first();
               if (isset($media)) {
                   throw new BadRequestHttpException(
                       'Default Resume already been uploaded.',
                       null,
                       \Illuminate\Http\Response::HTTP_BAD_REQUEST
                   );
               }
            }

            $fileExtension = getFileName('download', $input['file']);
            $candidate->addMedia($input['file'])
                ->withCustomProperties([
                    'is_default' => $input['is_default'],
                    'title'      => $input['title'],
                ])->usingFileName($fileExtension)->toMediaCollection(Candidate::RESUME_PATH, config('app.media_disc'));

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  Candidate  $candidate
     * @param  array  $input
     *
     * @return bool
     */
    public function updateCandidate($candidate, $input)
    {
        unset($input['password']);

        $input['is_active'] = isset($input['is_active']) ? 1 : 0;
        $input['is_verified'] = isset($input['is_verified']) ? 1 : 0;
        $input['dob'] = (! empty($input['dob'])) ? $input['dob'] : null;
        $input['state'] = (! empty($input['state'])) ? $input['state'] : null;
        $input['city'] = (! empty($input['city'])) ? $input['city'] : null;
        $input['current_salary'] = removeCommaFromNumbers($input['current_salary']);
        $input['expected_salary'] = removeCommaFromNumbers($input['expected_salary']);
        $input['available_at'] = $input['immediate_available'] == 0 ? $input['available_at'] : null;

        /** @var User $user */
        $user = $candidate->user;

        /* @var Candidate $candidate */
        $user->update($input);
        $candidate->update($input);

        //Update Candidate Skills
        if (isset($input['candidateSkills']) && ! empty($input['candidateSkills'])) {
            $user->candidateSkill()->sync($input['candidateSkills']);
        }

        //update Candidate Languages
        if (isset($input['candidateLanguage']) && ! empty($input['candidateLanguage'])) {
            $user->candidateLanguage()->sync($input['candidateLanguage']);
        }

        return true;
    }

    /**
     * @param  array  $input
     *
     * @return bool
     */
    public function changePassword($input)
    {
        try {
            /** @var User $user */
            $user = Auth::user();
            if (! Hash::check($input['password_current'], $user->password)) {
                throw new UnprocessableEntityHttpException('Current password is invalid.');
            }
            $input['password'] = Hash::make($input['password']);
            $user->update($input);

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     *
     * @return bool
     */
    public function profileUpdate($input)
    {
        /** @var User $user */
        $user = Auth::user();

        try {
            $user->update($input);
            if ((isset($input['image']))) {
                $user->clearMediaCollection(User::PROFILE);
                $user->addMedia($input['image'])
                    ->toMediaCollection(User::PROFILE, config('app.media_disc'));
            }

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param $candidate
     *
     * @return mixed
     */
    public function getCandidateDetail($candidate)
    {
        $candidateDetails = Candidate::with('user', 'functionalArea')->findOrFail($candidate);
        // update profile views count
        if ($candidateDetails->user->id != getLoggedInUserId()) {
            $candidateDetails->user->increment('profile_views');
        }
        $data['isReportedToCandidate'] = $this->isAlreadyReported($candidate);
        $data['candidateDetails'] = $candidateDetails;
        $data['candidateExperiences'] = CandidateExperience::where('candidate_id', $candidate)->get();
        foreach ($data['candidateExperiences'] as $experience) {
            $experience->country_name = getCountryName($experience->country_id);
        }
        $data['candidateEducations'] = CandidateEducation::with('degreeLevel')->where('candidate_id',
            $candidate)->get();
        foreach ($data['candidateEducations'] as $education) {
            $education->country_name = getCountryName($education->country_id);
        }

        return $data;
    }

    /**
     * @param $companyId
     *
     * @return mixed
     */
    public function isAlreadyReported($candidateId)
    {
        return ReportedToCandidate::where('user_id', Auth::id())
            ->where('candidate_id', $candidateId)
            ->exists();
    }

    public function storeReportCandidate($input)
    {
        $candidateReportedAsAbuse = ReportedToCandidate::where('user_id', $input['userId'])
            ->where('candidate_id', $input['candidateId'])
            ->exists();

        if (! $candidateReportedAsAbuse) {
            $reportedCandidateNote = trim($input['note']);
            if (empty($reportedCandidateNote)) {
                throw ValidationException::withMessages([
                    'note' => 'The Note Field is required',
                ]);
            }
            ReportedToCandidate::create([
                'user_id'      => $input['userId'],
                'candidate_id' => $input['candidateId'],
                'note'         => $input['note'],
            ]);

            return true;
        }

        return true;
    }

    /**
     * @param $reportedToCandidate
     *
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getReportedToCandidate($reportedToCandidate)
    {
        $query = ReportedToCandidate::with([
            'user', 'candidate.user',
        ])->select('reported_to_candidates.*')->findOrFail($reportedToCandidate);

        return $query;
    }

    /**
     * @return mixed
     */
    public function getJobAlerts()
    {
        $candidate = Candidate::with('jobAlerts')->whereUserId(Auth::id())->first();
        $data['jobTypes'] = JobType::all();
        $data['jobAlerts'] = $candidate->jobAlerts()->pluck('job_type_id')->toArray();
        $data['candidate'] = $candidate;

        return $data;
    }

    /**
     * @param $input
     *
     * @return bool
     */
    public function updateJobAlerts($input)
    {
        $candidate = Candidate::with('jobAlerts')->whereUserId(Auth::id())->first();
        try {
            $candidate->job_alert = (isset($input['job_alert'])) ? 1 : 0;
            $candidate->update();

            if (isset($input['job_types']) && ! empty($input['job_types'])) {
                $candidate->jobAlerts()->sync($input['job_types']);
            } else {
                $candidate->jobAlerts()->sync([]);
            }

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
