<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNoticeboardRequest;
use App\Http\Requests\UpdateNoticeboardRequest;
use App\Models\Noticeboard;
use App\Queries\NoticeboardDataTable;
use App\Repositories\NoticeboardRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;

class NoticeboardController extends AppBaseController
{
    /** @var NoticeboardRepository */
    private $noticeboardRepository;

    public function __construct(NoticeboardRepository $noticeboardRepository)
    {
        $this->noticeboardRepository = $noticeboardRepository;
    }

    /**
     * Display a listing of the Noticeboard.
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
            return Datatables::of((new NoticeboardDataTable())->get())->make(true);
        }
        $statusArr = Noticeboard::STATUS;
        $noticeboards = Noticeboard::toBase()->get();

        return view('noticeboards.index', compact('statusArr', 'noticeboards'));
    }

    /**
     * Store a newly created Noticeboard in storage.
     *
     * @param  CreateNoticeboardRequest  $request
     *
     * @return JsonResource
     */
    public function store(CreateNoticeboardRequest $request)
    {
        $input = $request->all();
        $input['is_active'] = (isset($input['is_active'])) ? 1 : 0;
        $this->noticeboardRepository->store($input);

        return $this->sendSuccess('Noticeboard saved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Noticeboard  $noticeboard
     *
     * @return JsonResponse
     */
    public function edit(Noticeboard $noticeboard)
    {
        return $this->sendResponse($noticeboard, 'Noticeboard Retrieved Successfully.');
    }

    /**
     * Show the form for editing the specified Noticeboard.
     *
     * @param  Noticeboard  $noticeboard
     *
     * @return JsonResource
     */
    public function show(Noticeboard $noticeboard)
    {
        return $this->sendResponse($noticeboard, 'Noticeboard Retrieved Successfully.');
    }

    /**
     * Update the specified Noticeboard in storage.
     *
     * @param  UpdateNoticeboardRequest  $request
     *
     * @param  Noticeboard  $noticeboard
     *
     * @return JsonResource
     */
    public function update(UpdateNoticeboardRequest $request, Noticeboard $noticeboard)
    {
        $input = $request->all();
        $input['is_active'] = (isset($input['is_active'])) ? 1 : 0;
        $this->noticeboardRepository->update($input, $noticeboard->id);

        return $this->sendSuccess('Noticeboard updated successfully.');
    }

    /**
     * Remove the specified Noticeboard from storage.
     *
     * @param  Noticeboard  $noticeboard
     *
     * @throws Exception
     *
     * @return JsonResource
     */
    public function destroy(Noticeboard $noticeboard)
    {
        $noticeboard->delete();

        return $this->sendSuccess('Noticeboard deleted successfully.');
    }

    /**
     * @param $id
     *
     * @return JsonResource
     */
    public function changeStatus($id)
    {
        $notice = Noticeboard::findOrFail($id);
        $status = ! $notice->is_active;
        $notice->update(['is_active' => $status]);

        return $this->sendSuccess('Status updated successfully.');
    }
}
