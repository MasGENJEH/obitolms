<?php

namespace App\Services;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use App\Repositories\CourseRepository\CourseRepository;

class CourseService
{
    protected $courseRepository;

    public function __construct(
        CourseRepository $courseRepository
    ) {
        $this->courseRepository = $courseRepository;
    }

    public function enrollUser(Course $course)
    {
        $user = Auth::user();

        if (!$course->courseStudents()->where('user_id', $user->id)->exists()) {
            $course->courseStudents()->create([
                'user_id' => $user->id,
                'is_active' => true,
            ]);
        }

        return $user->name;
    }

    public function getFirstSectionAndContent(Course $course)
    {
        $firstSectionId = $course->courseSections()->orderBy('id')->value('id');
        $firstContentId = $firstSectionId
            ? $course->courseSections()->find($firstSectionId)->sectionContents()->orderBy('id')->value('id') : null;

        return [
            'firstSectionId' => $firstSectionId,
            'firstContentId' => $firstContentId,
        ];
    }

    public function getLearningData(Course $course, $contentSectionId, $sectionContentId)
    {
        $course->load(['courseSections.sectionContents']);

        $currentSection = $course->courseSections->find($contentSectionId);
        $currentContent = $currentSection ? $currentSection->sectionContents->find($sectionContentId) : null;

        $nextContent = null;

        // Untuk Mengecek konten berikutnya
        if ($currentContent) {
            $nextContent = $currentSection->sectionContents
            ->where('id', '>', $currentContent->id)
            ->sortBy('id')
            ->first();
        }
        // Untuk Mengecek section berikutnya
        if (!$nextContent && $currentSection) {
            $nextSection = $course->courseSections
            ->where('id', '>', $currentSection->id)
            ->sortBy('id')
            ->first();

            // Mengambil data pertama jika section telah berganti
            if ($nextSection) {
                $nextContent = $nextSection->sectionContents->sortBy('id')->first();
            }
        }

        return [
            'course' => $course,
            'currentSection' => $currentSection,
            'currentContent' => $currentContent,
            'nextContent' => $nextContent,
            'isFinished' => !$nextContent,
        ];
    }

    public function searchCourses(string $keyword)
    {
        return $this->courseRepository->searchByKeyword($keyword);
    }

    public function getCoursesGroupByCategory()
    {
        $courses = $this->courseRepository->getAllCategory();

        return $courses->groupBy(function ($course) {
            return $course->category->name ?? 'Uncategorized';
        });
    }
}
