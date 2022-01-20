<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateEmployerProfileRequest;
use App\Models\Company;
use App\Repositories\UserRepository;
use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Laracasts\Flash\Flash;

/**
 * Class EmployerController
 */
class EmployerController extends AppBaseController
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
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
            $user = $this->userRepository->changePassword($input);

            return $this->sendSuccess('Password updated successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 422);
        }
    }

    /**
     * @param  UpdateEmployerProfileRequest  $request
     *
     * @return JsonResponse
     */
    public function profileUpdate(UpdateEmployerProfileRequest $request)
    {
        $input = $request->all();

        try {
            $employer = $this->userRepository->profileUpdate($input);
            Flash::success('Employer Profile updated successfully.');

            return $this->sendResponse($employer, 'Employer Profile updated successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 422);
        }
    }

    /**
     * Show the form for editing the specified User.
     *
     * @return JsonResponse
     */
    public function editProfile()
    {
        $user = Auth::user();
        $data['employer'] = $user;
        $data['company'] = Company::where('user_id', $user->id)->first();

        return $this->sendResponse($data, 'Employer retrieved successfully.');
    }
}
