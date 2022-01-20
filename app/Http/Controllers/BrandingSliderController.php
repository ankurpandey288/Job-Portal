<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBrandingSliderRequest;
use App\Models\BrandingSliders;
use App\Queries\BrandingSliderDataTable;
use App\Repositories\BrandingSliderRepository;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class BrandingSliderController extends AppBaseController
{
    /** @var BrandingSliderRepository */
    private $brandingSliderRepository;

    public function __construct(BrandingSliderRepository $brandingSliderRepository)
    {
        $this->brandingSliderRepository = $brandingSliderRepository;
    }

    /**
     * Display a listing of the BrandingSlider.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new BrandingSliderDataTable())->get($request->only(['is_active'])))->make(true);
        }
        $statusArr = BrandingSliders::STATUS;

        return view('branding_sliders.index', compact('statusArr'));
    }

    /**
     * Store a newly created BrandingSlider in storage.
     *
     * @param  CreateBrandingSliderRequest  $request
     *
     * @return JsonResource
     */
    public function store(CreateBrandingSliderRequest $request)
    {
        $input = $request->all();
        $input['is_active'] = (isset($input['is_active'])) ? 1 : 0;
        $this->brandingSliderRepository->store($input);

        return $this->sendSuccess('Brand saved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  BrandingSliders  $brandingSlider
     *
     * @return JsonResponse
     */
    public function edit(BrandingSliders $brandingSlider)
    {
        return $this->sendResponse($brandingSlider, 'Brand retrieved successfully.');
    }

    /**
     * Update the specified BrandingSlider in storage.
     *
     * @param  Request  $request
     *
     * @param  BrandingSliders  $brandingSlider
     *
     * @return JsonResource
     */
    public function update(Request $request, BrandingSliders $brandingSlider)
    {
        $request->validate([
            'title' => 'required|max:150',
        ]);
        $input = $request->all();
        $input['is_active'] = (isset($input['is_active'])) ? 1 : 0;
        $this->brandingSliderRepository->updateBranding($input, $brandingSlider->id);

        return $this->sendSuccess('Brand updated successfully.');
    }

    /**
     * Remove the specified BrandingSlider from storage.
     *
     * @param  BrandingSliders  $brandingSlider
     *
     * @throws Exception
     *
     * @return JsonResource
     */
    public function destroy(BrandingSliders $brandingSlider)
    {
        $brandingSlider->delete();

        return $this->sendSuccess('Brand deleted successfully.');
    }

    /**
     * @param  BrandingSliders  $brandingSlider
     *
     * @return mixed
     */
    public function changeIsActive(BrandingSliders $brandingSlider)
    {
        $isActive = $brandingSlider->is_active;
        $brandingSlider->update(['is_active' => ! $isActive]);

        return $this->sendsuccess('Status changed successfully.');
    }
}
