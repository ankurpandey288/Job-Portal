<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Repositories\PrivacyPolicyRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Laracasts\Flash\Flash;

/**
 * Class PrivacyPolicyController
 */
class PrivacyPolicyController extends AppBaseController
{
    /** @var PrivacyPolicyRepository */
    private $privacyPolicyRepository;

    /**
     * PrivacyPolicyController constructor.
     * @param  PrivacyPolicyRepository  $privacyPolicyRepository
     */
    public function __construct(PrivacyPolicyRepository $privacyPolicyRepository)
    {
        $this->privacyPolicyRepository = $privacyPolicyRepository;
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
        $privacyPolicy = Setting::pluck('value', 'key')->toArray();
        $sectionName = ($request->section === null) ? 'privacy_policy' : $request->section;

        return view("privacy_policy.$sectionName", compact('privacyPolicy', 'sectionName'));
    }

    /**
     * @param  Request  $request
     *
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $input = $request->all();
        foreach ($input as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }

        Flash::success('Policy updated successfully.');

        return Redirect::back();
    }
}
