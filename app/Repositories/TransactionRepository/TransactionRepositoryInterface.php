<?php

namespace App\Repositories\TransactionRepository;

use App\Models\Transaction;
use Illuminate\Support\Collection;

interface TransactionRepositoryInterface
{
    public function findByBookingId(string $bookingId): ?Transaction;

    public function create(array $data): Transaction;

    public function getUserTransaction(int $userId): Collection;
}
