<?php

namespace App\Repositories;

use App\Mail\ContactEmail;
use App\Models\BrandingSliders;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\EmailTemplate;
use App\Models\FrontSetting;
use App\Models\HeaderSlider;
use App\Models\ImageSlider;
use App\Models\Inquiry;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\Noticeboard;
use App\Models\Plan;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Class WebHomeRepository
 * @version July 7, 2020, 5:07 am UTC
 */
class WebHomeRepository
{
    /**
     * @return mixed
     */
    public function getTestimonials()
    {
        return Testimonial::with('media')->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
    }

    /**
     * @return mixed
     */
    public function getDataCounts()
    {
        $data['candidates'] = Candidate::count();
        $data['jobs'] = Job::status(Job::STATUS_OPEN)->count();
        $data['resumes'] = Media::where('model_type', Candidate::class)->where('collection_name',
            Candidate::RESUME_PATH)->count();
        $data['companies'] = Company::count();

        return $data;
    }

    /**
     * @return mixed
     */
    public function getLatestJobs()
    {
        return Job::with(['company', 'jobCategory'])
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get()
            ->append('full_location');
    }

    /**
     * @return JobCategory[]|Builder[]|Collection
     */
    public function getCategories()
    {
        $categories = JobCategory::whereIsFeatured(1)
            ->withCount([
                'jobs' => function (Builder $q) {
                    $q->where('status', '!=', Job::STATUS_DRAFT);
                    $q->where('status', '!=', Job::STATUS_CLOSED);
                },
            ])
            ->orderBy('jobs_count', 'desc')
            ->toBase()
            ->take(8)
            ->get();

        return $categories;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getAllJobCategories()
    {
        return JobCategory::pluck('name', 'id');
    }

    /**
     * @return Company[]|Builder[]|Collection
     */
    public function getFeaturedCompanies()
    {
        return Company::has('activeFeatured')
            ->with(['jobs', 'activeFeatured', 'user' => function($query) {
                $query->without(['country', 'state', 'city']);
            }])
            ->whereHas('user', function (Builder $query) {
                $query->where('is_active', '=', true);
            })
            ->withCount(['jobs' => function (Builder $q) {
                $q->where('status', '!=', Job::STATUS_DRAFT);
                $q->where('status', '!=', Job::STATUS_CLOSED);
            }])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * @return Job[]|Builder[]|Collection
     */
    public function getFeaturedJobs()
    {
        return Job::has('activeFeatured')
            ->with(['company', 'jobCategory'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * @return Noticeboard[]|Builder[]|Collection
     */
    public function getNotices()
    {
        return Noticeboard::whereIsActive(true)->orderByDesc('created_at')->get();
    }

    /**
     * @param $input
     *
     * @return bool
     */
    public function storeInquires($input)
    {
        /** @var Inquiry $inquiry */
        $inquiry = Inquiry::create($input);
        $templateBody = EmailTemplate::whereTemplateName('Contact Us')->first();
        $keyVariable = ['{{name}}', '{{phone_no}}', '{{from_name}}'];
        $value = [$inquiry->name, $inquiry->phone_no, config('app.name')];
        $body = str_replace($keyVariable, $value, $templateBody->body);
        $data['inquiry'] = $inquiry;
        $data['body'] = $body;
        Mail::to($input['email'])->send(new ContactEmail($data));

        return true;
    }

    /**
     * @return mixed
     */
    public function getImageSlider()
    {
        $imageSliders = ImageSlider::with('media')
            ->where('is_active', '=', 1)
            ->orderBy('created_at', 'desc')
            ->get();
        $headerSliders = HeaderSlider::with('media')
            ->where('is_active', '=', 1)
            ->orderBy('created_at', 'desc')
            ->get();
        $settings = Setting::where('key', 'slider_is_active')->toBase()->first();
        $slider = Setting::where('key', 'is_full_slider')->toBase()->first();
        $imageSliderActive = Setting::where('key', 'is_slider_active')->toBase()->first();

        return [$imageSliders, $settings, $slider, $imageSliderActive, $headerSliders];
    }

    /**
     * @return mixed
     */
    public function getLatestJobsEnable()
    {
        return $settings = FrontSetting::where('key', 'latest_jobs_enable')->first();
    }

    /**
     * @return mixed
     */
    public function getPlans()
    {
        return $plans = Plan::with('salaryCurrency')->get()->sortBy('amount', SORT_DESC, true);
    }

    /**
     * @return BrandingSliders[]|Collection
     */
    public function getBranding()
    {
        return $branding = BrandingSliders::with('media')
            ->where('is_active', '=', 1)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * @return Builder[]|Collection
     */
    public function getRecentBlog()
    {
        return $blog = Post::with(['postAssignCategories', 'media', 'user' => function($query) {
            $query->without(['media', 'country', 'state', 'city']);
        }])
            ->orderBy('created_at', 'desc')->limit(3)
            ->get();
    }
}
