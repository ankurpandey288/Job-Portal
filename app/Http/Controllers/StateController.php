<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStateRequest;
use App\Http\Requests\UpdateStateRequest;
use App\Models\Country;
use App\Models\State;
use App\Queries\StateDataTable;
use App\Repositories\StateRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class StateController extends AppBaseController
{
    /**
     * @var StateRepository
     */
    private $stateRepository;

    public function __construct(StateRepository $stateRepository)
    {
        $this->stateRepository = $stateRepository;
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
        $countries = Country::pluck('name', 'id');

        return view('states.index', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateStateRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateStateRequest $request): JsonResponse
    {
        $input = $request->all();
        $state = $this->stateRepository->create($input);

        return $this->sendResponse($state, 'State saved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  State  $state
     *
     * @return JsonResponse
     */
    public function edit(State $state)
    {
        return $this->sendResponse($state, 'State successfully retrieved.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateStateRequest  $request
     *
     * @param  State  $state
     *
     * @return JsonResponse
     */
    public function update(UpdateStateRequest $request, State $state)
    {
        $input = $request->all();
        $this->stateRepository->update($input, $state->id);

        return $this->sendSuccess('State updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  State  $state
     *
     * @throws \Exception
     *
     * @return JsonResponse
     */
    public function destroy(State $state)
    {
        $state->delete();

        return $this->sendSuccess('State deleted successfully.');
    }
}
