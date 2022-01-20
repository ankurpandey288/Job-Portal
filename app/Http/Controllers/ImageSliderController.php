<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateImageSliderRequest;
use App\Models\ImageSlider;
use App\Models\Setting;
use App\Queries\ImageSliderDataTable;
use App\Repositories\ImageSliderRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;

class ImageSliderController extends AppBaseController
{
    /** @var ImageSliderRepository */
    private $imageSliderRepository;

    public function __construct(ImageSliderRepository $imageSliderRepo)
    {
        $this->imageSliderRepository = $imageSliderRepo;
    }

    /**
     * Display a listing of the ImageSlider.
     *
     * @param Request $request
     *
     * @return Factory|View
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new ImageSliderDataTable())->get($request->only(['is_active'])))->make(true);
        }
        $settings = Setting::pluck('value', 'key')->toArray();
        $statusArr = ImageSlider::STATUS;

        return view('image_sliders.index', compact('settings', 'statusArr'));
    }

    /**
     * Store a newly created ImageSlider in storage.
     *
     * @param  CreateImageSliderRequest  $request
     *
     * @return JsonResource
     */
    public function store(CreateImageSliderRequest $request)
    {
        $input = $request->all();
        $input['is_active'] = (isset($input['is_active'])) ? 1 : 0;
        $this->imageSliderRepository->store($input);

        return $this->sendSuccess('Image Slider saved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ImageSlider $imageSlider
     *
     * @return JsonResponse
     */
    public function edit(ImageSlider $imageSlider)
    {
        return $this->sendResponse($imageSlider, 'Image Slider retrieved successfully.');
    }

    /**
     * Update the specified ImageSlider in storage.
     *
     * @param Request $request
     *
     * @param ImageSlider $imageSlider
     *
     * @return JsonResource
     */
    public function update(Request $request, ImageSlider $imageSlider)
    {
        $input = $request->all();
        $input['is_active'] = (isset($input['is_active'])) ? 1 : 0;
        $this->imageSliderRepository->updateImageSlider($input, $imageSlider->id);

        return $this->sendSuccess('Image Slider updated successfully.');
    }

    /**
     * Remove the specified ImageSlider from storage.
     *
     * @param ImageSlider $imageSlider
     *
     * @return JsonResource
     *
     * @throws Exception
     */
    public function destroy(ImageSlider $imageSlider)
    {
        $imageSlider->delete();

        return $this->sendSuccess('Image Slider deleted successfully.');
    }

    /**
     * @param Imageslider $imageSlider
     *
     * @return mixed
     */
    public function changeIsActive(ImageSlider $imageSlider)
    {
        $isActive = $imageSlider->is_active;
        $imageSlider->update(['is_active' => ! $isActive]);

        return $this->sendsuccess('Status changed successfully.');
    }

    /**
     * @return mixed
     */
    public function changeFullSlider()
    {
        /** @var Setting $setting */
        $setting = Setting::where('key', 'is_full_slider')->first();
        $setting->update(['value' => ! $setting->value]);

        return $this->sendSuccess('Status changed successfully.');
    }

    /**
     * @return mixed
     */
    public function changeSliderActive()
    {
        /** @var Setting $setting */
        $setting = Setting::where('key', 'is_slider_active')->first();
        $setting->update(['value' => ! $setting->value]);

        return $this->sendSuccess('Status changed successfully.');
    }

    /**
     * Show the form for editing the specified ImageSlider.
     *
     * @param  ImageSlider  $imageSlider
     *
     * @return JsonResponse
     */
    public function show(ImageSlider $imageSlider): JsonResponse
    {
        return $this->sendResponse($imageSlider, 'Image Slider Retrieved Successfully.');
    }
}
