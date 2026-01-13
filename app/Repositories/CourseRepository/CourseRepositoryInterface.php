<?php

namespace App\Repositories\CourseRepository;

use Illuminate\Support\Collection;


interface CourseRepositoryInterface
{
    // Membuat kontrak yang akan digunakan pada Service

    public function seacrchByKeyword(string $keyword): Collection;

    public function getAllCategory(): Collection;
}
