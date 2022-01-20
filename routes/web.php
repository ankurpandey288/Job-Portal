<?php

use App\Http\Controllers\BrandingSliderController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\Candidates;
use App\Http\Controllers\CareerLevelController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanySizeController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\FeaturedCompanySubscriptionController;
use App\Http\Controllers\FeaturedJobSubscriptionController;
use App\Http\Controllers\FrontSettingsController;
use App\Http\Controllers\FunctionalAreaController;
use App\Http\Controllers\HeaderSliderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageSliderController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobCategoryController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobNotificationController;
use App\Http\Controllers\JobShiftController;
use App\Http\Controllers\JobStageController;
use App\Http\Controllers\JobTypeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MaritalStatusController;
use App\Http\Controllers\NoticeboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationSettingsController;
use App\Http\Controllers\OwnerShipTypeController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\RequiredDegreeLevelController;
use App\Http\Controllers\SalaryCurrencyController;
use App\Http\Controllers\SalaryPeriodController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TestimonialsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TranslationManagerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Web;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('web.home.home');
})->name('web.home');

Auth::routes(['verify' => true, 'register' => false]);
Route::get('admin/login', [\App\Http\Controllers\Auth\LoginController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('users/login', [\App\Http\Controllers\Auth\Front\LoginController::class, 'login'])->name('front.login');
Route::get('users/employee-login', [\App\Http\Controllers\Auth\Front\LoginController::class, 'employeeLogin'])->name('front.employee.login');
Route::get('users/candidate-login', [\App\Http\Controllers\Auth\Front\LoginController::class, 'candidateLogin'])->name('front.candidate.login');
Route::get('pricing', function () {
    return view('pricing.index');
});

Route::any('subscription-update', [SubscriptionController::class, 'updateSubscription'])->name('subscription-update');

//Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [Web\WebController::class, 'index'])->name('front');

Route::post('news-letter', [Web\WebController::class, 'newsLetter'])->name('news-letter.create');

Route::group(['middleware' => ['auth', 'role:Admin', 'xss', 'verified.user'], 'prefix' => 'admin'], function () {

    // logs view route
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    
    // dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard-chart-data', [DashboardController::class, 'dashboardChartData'])->name('dashboard.chart.data');

    // Read notification
    Route::post('/notification/{notification}/read',
        [NotificationController::class, 'readNotification'])->name('read-notification');
    Route::post('/read-all-notification', [NotificationController::class, 'readAllNotification'])->name('read-all-notification');

    // subscribers route
    Route::get('subscribers', [SubscriberController::class, 'index'])->name('subscribers.index');
    Route::delete('subscribers/{newsLetter}', [SubscriberController::class, 'destroy'])->name('subscribers.destroy');

    // Job Category routes
    Route::get('job-categories', [JobCategoryController::class, 'index'])->name('job-categories.index');
    Route::post('job-categories', [JobCategoryController::class, 'store'])->name('job-categories.store');
    Route::get('job-categories/{jobCategory}/edit', [JobCategoryController::class, 'edit'])->name('job-categories.edit');
    Route::get('job-categories/{jobCategory}', [JobCategoryController::class, 'show'])->name('job-categories.show');
    Route::put('job-categories/{jobCategory}', [JobCategoryController::class, 'update'])->name('job-categories.update');
    Route::delete('job-categories/{jobCategory}', [JobCategoryController::class, 'destroy'])->name('job-categories.destroy');
    Route::post('job-categories/{jobCategory}/change-status', [JobCategoryController::class, 'changeStatus']);

    // settings routes
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

    // Privacy Policy routes
    Route::get('privacy-policy', [PrivacyPolicyController::class, 'index'])->name('privacy.policy.index');
    Route::post('privacy-policy', [PrivacyPolicyController::class, 'update'])->name('privacy.policy.update');

    // Company Size
    Route::get('company-sizes', [CompanySizeController::class, 'index'])->name('companySize.index');
    Route::post('company-sizes', [CompanySizeController::class, 'store'])->name('companySize.store');
    Route::get('company-sizes/{companySize}/edit', [CompanySizeController::class, 'edit'])->name('companySize.edit');
    Route::put('company-sizes/{companySize}', [CompanySizeController::class, 'update'])->name('companySize.update');
    Route::delete('company-sizes/{companySize}', [CompanySizeController::class, 'destroy'])->name('companySize.destroy');

    //Skills
    Route::get('skills', [SkillController::class, 'index'])->name('skills.index');
    Route::post('skills', [SkillController::class, 'store'])->name('skills.store');
    Route::get('skills/{skill}', [SkillController::class, 'show'])->name('skills.show');
    Route::get('skills/{skill}/edit', [SkillController::class, 'edit'])->name('skills.edit');
    Route::put('skills/{skill}', [SkillController::class, 'update'])->name('skills.update');
    Route::delete('skills/{skill}', [SkillController::class, 'destroy'])->name('skills.destroy');

    // Marital Status
    Route::get('marital-status', [MaritalStatusController::class, 'index'])->name('maritalStatus.index');
    Route::post('marital-status', [MaritalStatusController::class, 'store'])->name('maritalStatus.store');
    Route::get('marital-status/{maritalStatus}', [MaritalStatusController::class, 'show'])->name('maritalStatus.show');
    Route::get('marital-status/{maritalStatus}/edit',
        [MaritalStatusController::class, 'edit'])->name('maritalStatus.edit');
    Route::put('marital-status/{maritalStatus}',
        [MaritalStatusController::class, 'update'])->name('maritalStatus.update');
    Route::delete('marital-status/{maritalStatus}',
        [MaritalStatusController::class, 'destroy'])->name('maritalStatus.destroy');

    // Salary Period
    Route::get('salary-periods', [SalaryPeriodController::class, 'index'])->name('salaryPeriod.index');
    Route::post('salary-periods', [SalaryPeriodController::class, 'store'])->name('salaryPeriod.store');
    Route::get('salary-periods/{salaryPeriod}', [SalaryPeriodController::class, 'show'])->name('salaryPeriod.show');
    Route::get('salary-periods/{salaryPeriod}/edit', [SalaryPeriodController::class, 'edit'])->name('salaryPeriod.edit');
    Route::put('salary-periods/{salaryPeriod}', [SalaryPeriodController::class, 'update'])->name('salaryPeriod.update');
    Route::delete('salary-periods/{salaryPeriod}', [SalaryPeriodController::class, 'destroy'])->name('salaryPeriod.destroy');

    // Job Shift
    Route::get('job-shifts', [JobShiftController::class, 'index'])->name('jobShift.index');
    Route::post('job-shifts', [JobShiftController::class, 'store'])->name('jobShift.store');
    Route::get('job-shifts/{jobShift}', [JobShiftController::class, 'show'])->name('jobShift.show');
    Route::get('job-shifts/{jobShift}/edit', [JobShiftController::class, 'edit'])->name('jobShift.edit');
    Route::put('job-shifts/{jobShift}', [JobShiftController::class, 'update'])->name('jobShift.update');
    Route::delete('job-shifts/{jobShift}', [JobShiftController::class, 'destroy'])->name('jobShift.destroy');

    // Required Degree Level
    Route::get('required-degree-level', [RequiredDegreeLevelController::class, 'index'])->name('requiredDegreeLevel.index');
    Route::post('required-degree-level', [RequiredDegreeLevelController::class, 'store'])->name('requiredDegreeLevel.store');
    Route::get('required-degree-level/{requiredDegreeLevel}',
        [RequiredDegreeLevelController::class, 'show'])->name('requiredDegreeLevel.show');
    Route::get('required-degree-level/{requiredDegreeLevel}/edit',
        [RequiredDegreeLevelController::class, 'edit'])->name('requiredDegreeLevel.edit');
    Route::put('required-degree-level/{requiredDegreeLevel}',
        [RequiredDegreeLevelController::class, 'update'])->name('requiredDegreeLevel.update');
    Route::delete('required-degree-level/{requiredDegreeLevel}',
        [RequiredDegreeLevelController::class, 'destroy'])->name('requiredDegreeLevel.destroy');

    // All Candidate Resumes
    Route::get('resumes', [CandidateController::class, 'resumes'])->name('resumes.index');
    Route::get('/media/{media?}', [CandidateController::class, 'downloadResume'])->name('download.all-resume');
    Route::delete('delete-resumes/{media?}',
        [CandidateController::class, 'deleteResume'])->name('delete.resume');

    // Industries
    Route::get('industries', [IndustryController::class, 'index'])->name('industry.index');
    Route::post('industries', [IndustryController::class, 'store'])->name('industry.store');
    Route::get('industries/{industry}', [IndustryController::class, 'show'])->name('industry.show');
    Route::get('industries/{industry}/edit', [IndustryController::class, 'edit'])->name('industry.edit');
    Route::put('industries/{industry}', [IndustryController::class, 'update'])->name('industry.update');
    Route::delete('industries/{industry}', [IndustryController::class, 'destroy'])->name('industry.destroy');

    // Job Tags
    Route::get('job-tags', [TagController::class, 'index'])->name('jobTag.index');
    Route::post('job-tags', [TagController::class, 'store'])->name('jobTag.store');
    Route::get('job-tags/{tag}', [TagController::class, 'show'])->name('jobTag.show');
    Route::get('job-tags/{tag}/edit', [TagController::class, 'edit'])->name('jobTag.edit');
    Route::put('job-tags/{tag}', [TagController::class, 'update'])->name('jobTag.update');
    Route::delete('job-tags/{tag}', [TagController::class, 'destroy'])->name('jobTag.destroy');

    // Job Types
    Route::get('job-types', [JobTypeController::class, 'index'])->name('jobType.index');
    Route::post('job-types', [JobTypeController::class, 'store'])->name('jobType.store');
    Route::get('job-types/{jobType}', [JobTypeController::class, 'show'])->name('jobType.show');
    Route::get('job-types/{jobType}/edit', [JobTypeController::class, 'edit'])->name('jobType.edit');
    Route::put('job-types/{jobType}', [JobTypeController::class, 'update'])->name('jobType.update');
    Route::delete('job-types/{jobType}', [JobTypeController::class, 'destroy'])->name('jobType.destroy');

    // OwnerShip Type
    Route::get('ownership-types', [OwnerShipTypeController::class, 'index'])->name('ownerShipType.index');
    Route::post('ownership-types', [OwnerShipTypeController::class, 'store'])->name('ownerShipType.store');
    Route::get('ownership-types/{ownerShipType}/edit', [OwnerShipTypeController::class, 'edit'])->name('ownerShipType.edit');
    Route::get('ownership-types/{ownerShipType}', [OwnerShipTypeController::class, 'show'])->name('ownership-types.show');
    Route::put('ownership-types/{ownerShipType}', [OwnerShipTypeController::class, 'update'])->name('ownerShipType.update');
    Route::delete('ownership-types/{ownerShipType}', [OwnerShipTypeController::class, 'destroy'])->name('ownerShipType.destroy');

    // Industries
    Route::get('industries', [IndustryController::class, 'index'])->name('industry.index');
    Route::post('industries', [IndustryController::class, 'store'])->name('industry.store');
    Route::get('industries/{industry}', [IndustryController::class, 'show'])->name('industry.show');
    Route::get('industries/{industry}/edit', [IndustryController::class, 'edit'])->name('industry.edit');
    Route::put('industries/{industry}', [IndustryController::class, 'update'])->name('industry.update');
    Route::delete('industries/{industry}', [IndustryController::class, 'destroy'])->name('industry.destroy');

    // Companies
    Route::get('companies', [CompanyController::class, 'index'])->name('company.index');
    Route::get('companies/create', [CompanyController::class, 'create'])->name('company.create');
    Route::post('companies', [CompanyController::class, 'store'])->name('company.store');
    Route::get('companies/{company}', [CompanyController::class, 'show'])->name('company.show');
    Route::get('companies/{company}/edit', [CompanyController::class, 'edit'])->name('company.edit');
    Route::put('companies/{company}', [CompanyController::class, 'update'])->name('company.update');
    Route::delete('companies/{company}', [CompanyController::class, 'destroy'])->name('company.destroy');
    Route::post('companies/{company}/change-is-active', [CompanyController::class, 'changeIsActive']);
    Route::post('companies/{company}/verify-email', [CompanyController::class, 'changeIsEmailVerified']);
    Route::post('companies/{company}/resend-email-verification', [CompanyController::class, 'resendEmailVerification']);
    Route::post('companies/{company}/mark-as-featured',
        [CompanyController::class, 'markAsFeatured'])->name('mark-as-featured');
    Route::post('companies/{company}/mark-as-unfeatured',
        [CompanyController::class, 'markAsUnFeatured'])->name('mark-as-featured');

    // Language routes
    Route::get('languages', [LanguageController::class, 'index'])->name('languages.index');
    Route::post('languages', [LanguageController::class, 'store'])->name('languages.store');
    Route::get('languages/{language}/edit', [LanguageController::class, 'edit'])->name('languages.edit');
    Route::get('languages/{language}', [LanguageController::class, 'show'])->name('languages.show');
    Route::put('languages/{language}', [LanguageController::class, 'update'])->name('languages.update');
    Route::delete('languages/{language}', [LanguageController::class, 'destroy'])->name('languages.destroy');
    Route::post('languages/{language}/{param}/change-status', [LanguageController::class, 'changeStatus']);

    // Functional Area
    Route::get('functional-area', [FunctionalAreaController::class, 'index'])->name('functionalArea.index');
    Route::post('functional-area', [FunctionalAreaController::class, 'store'])->name('functionalArea.store');
    Route::get('functional-area/{functionalArea}/edit',
        [FunctionalAreaController::class, 'edit'])->name('functionalArea.edit');
    Route::put('functional-area/{functionalArea}',
        [FunctionalAreaController::class, 'update'])->name('functionalArea.update');
    Route::delete('functional-area/{functionalArea}',
        [FunctionalAreaController::class, 'destroy'])->name('functionalArea.destroy');

    // Career Level
    Route::get('career-levels', [CareerLevelController::class, 'index'])->name('careerLevel.index');
    Route::post('career-levels', [CareerLevelController::class, 'store'])->name('careerLevel.store');
    Route::get('career-levels/{careerLevel}/edit',
        [CareerLevelController::class, 'edit'])->name('careerLevel.edit');
    Route::put('career-levels/{careerLevel}',
        [CareerLevelController::class, 'update'])->name('careerLevel.update');
    Route::delete('career-levels/{careerLevel}',
        [CareerLevelController::class, 'destroy'])->name('careerLevel.destroy');

    Route::get('profile', [UserController::class, 'editProfile']);
    Route::post('change-password', [UserController::class, 'changePassword']);
    Route::post('profile-update', [UserController::class, 'profileUpdate']);

    // Salary Currency
    Route::get('salary-currencies', [SalaryCurrencyController::class, 'index'])->name('salaryCurrency.index');

    // jobs route
    Route::get('jobs', [JobController::class, 'getJobs'])->name('admin.jobs.index');
    Route::get('jobs/create', [JobController::class, 'createJob'])->name('admin.job.create');
    Route::post('jobs', [JobController::class, 'storeJob'])->name('admin.job.store');
    Route::get('jobs/{job}/edit', [JobController::class, 'editJob'])->name('admin.job.edit');
    Route::put('jobs/{job}', [JobController::class, 'updateJob'])->name('admin.job.update');
    Route::get('jobs/{job}', [JobController::class, 'showJobs'])->name('admin.jobs.show');
    Route::delete('jobs/{job}', [JobController::class, 'delete'])->name('admin.jobs.destroy');
    Route::post('jobs/{job}/change-is-suspend', [JobController::class, 'changeIsSuspended']);
    Route::post('jobs/{job}/make-job-featured', [JobController::class, 'makeFeatured']);
    Route::post('jobs/{job}/make-job-unfeatured', [JobController::class, 'makeUnFeatured']);

    // candidate routes
    Route::get('candidates', [CandidateController::class, 'index'])->name('candidates.index');
    Route::get('candidates/create', [CandidateController::class, 'create'])->name('candidates.create');
    Route::post('candidates', [CandidateController::class, 'store'])->name('candidates.store');
    Route::get('candidates/{candidate}/edit', [CandidateController::class, 'edit'])->name('candidates.edit');
    Route::get('candidates/{candidate}', [CandidateController::class, 'show'])->name('candidates.show');
    Route::put('candidates/{candidate}', [CandidateController::class, 'update'])->name('candidates.update');
    Route::delete('candidates/{candidate}', [CandidateController::class, 'destroy'])->name('candidates.destroy');
    Route::post('candidates/{id}/change-status', [CandidateController::class, 'changeStatus']);
    Route::post('candidates/{candidate}/verify-email',
        [CandidateController::class, 'changeIsEmailVerified']);
    Route::post('candidates/{candidate}/resend-email-verification', [CandidateController::class, 'resendEmailVerification']);

    //Testimonials  routes
    Route::get('testimonials', [TestimonialsController::class, 'index'])->name('testimonials.index');
    Route::post('testimonials', [TestimonialsController::class, 'store'])->name('testimonials.store');
    Route::get('testimonials/{testimonial}/edit', [TestimonialsController::class, 'edit'])->name('testimonials.edit');
    Route::get('testimonials/{testimonial}', [TestimonialsController::class, 'show'])->name('testimonials.show');
    Route::post('testimonials/{testimonial}/update', [TestimonialsController::class, 'update'])->name('testimonials.update');
    Route::delete('testimonials/{testimonial}', [TestimonialsController::class, 'destroy'])->name('testimonials.destroy');
    Route::get('/download-image/{testimonial}', [TestimonialsController::class, 'downloadImage'])->name('download.image');

    //Front Image Slider Routes
    Route::get('image-sliders', [ImageSliderController::class, 'index'])->name('image-sliders.index');
    Route::post('image-sliders', [ImageSliderController::class, 'store'])->name('image-sliders.store');
    Route::get('image-sliders/{image_slider}/edit', [ImageSliderController::class, 'edit'])->name('image-sliders.edit');
    Route::post('image-sliders/{image_slider}/update', [ImageSliderController::class, 'update'])->name('image-sliders.update');
    Route::delete('image-sliders/{image_slider}', [ImageSliderController::class, 'destroy'])->name('image-sliders.destroy');
    Route::get('image-sliders/{image_slider}', [ImageSliderController::class, 'show'])->name('image-sliders.show');
    Route::post('image-sliders/{image_slider}/change-is-active', [ImageSliderController::class, 'changeIsActive']);
    Route::post('image-sliders/change-full-slider',
        [ImageSliderController::class, 'changeFullSlider'])->name('image-sliders.change-full-slider');
    Route::post('image-sliders/change-slider-active',
        [ImageSliderController::class, 'changeSliderActive'])->name('image-sliders.change-slider-active');

    //Front Header Slider Routes
    Route::get('header-sliders', [HeaderSliderController::class, 'index'])->name('header.sliders.index');
    Route::post('header-sliders', [HeaderSliderController::class, 'store'])->name('header.sliders.store');
    Route::get('header-sliders/{header_slider}/edit', [HeaderSliderController::class, 'edit'])->name('header.sliders.edit');
    Route::post('header-sliders/{header_slider}/update',
        [HeaderSliderController::class, 'update'])->name('header.sliders.update');
    Route::delete('header-sliders/{header_slider}', [HeaderSliderController::class, 'destroy'])->name('header.sliders.destroy');
    Route::post('header-sliders/{header_slider}/change-is-active', [HeaderSliderController::class, 'changeIsActive']);
    Route::post('header-sliders/change-search-disable',
        [HeaderSliderController::class, 'changeSearchDisable'])->name('header.sliders.change-search-disable');

    //Front Branding Slider Routes
    Route::get('branding-sliders', [BrandingSliderController::class, 'index'])->name('branding.sliders.index');
    Route::post('branding-sliders', [BrandingSliderController::class, 'store'])->name('branding.sliders.store');
    Route::get('branding-sliders/{brandingSlider}/edit',
        [BrandingSliderController::class, 'edit'])->name('branding.sliders.edit');
    Route::post('branding-sliders/{brandingSlider}/update',
        [BrandingSliderController::class, 'update'])->name('branding.sliders.update');
    Route::delete('branding-sliders/{brandingSlider}',
        [BrandingSliderController::class, 'destroy'])->name('branding.sliders.destroy');
    Route::post('branding-sliders/{brandingSlider}/change-is-active', [BrandingSliderController::class, 'changeIsActive']);

    // Noticeboard Routes
    Route::get('noticeboards', [NoticeboardController::class, 'index'])->name('noticeboards.index');
    Route::post('noticeboards', [NoticeboardController::class, 'store'])->name('noticeboards.store');
    Route::get('noticeboards/{noticeboard}', [NoticeboardController::class, 'show'])->name('noticeboards.show');
    Route::get('noticeboards/{noticeboard}/edit', [NoticeboardController::class, 'edit'])->name('noticeboards.edit');
    Route::put('noticeboards/{noticeboard}', [NoticeboardController::class, 'update'])->name('noticeboards.update');
    Route::delete('noticeboards/{noticeboard}', [NoticeboardController::class, 'destroy'])->name('noticeboards.destroy');
    Route::post('noticeboards/{id}/change-status', [NoticeboardController::class, 'changeStatus'])->name('noticeboard.status');

    // FAQ routes
    Route::get('faqs', [FAQController::class, 'index'])->name('faqs.index');
    Route::post('faqs', [FAQController::class, 'store'])->name('faqs.store');
    Route::get('faqs/{faq}', [FAQController::class, 'show'])->name('faqs.show');
    Route::get('faqs/{faq}/edit', [FAQController::class, 'edit'])->name('faqs.edit');
    Route::put('faqs/{faq}', [FAQController::class, 'update'])->name('faqs.update');
    Route::delete('faqs/{faq}', [FAQController::class, 'destroy'])->name('faqs.destroy');

    // inquires listing route
    Route::get('inquires', [InquiryController::class, 'index'])->name('inquires.index');
    Route::get('inquires/{inquiry}', [InquiryController::class, 'show'])->name('inquires.show');
    Route::delete('inquires/{inquiry}', [InquiryController::class, 'destroy'])->name('inquires.destroy');

    // Post Category Routes
    Route::get('post-categories', [PostCategoryController::class, 'index'])->name('post-categories.index');
    Route::post('post-categories', [PostCategoryController::class, 'store'])->name('post-categories.store');
    Route::get('post-categories/{postCategory}', [PostCategoryController::class, 'show'])->name('post-categories.show');
    Route::get('post-categories/{postCategory}/edit', [PostCategoryController::class, 'edit'])->name('post-categories.edit');
    Route::put('post-categories/{postCategory}', [PostCategoryController::class, 'update'])->name('post-categories.update');
    Route::delete('post-categories/{postCategory}', [PostCategoryController::class, 'destroy'])->name('post-categories.destroy');

    // Post Routes
    Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('posts/media/{media?}', [PostController::class, 'downloadPost'])->name('download.post');

    // Reported Job Listing
    Route::get('reported-jobs', [JobController::class, 'showReportedJobs'])->name('reported.jobs');
    Route::get('reported-jobs/{reportedJob}', [JobController::class, 'showReportedJobNote'])->name('reported.jobs.show');
    Route::delete('reported-jobs/{reportedJob}', [JobController::class, 'deleteReportedJobs'])->name('delete.reported.jobs');

    //Reported company
    Route::get('reported-company', [CompanyController::class, 'showReportedCompanies'])->name('reported.companies');
    Route::get('reported-company/{reportedToCompany}',
        [CompanyController::class, 'showReportedCompanyNote'])->name('reported.companies.show');
    Route::delete('reported-company/{reportedToCompany}',
        [CompanyController::class, 'deleteReportedCompany'])->name('delete.reported.company');

    //Reported candidate
    Route::get('reported-candidate', [CandidateController::class, 'showReportedCandidates'])->name('reported.candidates');
    Route::get('reported-candidate/{reportedToCandidate}',
        [CandidateController::class, 'showReportedCandiateNote'])->name('reported.candidates.show');
    Route::delete('reported-candidate/{reportedToCandidate}',
        [CandidateController::class, 'deleteReportedCandidate'])->name('delete.reported.candidate');

    //Selected Candidate
    Route::get('selected-candidate',[JobApplicationController::class,'showAllSelectedCandidate'])->name('selected.candidate');

    // plans routes
    Route::get('plans', [PlanController::class, 'index'])->name('plans.index');
    Route::post('plans', [PlanController::class, 'store'])->name('plans.store');
    Route::get('plans/{plan}/edit', [PlanController::class, 'edit'])->name('plans.edit');
    Route::put('plans/{plan}', [PlanController::class, 'update'])->name('plans.update');
    Route::delete('plans/{plan}', [PlanController::class, 'destroy'])->name('plans.destroy');
    Route::post('plans/{plan}/change-trial-plan', [PlanController::class, 'changeTrialPlan'])->name('plans.change-trial-plan');

    // transactions route
    Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('invoices/{invoiceId}', [TransactionController::class, 'getTransactionInvoice']);

    //Email template route
    Route::get('email-template', [EmailTemplateController::class, 'index'])->name('email.template.index');
    Route::get('email-template/{emailTemplate}/edit', [EmailTemplateController::class, 'edit'])->name('email.template.edit');
    Route::put('email-template/{emailTemplate}', [EmailTemplateController::class, 'update'])->name('email.template.update');

    // Front setting routes
    Route::get('front-settings', [FrontSettingsController::class, 'index'])->name('front.settings.index');
    Route::post('front-settings', [FrontSettingsController::class, 'update'])->name('front.settings.update');

    // Notification setting routes
    Route::get('notification-settings', [NotificationSettingsController::class, 'index'])->name('notification.settings.index');
    Route::post('notification-settings', [NotificationSettingsController::class, 'update'])->name('notification.settings.update');

    //Candidate Excel
    Route::get('candidates-export-excel', [CandidateController::class, 'candidateExportExcel'])->name('candidates.export.excel');
    Route::get('candidates-import', [CandidateController::class, 'candidateImportExcel'])->name('candidates.import');

    // Country routes
    Route::get('countries', [CountryController::class, 'index'])->name('countries.index');
    Route::post('countries', [CountryController::class, 'store'])->name('countries.store');
    Route::get('countries/{country}/edit', [CountryController::class, 'edit'])->name('countries.edit');
    Route::put('countries/{country}', [CountryController::class, 'update'])->name('countries.update');
    Route::delete('countries/{country}', [CountryController::class, 'destroy'])->name('countries.destroy');

    // State routes
    Route::get('states', [StateController::class, 'index'])->name('states.index');
    Route::post('states', [StateController::class, 'store'])->name('states.store');
    Route::get('states/{state}/edit', [StateController::class, 'edit'])->name('states.edit');
    Route::put('states/{state}', [StateController::class, 'update'])->name('states.update');
    Route::delete('states/{state}', [StateController::class, 'destroy'])->name('states.destroy');

    // City routes
    Route::get('cities', [CityController::class, 'index'])->name('cities.index');
    Route::post('cities', [CityController::class, 'store'])->name('cities.store');
    Route::get('cities/{city}/edit', [CityController::class, 'edit'])->name('cities.edit');
    Route::put('cities/{city}', [CityController::class, 'update'])->name('cities.update');
    Route::delete('cities/{city}', [CityController::class, 'destroy'])->name('cities.destroy');

    Route::get('job-notifications', [JobNotificationController::class, 'index'])->name('job-notification.index');
    Route::post('job-notifications', [JobNotificationController::class, 'store'])->name('job-notification.store');
    Route::get('employer-jobs/{id}', [JobNotificationController::class, 'getEmployerJobs'])->name('get-employer.jobs');

    Route::get('translation-manager', [TranslationManagerController::class, 'index'])->name('translation-manager.index');
    Route::post('translation-manager', [TranslationManagerController::class, 'store'])->name('translation-manager.store');
    Route::post('translation-manager/update',
        [TranslationManagerController::class, 'update'])->name('translation-manager.update');
});

Route::group(['middleware' => ['auth', 'role:Admin|Employer|Candidate', 'xss', 'verified.user']], function () {
    Route::get('states-list', [JobController::class, 'getStates'])->name('states-list');
    Route::get('cities-list', [JobController::class, 'getCities'])->name('cities-list');
    Route::post('update-language', [UserController::class, 'updateLanguage']);

    // job stripe payment
    Route::post('job-stripe-charge', [FeaturedJobSubscriptionController::class, 'createSession']);
    Route::get('job-payment-success', [FeaturedJobSubscriptionController::class, 'paymentSuccess'])->name('job-payment-success');
    Route::get('job-failed-payment',
        [FeaturedJobSubscriptionController::class, 'handleFailedPayment'])->name('job-failed-payment');

    // companie stripe payment
    Route::post('company-stripe-charge', [FeaturedCompanySubscriptionController::class, 'createSession']);
    Route::get('company-payment-success',
        [FeaturedCompanySubscriptionController::class, 'paymentSuccess'])->name('company-payment-success');
    Route::get('company-failed-payment',
        [FeaturedCompanySubscriptionController::class, 'handleFailedPayment'])->name('company-failed-payment');
});

Route::group(['middleware' => ['auth', 'role:Employer', 'xss', 'verified.user'], 'prefix' => 'employer'], function () {
    // TODO:: need to change this
    Route::get('/employer', function () {
        return view('employer.layouts.app');
    });

    Route::get('dashboard', [DashboardController::class, 'employerDashboard'])->name('employer.dashboard');
    Route::get('employer-dashboard-chart',
        [DashboardController::class, 'employerDashboardChart'])->name('employer.dashboard.chart');
    Route::get('employer-job-data', [DashboardController::class, 'getJobData'])->name('employer.job.data');

    // Read notification
    Route::post('/notification/{notification}/read',
        [NotificationController::class, 'readNotification'])->name('read-notification');
    Route::post('/read-all-notification', [NotificationController::class, 'readAllNotification'])->name('read-all-notification');

    //model profile and password
    Route::get('employer-profile', [EmployerController::class, 'editProfile']);
    Route::post('employer-change-password', [EmployerController::class, 'changePassword']);
    Route::post('employer-profile-update', [EmployerController::class, 'profileUpdate']);

    // Job Applications
    Route::get('jobs/{jobId}/applications', [JobApplicationController::class, 'index'])->name('job-applications');
    Route::get('job-applications/{id}/status/{status}', [JobApplicationController::class, 'changeJobApplicationStatus']);
    Route::delete('job-applications/{jobApplication}',
        [JobApplicationController::class, 'destroy'])->name('job.application.destroy');
    Route::get('resume-download/{jobApplication}', [JobApplicationController::class, 'downloadMedia']);
    Route::post('job-applications/{jobId}/job-stage', [JobApplicationController::class, 'changeJobStage'])->name('change.job.stage');
    Route::get('jobs/{jobId}/applications/{jobApplicationId}/slots', [JobApplicationController::class, 'viewSlotsScreen'])->name('view.slot.screen');
    Route::post('jobs/{jobId}/cancel-slot', [JobApplicationController::class, 'cancelSelectedSlot'])->name('cancel.selected.slot');
    Route::post('job-applications/{jobId}/slot-store', [JobApplicationController::class, 'interviewSlotStore'])->name('interview.slot.store');
    Route::get('job-applications/{jobId}/get-history-schedule', [JobApplicationController::class, 'getScheduleHistory'])->name('get.schedule.history');
    Route::post('job-applications/{jobId}/batch-slot-store', [JobApplicationController::class, 'batchSlotStore'])->name('batch.slot.store');
    Route::get('jobs/{jobId}/applications/slots/{slot}/edit', [JobApplicationController::class, 'editSlot'])->name('slot.edit');
    Route::post('jobs/{jobId}/applications/slots/{slot}/update', [JobApplicationController::class, 'updateSlot'])->name('slot.update');
    Route::delete('jobs/{jobId}/applications/slots/{slot}', [JobApplicationController::class, 'slotDestroy'])->name('slot.destroy');

    // Jobs
    Route::get('jobs', [JobController::class, 'index'])->name('job.index');
    Route::get('jobs/create', [JobController::class, 'create'])->name('job.create');
    Route::post('jobs', [JobController::class, 'store'])->name('job.store');
    Route::get('jobs/{job}', [JobController::class, 'show'])->name('job.show');
    Route::get('jobs/{job}/edit', [JobController::class, 'edit'])->name('job.edit');
    Route::put('jobs/{job}', [JobController::class, 'update'])->name('job.update');
    Route::delete('jobs/{job}', [JobController::class, 'destroy'])->name('job.destroy');
    Route::get('job/{id}/status/{status}', [JobController::class, 'changeJobStatus']);
    
    //job stage
    Route::get('job-stages', [JobStageController::class, 'index'])->name('job.stage.index');
    Route::post('job-stages', [JobStageController::class, 'store'])->name('job.stage.store');
    Route::get('job-stages/{jobStage}/edit', [JobStageController::class, 'edit'])->name('job.stage.edit');
    Route::put('job-stages/{jobStage}', [JobStageController::class, 'update'])->name('job.stage.update');
    Route::delete('job-stages/{jobStage}', [JobStageController::class, 'destroy'])->name('job.stage.destroy');
    Route::get('job-stages/{jobStage}', [JobStageController::class, 'show'])->name('job.stage.show');

    Route::get('company/{company}/edit', [CompanyController::class, 'editCompany'])->name('company.edit.form');
    Route::put('company/{company}', [CompanyController::class, 'updateCompany'])->name('company.update.form');

    // followers route
    Route::get('followers', [CompanyController::class, 'getFollowers'])->name('followers.index');
    Route::post('/report-to-candidate', [CandidateController::class, 'reportCandidate'])->name('report.to.candidate');

    Route::get('manage-subscriptions', [SubscriptionController::class, 'index'])->name('manage-subscription.index');
    Route::get('transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::post('purchase-subscription', [SubscriptionController::class, 'purchaseSubscription'])->name('purchase-subscription');
    Route::get('/paypal-status', [PaypalController::class, 'getPaymentStatus'])->name('status');
    Route::get('payment-method/{plan}', [SubscriptionController::class, 'showPaymentSelect'])->name('payment-method-screen');
    Route::get('paypal-payment/{plan}', [PaypalController::class, 'oneTimePayment'])->name('paypal-payment');
    Route::post('purchase-trial-subscription',
        [SubscriptionController::class, 'purchaseTrialSubscription'])->name('purchase-trial-subscription');
    Route::get('payment-success', [SubscriptionController::class, 'paymentSuccess'])->name('payment-success');
    Route::get('failed-payment', [SubscriptionController::class, 'handleFailedPayment'])->name('failed-payment');
    Route::post('cancel-subscription', [SubscriptionController::class, 'cancelSubscription'])->name('cancel-subscription');
    Route::get('invoices/{invoiceId}', [TransactionController::class, 'getTransactionInvoice']);
});
// web routes (i.e landing pages)
Route::group(['namespace' => 'Web', 'middleware' => ['xss', 'setLanguage']], function () {
    Route::get('/', [Web\HomeController::class, 'index'])->name('front.home');
    Route::get('/get-jobs-search', [Web\HomeController::class, 'getJobsSearch'])->name('get.jobs.search');
    Route::get('/search-jobs', [Web\JobController::class, 'index'])->name('front.search.jobs');
    Route::get('/job-details/{uniqueId?}', [Web\JobController::class, 'jobDetails'])->name('front.job.details');
    Route::get('/company-lists', [Web\CompanyController::class, 'getCompaniesLists'])->name('front.company.lists');
    Route::get('/candidate-lists',
        [Web\CandidateController::class, 'getCandidatesLists'])->name('front.candidate.lists')->middleware('role:Admin|Employer');
    Route::get('/company-details/{uniqueId?}', [Web\CompanyController::class, 'getCompaniesDetails'])->name('front.company.details');
    Route::get('/about-us', [Web\AboutUsController::class, 'FAQLists'])->name('front.about.us');
    Route::get('/candidate-profile', function () {
        return view('web.profile.candidate_profile');
    })->name('front.candidate.profile');
    Route::get('/front-register', [Web\RegisterController::class, 'candidateRegister'])->name('front.register');
    Route::get('/candidate-register', [Web\RegisterController::class, 'candidateRegister'])->name('candidate.register');
    Route::get('/employer-register', [Web\RegisterController::class, 'employerRegister'])->name('employer.register');
    Route::get('/privacy-policy-list', [Web\PrivacyPolicyController::class, 'showPrivacyPolicy'])->name('privacy.policy.list');
    Route::get('/terms-conditions-list', [Web\PrivacyPolicyController::class, 'showTermsConditions'])->name('terms.conditions.list');
    Route::get('/contact-us', function () {
        return view('web.contact.index');
    })->name('front.contact');
    Route::post('/send-contact-mail', [Web\HomeController::class, 'sendContactEmail'])->name('send.contact.email');
    Route::post('/register', [Web\RegisterController::class, 'register'])->name('front.save.register');

    //Blog comments Routes
    Route::post('/posts-details/{post}/comment',[Web\PostController::class,'blogCommentStore'])->name('blog.create.comment');
    Route::delete('/post-comments/{postComment}',[Web\PostController::class,'blogCommentDelete'])->name('blog.delete.comment');
    Route::get('/post-comments/{postComment}',[Web\PostController::class,'blogCommentEdit'])->name('blog.edit.comment');
    Route::put('/post-comments/{postComment}/edit',[Web\PostController::class,'blogCommentUpdate'])->name('blog.update.comment');

    //Blog Listing
    Route::get('/posts', [Web\PostController::class, 'getBlogLists'])->name('front.post.lists');
    Route::get('/posts/details/{post}', [Web\PostController::class, 'getBlogDetails'])->name('front.posts.details');
    Route::get('/posts/category/{postCategory}',
        [Web\PostController::class, 'getBlogDetailsByCategory'])->name('front.blog.category');

    //Candidate Show routes
    Route::get('candidate-details/{uniqueId}',
        [Web\CandidateController::class, 'getCandidateDetails'])->name('front.candidate.details');

    //Change language
    Route::post('/change-language', [Web\HomeController::class, 'changeLanguage']);
});

Route::group(['middleware' => ['xss', 'verified.user']], function () {
    Route::get('candidate-details/{uniqueId}',
        [Web\CandidateController::class, 'getCandidateDetails'])->name('front.candidate.details');
});

Route::group([
    'middleware' => ['auth', 'role:Candidate', 'xss', 'verified.user'], 'prefix' => 'candidate',
    'namespace'  => 'Candidates',
],
    function () {
        //dashboard
        Route::get('dashboard', [Candidates\DashboardController::class, 'dashboard'])->name('dashboard');

        Route::get('/profile', [Candidates\CandidateController::class, 'editProfile'])->name('candidate.profile');
        Route::post('update-profile', [Candidates\CandidateController::class, 'updateProfile'])->name('candidate-profile.update');

        Route::get('edit-profile', [Candidates\CandidateController::class, 'editCandidateProfile'])->name('candidate.edit.profile');
        Route::post('edit-change-password', [Candidates\CandidateController::class, 'changePassword']);
        Route::post('edit-profile-update', [Candidates\CandidateController::class, 'profileUpdate']);

        Route::post('/resumes', [Candidates\CandidateController::class, 'uploadResume'])->name('candidate.resumes');
        Route::get('/media/{media}', [CandidateController::class, 'downloadResume'])->name('download.resume');
        Route::delete('/resumes/{media}', [Candidates\CandidateController::class, 'deletedResume'])->name('download.destroy');

        Route::post('experience', [Candidates\CandidateProfileController::class, 'createExperience'])->name('candidate.create-experience');
        Route::get('/{candidateExperience}/edit-experience',
            [Candidates\CandidateProfileController::class, 'editExperience'])->name('candidate.edit-experience');
        Route::put('candidate-experience/{candidateExperience}', [Candidates\CandidateProfileController::class, 'updateExperience']);
        Route::delete('candidate-experience/{candidateExperience}',
            [Candidates\CandidateProfileController::class, 'destroyExperience'])->name('experience.destroy');
        Route::delete('candidate-experience/{candidateExperience}',
            [Candidates\CandidateProfileController::class, 'destroyExperience'])->name('experience.destroy');

        // candidate education
        Route::post('education', [Candidates\CandidateProfileController::class, 'createEducation'])->name('candidate.create-education');
        Route::get('/{candidateEducation}/edit-education',
            [Candidates\CandidateProfileController::class, 'editEducation'])->name('candidate.edit-education');
        Route::put('candidate-education/{candidateEducation}', [Candidates\CandidateProfileController::class, 'updateEducation']);
        Route::delete('candidate-education/{candidateEducation}',
            [Candidates\CandidateProfileController::class, 'destroyEducation'])->name('education.destroy');

        // favourite jobs listing routes.
        Route::get('favourite-jobs', [Candidates\CandidateController::class, 'showFavouriteJobs'])->name('favourite.jobs');

        // favourite company listing routes.
        Route::get('favourite-companies', [Candidates\CandidateController::class, 'showFavouriteCompanies'])->name('favourite.companies');

        //applied job list routes.
        Route::get('applied-jobs', [Candidates\CandidateController::class, 'showCandidateAppliedJob'])->name('candidate.applied.job');
        Route::get('applied-jobs/{jobApplication}',
            [Candidates\CandidateController::class, 'showAppliedJobs'])->name('candidate.applied.job.show');
        Route::post('applied-jobs/{jobApplication}/schedule-slot-book', [Candidates\CandidateController::class, 'showScheduleSlotBook'])->name('show.schedule.slot');
        Route::post('applied-jobs/{jobApplication}/choose-preference', [Candidates\CandidateController::class, 'choosePreference'])->name('choose.preference');

        // cv builder list routes.
        Route::post('update-general-profile',
            [Candidates\CandidateController::class, 'updateGeneralInformation'])->name('candidate.general.profile.update');
        Route::get('get-cv-template', [Candidates\CandidateController::class, 'getCVTemplate'])->name('candidate.cv.template');
        Route::post('update-online-profile',
            [Candidates\CandidateController::class, 'updateOnlineProfile'])->name('candidate.online.profile.update');

        // job alert routes.
        Route::get('job-alert', [Candidates\CandidateController::class, 'editJobAlert'])->name('candidate.job.alert');
        Route::post('job-alert', [Candidates\CandidateController::class, 'updateJobAlert'])->name('candidate.job.alert.update');
    });

// candidates route without name space
Route::group(['middleware' => ['auth', 'role:Candidate', 'xss', 'verified.user'], 'prefix' => 'candidate'], function () {

    // Read notification
    Route::post('/notification/{notification}/read',
        [NotificationController::class, 'readNotification'])->name('read-notification');
    Route::post('/read-all-notification', [NotificationController::class, 'readAllNotification'])->name('read-all-notification');

    Route::post('/email-job', [Web\JobController::class, 'emailJobToFriend'])->name('email.job');

    Route::post('/save-favourite-job', [Web\JobController::class, 'saveFavouriteJob'])->name('save.favourite.job');
    Route::post('/report-job', [Web\JobController::class, 'reportJobAbuse'])->name('report.job.abuse');

    Route::post('apply-job', [Web\JobApplicationController::class, 'applyJob'])->name('apply-job');

    Route::post('/save-favourite-company',
        [Web\CompanyController::class, 'saveFavouriteCompany'])->name('save.favourite.company');
    Route::post('/report-to-company', [Web\CompanyController::class, 'reportToCompany'])->name('report.to.company');

    Route::get('apply-job/{jobId}', [Web\JobApplicationController::class, 'showApplyJobForm'])->name('show.apply-job-form');
});
Route::group(['middleware' => ['web']], function () {
    Route::get('login/{provider}', [\App\Http\Controllers\Auth\Front\SocialAuthController::class, 'redirect']);
    Route::get('login/{provider}/callback', [\App\Http\Controllers\Auth\Front\SocialAuthController::class, 'callback']);
});

// upgrade to v4.2.0
Route::get('/upgrade-to-v4-2-0', function () {
    \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'AddIsFullSliderSettingSeeder']);
    \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'AddIsSliderActiveDeactiveSeeder']);
    \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'RenameIsActiveToSlierIsActiveInSettingSeeder']);
    \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'AddRecordNotificationSetting']);
    \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'UpdateNotificationSettingAdminTypeSeeder']);
});

