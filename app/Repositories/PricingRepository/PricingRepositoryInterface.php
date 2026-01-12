<?php 

namespace App\Repositories\PricingRepository;

interface PricingRepositoryInterface
{

    // Membuat kontrak yang akan digunakan pada Service

    public function findById(int $id): ?Pricing;

    public function getAll(): Collection;

}
