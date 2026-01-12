<?php

namespace App\Service;

class TransactionService
{
    public function prepareCheckout(Pricing $pricing)
    {
        $user = Auth::user();
        $alreadySubcribed = $pricing->isSubscibedByUser($user->id);

        $tax = 0.11;
        $total_tax_amount = $pricing->price;
        $sub_total_amount = $pricing->price;
        $grand_total_amount = $sub_total_amount + $total_tax_amount;

        $started_at = now();
        $ended_at = $started_at->copy()->addMonths($pricing->duration);

        session()->put('pricing_id', $pricing->id);

        return compact(
            'total_tax_amount',
            'grand_total_amount',
            'sub_total_amount',
            'pricing',
            'user',
            'alreadySubscribed',
            'started_at',
            'ended_at'
        );
    }
}
