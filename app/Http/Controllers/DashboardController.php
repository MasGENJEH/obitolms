<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\TransactionService;

class DashboardController extends Controller
{
    protected $transactionService;

    public function __construct(
        TransactionService $transactionService
    ) {
        $this->transactionService = $transactionService;
    }

    public function subcriptions()
    {
        $transactions = $this->transactionService->getUserTransactions();

        return view('front.subcriptions', compact('transactions'));
    }

    public function subcription_details(Transaction $transaction)
    {
        return view('front.subcription_details', compact('transaction'));
    }
}
