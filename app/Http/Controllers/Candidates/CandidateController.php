<?php

namespace App\Http\Controllers\Candidates;

use App;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CandidateUpdateGeneralInformationRequest;
use App\Http\Requests\CandidateUpdateOnlineProfileRequest;
use App\Http\Requests\CandidateUpdateProfileRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateCandidateProfileRequest;
use App\Models\Candidate;
use App\Models\CandidateEducation;
use App\Models\CandidateExperience;
use App\Models\CandidateLanguage;
use App\Models\CandidateSkill;
use App\Models\JobApplication;
use App\Models\JobApplicationSchedule;
use App\Models\RequiredDegreeLevel;
use App\Models\User;
use App\Queries\CandidateAppliedJobDataTable;
use App\Queries\FavouriteCompanyDataTable;
use App\Queries\FavouriteJobDataTable;
use App\Repositories\Candidates\CandidateRepository;
use Auth;
use Carbon\Carbon;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use function PHPUnit\Framework\isEmpty;

class CandidateController extends AppBaseController
{
    /** @var CandidateRepository */
    private $candidateRepository;

    /**
     * CandidateController constructor.
     * @param  CandidateRepository  $candidateRepo
     */
    public function __construct(CandidateRepository $candidateRepo)
    {
        $this->candidateRepository = $candidateRepo;
    }

    /**
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View
     */
    public function editProfile(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $user->phone = preparePhoneNumber($user->phone, $user->region_code);
        $data = $this->candidateRepository->prepareData();
        $countries = getCountries();
        $states = $cities = null;
        if (! empty($user->country_id)) {
            $states = getStates($user->country_id);
        }
        if (isset($user->state_id)) {
            $cities = getCities($user->state_id);
        }
        $candidateSkills = $user->candidateSkill()->pluck('skill_id')->toArray();
        $candidateLanguage = $user->candidateLanguage()->pluck('language_id')->toArray();
        $sectionName = ($request->section === null) ? 'general' : $request->section;
        $data['sectionName'] = $sectionName;

        if ($sectionName == 'resumes') {
            /** @var Candidate $candidate */
            $candidate = Candidate::findOrFail($user->candidate->id);

            $data['resumes'] = $candidate->getMedia('resumes');
        }

        if ($sectionName == 'career_informations' || $sectionName == 'cv_builder') {
            $data['candidateExperiences'] = CandidateExperience::where('candidate_id',
                $user->owner_id)->orderByDesc('id')->get();
            foreach ($data['candidateExperiences'] as $experience) {
                $experience->country = getCountryName($experience->country_id);
            }
            $data['candidateEducations'] = CandidateEducation::with('degreeLevel')->where('candidate_id',
                $user->owner_id)->orderByDesc('id')->get();
            foreach ($data['candidateEducations'] as $education) {
                $education->country = getCountryName($education->country_id);
            }
            $data['degreeLevels'] = RequiredDegreeLevel::pluck('name', 'id');
        }

        return view("candidate.profile.$sectionName",
            compact('user', 'data', 'countries', 'states', 'cities', 'candidateSkills', 'candidateLanguage'));
    }

    /**
     * @throws Exception
     *
     * @return mixed
     */
    public function showFavouriteJobs()
    {
        return view('candidate.favourite_jobs.index');
    }

    /**
     * @param  CandidateUpdateProfileRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function updateProfile(CandidateUpdateProfileRequest $request)
    {
        $this->candidateRepository->updateProfile($request->all());

        Flash::success('Candidate profile updated successfully.');

        return redirect(route('candidate.profile'));
    }

    /**
     * @param  CandidateUpdateGeneralInformationRequest  $request
     *
     * @throws \Throwable
     *
     * @return JsonResponse
     */
    public function updateGeneralInformation(CandidateUpdateGeneralInformationRequest $request)
    {
        $user = $this->candidateRepository->updateGeneralInformation($request->all());
        $user['candidateSkill'] = $user->candidateSkill()->pluck('name')->toArray();

        return $this->sendResponse($user, 'Candidate profile updated successfully.');
    }

