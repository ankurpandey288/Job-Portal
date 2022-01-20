<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Queries\InquiryDataTable;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InquiryController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new InquiryDataTable())->get())->make(true);
        }

        return view('inquires.index');
    }

    /**
     * @param  Inquiry  $inquiry
     *
     * @return Factory|View
     */
    public function show(Inquiry $inquiry)
    {
        return view('inquires.show', compact('inquiry'));
    }

    /**
     * Remove the specified Inquiry from storage.
     *
     * @param  Inquiry  $inquiry
     *
     * @throws Exception
     * @return JsonResponse
     */
    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();

        return $this->sendSuccess('Inquiry deleted successfully.');
    }
}
