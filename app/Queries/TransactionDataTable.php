<?php

namespace App\Queries;

use App\Models\Subscription;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

/**
 * Class TransactionDataTable
 */
class TransactionDataTable
{
    /**
     * @return Transaction
     */
    public function get()
    {
        if (Auth::user()->hasRole('Admin')) {
            $query = Transaction::query();
            if ($query->where('owner_type', Subscription::class)->exists()) {
                $query->with(['type.planCurrency.salaryCurrency', 'user'])->get();
            } else {
                $query->with(['type', 'user'])->get();
            }
        }

        if (Auth::user()->hasRole('Employer')) {
            $query = Transaction::where('user_id', getLoggedInUserId())->get();

            foreach ($query as $row) {
                if ($row->owner_type == Subscription::class) {
                    $row->load('type.planCurrency.salaryCurrency');
                }
            }
        }

        return $query;
    }
}
