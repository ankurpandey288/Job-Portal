<?php

namespace App\Http\Controllers\Candidates;

use App\Http\Controllers\AppBaseController;
use App\Models\Candidate;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends AppBaseController
{
    /**
     * @return Factory|View
     */
    public function dashboard()
    {
        /** @var User $user */
        $user = Auth::user();
        $candidate = Candidate::findOrFail($user->owner_id);
        $data['resumes'] = $candidate->getMedia(Candidate::RESUME_PATH)->count();
        $data['candidate'] = $candidate;
        $data['followings'] = $user->followings()->count();
        $data['user'] = $user;

        return view('candidate.dashboard.dashboard')->with($data);
    }
}
