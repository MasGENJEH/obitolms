<?php

namespace App\Services;

use App\Repositories\PricingRepository\PricingRepositoryInterface;

class PricingService
{
    protected $pricingRepository;

    public function __construct(PricingRepositoryInterface $pricingRepository)
    {
        $this->pricingRepository = $pricingRepository;
    }

    public function getAllPackages()
    {
        return $this->pricingRepository->getAll();
    }

    // Digunakan ketika logic hanya digunakan sekali

    // public function getAllPackages()
    // {
    //     return $this->Pricing::all();
    // }
}
