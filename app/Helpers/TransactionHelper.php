<?php

namespace App\Helpers;

use App\Models\Transaction;

class TransactionHelper
{
    public static function generateUniqueTrxId(): string
    {
        $prefix = 'SKUY';
        do {
            $randomString = $prefix.mt_rand(10000, 99999);
        } while (Transaction::where('booking_trx_id', $randomString)->exists()); // kondisi membuat kode terus tergenerate ketika kode sudah ada

        return $randomString;
    }
}
