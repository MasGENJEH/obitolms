<?php

namespace App\Services;

use App\Models\Pricing;
use App\Repositories\PricingRepository\PricingRepositoryInterface;
use App\Repositories\TransactionRepository\TransactionRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class TransactionService
{
    protected $pricingRepository;
    protected $transactionRepository;

    public function __construct(
        TransactionRepositoryInterface $transactionRepository,
        PricingRepositoryInterface $pricingRepository
    ) {
        $this->pricingRepository = $pricingRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function prepareCheckout(Pricing $pricing)
    {
        $user = Auth::user();
        $alreadySubcribed = $pricing->isSubcribedByUser($user->id);

        $tax = 0.11;
        $total_tax_amount = $pricing->price * $tax;
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
            'alreadySubcribed',
            'started_at',
            'ended_at'
        );
    }

    public function getRecentPricing()
    {
        $pricingId = session()->get('pricing_id');

        // return Pricing::find($pricingId);
        return $this->pricingRepository->findById($pricingId);
    }

    public function getUserTransactions()
    {
        $user = Auth::user();

        if (!$user) {
            return collect();
        }

        // JIKA MENGGUNAKAN REPOSITORY

        return $this->transactionRepository->getUserTransactions($user->id);

        // JIKA TIDAK MENGGUNAKAN REPOSITORY

        // return Transaction::with('pricing')
        //     ->where('user_id', $user->id)
        //     ->orderBy('created_at', 'desc')
        //     ->get();
    }
}
