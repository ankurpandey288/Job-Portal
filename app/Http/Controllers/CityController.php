<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use App\Models\State;
use App\Queries\CityDataTable;
use App\Repositories\CityRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CityController extends AppBaseController
{
    /**
     * @var CityRepository
     */
    private $cityRepository;

    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     *
     * @return Application|Factory|Response|View
     */
    public function index(Request $request)
    {
        $states = State::pluck('name', 'id');

        return view('cities.index', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCityRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateCityRequest $request)
    {
        $input = $request->all();
        $state = $this->cityRepository->create($input);

        return $this->sendResponse($state, 'City saved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  City  $city
     *
     * @return JsonResponse
     */
    public function edit(City $city)
    {
        return $this->sendResponse($city, 'City successfully retrieved.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCityRequest  $request
     *
     * @param  City  $city
     *
     * @return JsonResponse
     */
    public function update(UpdateCityRequest $request, City $city)
    {
        $input = $request->all();
        $this->cityRepository->update($input, $city->id);

        return $this->sendSuccess('City updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  City  $city
     *
     * @throws \Exception
     *
     * @return JsonResponse
     */
    public function destroy(City $city)
    {
        $city->delete();

        return $this->sendSuccess('City deleted successfully.');
    }
}
