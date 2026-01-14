<?php

namespace App\Repositories\PricingRepository;

use App\Models\Pricing;
use Illuminate\Support\Collection;

interface PricingRepositoryInterface
{
    // Membuat kontrak yang akan digunakan pada Service

    public function findById(int $id): ?Pricing;

    public function getAll(): Collection;
}
