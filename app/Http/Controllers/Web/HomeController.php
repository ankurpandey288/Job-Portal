<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\ContactFormRequest;
use App\Models\Company;
use App\Models\Job;
use App\Models\Skill;
use App\Repositories\WebHomeRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Laracasts\Flash\Flash;

class HomeController extends AppBaseController
{
    /** @var WebHomeRepository */
    private $homeRepository;

    public function __construct(WebHomeRepository $homeRepository)
    {
        $this->homeRepository = $homeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $data['testimonials'] = $this->homeRepository->getTestimonials();
        $data['dataCounts'] = $this->homeRepository->getDataCounts();
        $data['latestJobs'] = $this->homeRepository->getLatestJobs();
        $data['categories'] = $this->homeRepository->getCategories();
        $data['jobCategories'] = $this->homeRepository->getAllJobCategories();
        $data['featuredCompanies'] = $this->homeRepository->getFeaturedCompanies();
        $data['featuredJobs'] = $this->homeRepository->getFeaturedJobs();
        $data['notices'] = $this->homeRepository->getNotices();
        list($data['imageSliders'], $data['settings'], $data['slider'], $data['imageSliderActive'], $data['headerSliders']) = $this->homeRepository->getImageSlider();
        $data['latestJobsEnable'] = $this->homeRepository->getLatestJobsEnable();
        $data['plans'] = $this->homeRepository->getPlans();
        $data['branding'] = $this->homeRepository->getBranding();
        $data['recentBlog'] = $this->homeRepository->getRecentBlog();

        return view('web.home.home')->with($data);
    }

    /**
     * @param  ContactFormRequest  $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function sendContactEmail(ContactFormRequest $request)
    {
        $inquiry = $this->homeRepository->storeInquires($request->all());
        Flash::success('Thank you for contacting us.');

        return redirect(route('front.contact'));
    }

    /**
     * @param  Request  $request
     *
     * @return RedirectResponse
     */
    public function changeLanguage(Request $request)
    {
        Session::put('languageName', $request->input('languageName'));

        return $this->sendSuccess('Language changed successfully');
    }

    /**
     * @param  Request  $request
     *
     * @throws Throwable
     *
     * @return array|string
     */
    public function getJobsSearch(Request $request)
    {
        $searchTerm = strtolower($request->get('searchTerm'));
        if ($searchTerm) {
            $jobSearchResult = Job::where('job_title', 'LIKE', '%'.$searchTerm.'%')->get();
            $skills = Skill::where('name', 'LIKE', '%'.$searchTerm.'%')->get();
            $companies = Company::whereHas('user', function (Builder $query) use ($searchTerm) {
                $query->where('first_name', 'LIKE', '%'.$searchTerm.'%')->orWhere('last_name', 'LIKE',
                    '%'.$searchTerm.'%');
            })->get();

            return view('web.home.job_search_results', compact('jobSearchResult', 'skills', 'companies'))->render();
        }
    }
}