// upgrade to v4.4.0
Route::get('/upgrade-to-v4-4-0', function () {
    \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'AddEnableGoogleRecaptchaSeeder']);
});

// upgrade to v4.5.0
Route::get('/upgrade-to-v4-5-0', function () {
    \Illuminate\Support\Facades\Artisan::call('db:seed',
        ['--class' => 'RemoveProviderUniqueRuleFromSocialAccountsSeeder']);
});

// upgrade to v6.0.0
Route::get('/upgrade-to-v6-0-0', function () {
    \Illuminate\Support\Facades\Artisan::call('db:seed',
        ['--class' => 'FrontSettingAdvertiseImageSeeder']);
});

// upgrade to v6.1.0
Route::get('/upgrade-to-v6-1-0', function () {
    \Illuminate\Support\Facades\Artisan::call('db:seed',
        ['--class' => 'CreateDefaultCurrencySeeder']);
});

// upgrade to v7.1.0
Route::get('/upgrade-to-v7-1-0', function () {
    \Illuminate\Support\Facades\Artisan::call('db:seed',
        ['--class' => 'EmailTemplateSeeder']);
});

// upgrade to v7.1.1
Route::get('/upgrade-to-v7-1-1', function () {
    \Illuminate\Support\Facades\Artisan::call('db:seed',
        ['--class' => 'CurrencySeeder']);
});

