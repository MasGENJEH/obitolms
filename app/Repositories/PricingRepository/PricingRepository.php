<?php

namespace App\Repositories\PricingRepository;

use App\Models\Pricing;
use Illuminate\Support\Collection;
use App\Repositories\PricingRepository\PricingRepositoryInterface;

class PricingRepository implements PricingRepositoryInterface
{
    public function findById(int $id): ?Pricing
    {
        return Pricing::find($id);
    }

    public function getAll(): Collection
    {
        return Pricing::all();
    }
}
