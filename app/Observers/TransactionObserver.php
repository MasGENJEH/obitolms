<?php

namespace App\Observers;

use App\Helpers\TransactionHelper;

class TransactionObserver
{
    public function creating($transaction): void // agar ketika membuat transaksi id langsung dibuat sebelum submit
    {
        $transaction->booking_trx_id = TransactionHelper::generateUniqueTrxId();
    }
}