// upgrade to v8.0.0
Route::get('/upgrade-to-v8-0-0', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate',
        [
            '--force' => true,
            '--path'  => 'database/migrations/2021_06_29_000000_add_uuid_to_failed_jobs_table.php',
        ]);
    \Illuminate\Support\Facades\Artisan::call('migrate',
        [
            '--force' => true,
            '--path'  => 'database/migrations/2021_07_1_103036_add_conversions_disk_column_in_media_table.php',
        ]);
});

// upgrade to v8.1.0
Route::get('/upgrade-to-v8-1-0', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate',
        [
            '--force' => true,
            '--path'  => 'database/migrations/2021_07_08_085344_create_post_comments_table.php',
        ]);
    \Illuminate\Support\Facades\Artisan::call('migrate',
        [
            '--force' => true,
            '--path'  => 'database/migrations/2021_07_08_121050_add_column_is_created_by_admin_in_jobs_table.php',
        ]);
    \Illuminate\Support\Facades\Artisan::call('migrate',
        [
            '--force' => true,
            '--path'  => 'database/migrations/2021_07_10_070048_create_job_stages_table.php',
        ]);
    \Illuminate\Support\Facades\Artisan::call('migrate',
        [
            '--force' => true,
            '--path'  => 'database/migrations/2021_07_10_104206_add_job_stage_in_job_applications.php',
        ]);
    \Illuminate\Support\Facades\Artisan::call('migrate',
        [
            '--force' => true,
            '--path'  => 'database/migrations/2021_07_10_114138_create_job_application_schedules_table.php',
        ]);
    \Illuminate\Support\Facades\Artisan::call('db:seed',
        ['--class' => 'FooterLogoSeeder']);
});
