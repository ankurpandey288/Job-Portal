<?php

namespace App\Http\Controllers;

use App\Queries\TransactionDataTable;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Stripe\StripeClient;
use Yajra\DataTables\DataTables;

/**
 * Class TransactionController
 */
class TransactionController extends AppBaseController
{
    /**
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new TransactionDataTable())->get())->make(true);
        }

        if (Auth::user()->hasRole('Employer')) {
            return view('employer.transactions.index');
        }

        return view('transactions.index');
    }

    /**
     * @param  string  $invoiceId
     *
     * @throws Exception
     *
     * @return mixed
     */
    public function getTransactionInvoice($invoiceId)
    {
        try {
            setStripeApiKey();
            $stripe = new StripeClient(
                config('services.stripe.secret_key')
            );

            $invoice = $stripe->invoices->retrieve(
                $invoiceId,
                []
            );

            $charge = $stripe->charges->retrieve($invoice->charge);
            $receiptUrl = $charge->receipt_url;

            return $this->sendResponse($receiptUrl, 'Invoice Retrieved Successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
}
