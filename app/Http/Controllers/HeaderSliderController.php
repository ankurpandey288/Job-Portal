<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHeaderSliderRequest;
use App\Models\HeaderSlider;
use App\Models\Setting;
use App\Queries\HeaderSliderDataTable;
use App\Repositories\HeaderSliderRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class HeaderSliderController
 */
class HeaderSliderController extends AppBaseController
{
    /** @var HeaderSliderRepository */
    private $headerSliderRepository;

    /**
     * HeaderSliderController constructor.
     * @param  HeaderSliderRepository  $headerSliderRepository
     */
    public function __construct(HeaderSliderRepository $headerSliderRepository)
    {
        $this->headerSliderRepository = $headerSliderRepository;
    }

    /**
     * Display a listing of the ImageSlider.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View|Application
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new HeaderSliderDataTable())->get($request->only(['is_active'])))->make(true);
        }
        $statusArr = HeaderSlider::STATUS;
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('header_sliders.index', compact('statusArr', 'settings'));
    }

    /**
     * Store a newly created ImageSlider in storage.
     *
     * @param  CreateHeaderSliderRequest  $request
     *
     * @return JsonResource
     */
    public function store(CreateHeaderSliderRequest $request)
    {
        $input = $request->all();
        $input['is_active'] = (isset($input['is_active'])) ? 1 : 0;
        $this->headerSliderRepository->store($input);

        return $this->sendSuccess('Header Slider saved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  HeaderSlider  $headerSlider
     *
     * @return JsonResponse
     */
    public function edit(HeaderSlider $headerSlider)
    {
        return $this->sendResponse($headerSlider, 'Header Slider retrieved successfully.');
    }

    /**
     * Update the specified ImageSlider in storage.
     *
     * @param  Request  $request
     *
     * @param  HeaderSlider  $headerSlider
     *
     * @return JsonResource
     */
    public function update(Request $request, HeaderSlider $headerSlider)
    {
        $input = $request->all();
        $input['is_active'] = (isset($input['is_active'])) ? 1 : 0;
        $this->headerSliderRepository->updateHeaderSlider($input, $headerSlider->id);

        return $this->sendSuccess('Header Slider updated successfully.');
    }

    /**
     * Remove the specified ImageSlider from storage.
     *
     * @param  HeaderSlider  $headerSlider
     *
     * @throws Exception
     *
     * @return JsonResource
     */
    public function destroy(HeaderSlider $headerSlider)
    {
        $headerSlider->delete();

        return $this->sendSuccess('Header Slider deleted successfully.');
    }

    /**
     * @param  HeaderSlider  $headerSlider
     *
     * @return mixed
     */
    public function changeIsActive(HeaderSlider $headerSlider)
    {
        $isActive = $headerSlider->is_active;
        $headerSlider->update(['is_active' => ! $isActive]);

        return $this->sendsuccess('Status changed successfully.');
    }

    /***
     * @return mixed
     */
    public function changeSearchDisable()
    {
        /** @var Setting $setting */
        $setting = Setting::where('key', 'slider_is_active')->first();
        $setting->update(['value' => ! $setting->value]);

        return $this->sendSuccess('Status changed successfully.');
    }
}