    /**
     * @param  CandidateUpdateOnlineProfileRequest  $request
     *
     * @throws \Throwable
     *
     * @return JsonResponse
     */
    public function updateOnlineProfile(CandidateUpdateOnlineProfileRequest $request)
    {
        $user = $this->candidateRepository->updateGeneralInformation($request->all());
        $user['onlineProfileLayout'] = view('candidate.profile.career_informations.show_online_profile',
            compact('user'))->render();
        $user['editonlineProfileLayout'] = view('candidate.profile.career_informations.edit_online_profile',
            compact('user'))->render();

        return $this->sendResponse($user, 'Candidate profile updated successfully.');
    }

    /**
     * @throws \Throwable
     *
     * @return array|string
     */
    public function getCVTemplate()
    {
        $user = Auth::user();
        $data['user'] = $user;
        $data['candidateExperiences'] = CandidateExperience::where('candidate_id',
            $user->owner_id)->orderByDesc('id')->get();
        foreach ($data['candidateExperiences'] as $experience) {
            $experience->country = getCountryName($experience->country_id);
        }
        $data['candidateEducations'] = CandidateEducation::with('degreeLevel')->where('candidate_id',
            $user->owner_id)->orderByDesc('id')->get();
        foreach ($data['candidateEducations'] as $education) {
            $education->country = getCountryName($education->country_id);
        }

        return view('candidate.profile.cv_template')->with($data)->render();
    }

    /**
     * @param  Request  $request
     *
     * @return mixed
     */
    public function uploadResume(Request $request)
    {
        $input = $request->all();

        $this->candidateRepository->uploadResume($input);

        return $this->sendSuccess('Resume updated successfully.');
    }

    /**
     * @param  int  $media
     *
     * @return Media
     */
    public function downloadResume($media)
    {
        /** @var Media $mediaItem */
        $mediaItem = Media::findOrFail($media);

        return $mediaItem;
    }

    /**
     * @throws Exception
     *
     * @return mixed
     */
    public function showFavouriteCompanies()
    {
        return view('candidate.favourite_companies.index');
    }

    /**
     * @return Factory|View
     */
    public function editJobAlert()
    {
        $data = $this->candidateRepository->getJobAlerts();

        return view('candidate.job_alert.edit')->with($data);
    }

    /**
     * @param  Request  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function updateJobAlert(Request $request)
    {
        $this->candidateRepository->updateJobAlerts($request->all());
        Flash::success('Job Alert updated successfully.');

        return redirect(route('candidate.job.alert'));
    }

    /**
     * @param  ChangePasswordRequest  $request
     *
     * @return JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $input = $request->all();

        try {
            $user = $this->candidateRepository->changePassword($input);

            return $this->sendSuccess('Password updated successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 422);
        }
    }

    /**
     * Show the form for editing the specified User.
     *
     * @return JsonResponse
     */
    public function editCandidateProfile()
    {
        $user = User::with('candidate')->where('id', '=', Auth::id())->first();

        return $this->sendResponse($user, 'Candidate retrieved successfully.');
    }

