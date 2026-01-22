<?php

namespace App\Repositories\CourseRepository;

use App\Models\Course;
use Illuminate\Support\Collection;

class CourseRepository implements CourseRepositoryInterface
{
    public function searchByKeyword(string $keyword): Collection
    {
        return Course::where('name', 'LIKE', "%{$keyword}%")
            ->orWhere('about', 'LIKE', "%{$keyword}%")
            ->get();

    }

    public function getAllCategory(): Collection
    {
        return Course::with('category')->latest()->get();
    }
}