    /**
     * @param  UpdateCandidateProfileRequest  $request
     *
     * @return JsonResponse
     */
    public function profileUpdate(UpdateCandidateProfileRequest $request)
    {
        $input = $request->all();

        try {
            $employer = $this->candidateRepository->profileUpdate($input);
            Flash::success('Candidate Profile updated successfully.');

            return $this->sendResponse($employer, 'Candidate Profile updated successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 422);
        }
    }

    /**
     * @throws Exception
     *
     * @return mixed
     */
    public function showCandidateAppliedJob()
    {
        return view('candidate.applied_job.index');
    }

    /**
     * @param  Media  $media
     *
     * @throws Exception
     *
     * @return mixed
     */
    public function deletedResume(Media $media)
    {
        $media->delete();

        return $this->sendSuccess('Media deleted successfully.');
    }

    /**
     * @param  JobApplication  $jobApplication
     *
     * @return mixed
     */
    public function showAppliedJobs(JobApplication $jobApplication)
    {
        return $this->sendResponse($jobApplication, 'Retrieved successfully.');
    }

    /**
     * @param  JobApplication  $jobApplication
     *
     * @return JsonResponse
     */
    public function showScheduleSlotBook(JobApplication $jobApplication)
    {
        /** @var JobApplicationSchedule $jobApplicationSchedules */
        $jobApplicationSchedules = JobApplicationSchedule::with(['jobApplication.job.company' => function($query) {
            $query->without('job.company.user.city', 'job.company.user.state', 'job.company.user.country', 'job.company.user.media');
        }])->whereJobApplicationId($jobApplication->id);


        /** @var JobApplication $job */
        $job = JobApplication::with(['candidate.user' => function($query) {
            $query->without('user.media', 'user.city', 'user.state', 'user.country');
        }])->without('job')->whereId($jobApplication->id)->first();
        $data = [];

        foreach ($jobApplicationSchedules->get() as $jobApplicationSchedule)
        {
            $data[] = array(
                'notes' => !empty($jobApplicationSchedule->notes) ? $jobApplicationSchedule->notes : __('messages.job_stage.new_slot_send'),
                'company_name' => $jobApplicationSchedule->jobApplication->job->company->user->full_name,
                'schedule_created_at' => Carbon::parse($jobApplicationSchedule->created_at)->format('jS M Y, h:m A'),
            );
        }
        $lastRecord = $jobApplicationSchedules->latest()->first();
        $data['rejectedSlot'] = $lastRecord->status == JobApplicationSchedule::STATUS_REJECTED;

        $allJobSchedule = JobApplicationSchedule::whereJobApplicationId($jobApplication->id)
            ->where('batch', $lastRecord->batch)
            ->where('stage_id', $lastRecord->stage_id)
            ->get();

        if (!($allJobSchedule->whereIn('status', JobApplicationSchedule::STATUS_SEND)->count() > 0)) {
            foreach ($allJobSchedule as $jobApplicationSchedule)
            {
                if ($jobApplicationSchedule->status == JobApplicationSchedule::STATUS_NOT_SEND) {
                    $data[] = array(
                        'notes'           => ! empty($jobApplicationSchedule->notes) ? $jobApplicationSchedule->notes : __('messages.job_stage.new_slot_send'),
                        'schedule_date'   => Carbon::parse($jobApplicationSchedule->date)->format('jS M Y'),
                        'schedule_time'   => $jobApplicationSchedule->time,
                        'job_Schedule_Id' => $jobApplicationSchedule->id,
                        'isAllRejected'   => $jobApplicationSchedule->status == JobApplicationSchedule::STATUS_REJECTED,
                    );
                }
            }
        }
        $data['selectSlot'] = $allJobSchedule->whereIn('status', JobApplicationSchedule::STATUS_SEND)->toArray();
        $employerCancelNote = $allJobSchedule->where('employer_cancel_slot_notes')->first();
        $data['employer_cancel_note'] = isset($employerCancelNote) ? $employerCancelNote->employer_cancel_slot_notes : '';
        $data['employer_fullName'] = $job->candidate->user->full_name;
        $data['isSlotRejected'] = $jobApplicationSchedules->where('status', JobApplicationSchedule::STATUS_REJECTED)->count();
        $data['scheduleSelect'] = $allJobSchedule->where('status', JobApplicationSchedule::STATUS_SEND)->count();

        return $this->sendResponse($data, 'job schedule send successfully');
    }

    /**
     * @param  JobApplication  $jobApplication
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function choosePreference(JobApplication $jobApplication, Request $request)
    {
        if (!isset($request->rejectSlot)) {
            $request->validate([
                'slot_book' => 'required',
            ], [
                'slot_book.required' => 'Slot Preference Field is required'
            ]);
        }

        $request->validate([
            'choose_slot_notes' => 'required',
        ], [
            'choose_slot_notes.required' => 'Notes Field is required'
        ]);
        $scheduleId = $request->get('schedule_id');
        $slotNotes = $request->get('choose_slot_notes');
        if (!isset($request->rejectSlot)) {
            JobApplicationSchedule::whereId($scheduleId)->update(['status' => JobApplicationSchedule::STATUS_SEND, 'rejected_slot_notes' => $slotNotes]);
        } else {
            $jobApplicationSchedules = JobApplicationSchedule::whereJobApplicationId($jobApplication->id);
            $lastRecord = $jobApplicationSchedules->latest()->first();
            $allJobSchedule = JobApplicationSchedule::where('batch', $lastRecord->batch)
                ->whereIn('status', [JobApplicationSchedule::STATUS_NOT_SEND])
                ->get();
            foreach ($allJobSchedule as $schedule)
            {
                $schedule->update([
                    'status' => JobApplicationSchedule::STATUS_REJECTED,
                    'rejected_slot_notes' => $slotNotes
                ]);
            }
        }

        if (isset($request->rejectSlot)) {
            return $this->sendSuccess('Slots rejected successfully');
        }

        return $this->sendSuccess('Slot choose successfully');
    }
}
