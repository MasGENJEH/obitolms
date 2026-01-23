<?php

namespace Tests\Unit\Repositories;

use App\Models\Category;
use App\Models\Course;
use App\Repositories\CourseRepository\CourseRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private CourseRepository $courseRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->courseRepository = new CourseRepository();
    }

    public function test_search_by_keyword_returns_matching_courses()
    {
        // Arrange
        $category = new Category();
        $category->name = 'Programming';
        $category->slug = 'programming';
        $category->save();

        $course1 = new Course();
        $course1->name = 'Laravel for Beginners';
        $course1->slug = 'laravel-for-beginners';
        $course1->about = 'Learn Laravel from scratch';
        $course1->thumbnail = 'thumbnail.jpg';
        $course1->is_popular = false;
        $course1->category_id = $category->id;
        $course1->save();

        $course2 = new Course();
        $course2->name = 'Advanced React Patterns';
        $course2->slug = 'advanced-react-patterns';
        $course2->about = 'Master React patterns';
        $course2->thumbnail = 'thumbnail.jpg';
        $course2->is_popular = true;
        $course2->category_id = $category->id;
        $course2->save();

        $course3 = new Course();
        $course3->name = 'Vue.js Essentials';
        $course3->slug = 'vue-js-essentials';
        $course3->about = 'Introduction to Vue.js';
        $course3->thumbnail = 'thumbnail.jpg';
        $course3->is_popular = false;
        $course3->category_id = $category->id;
        $course3->save();

        // Act
        $results = $this->courseRepository->searchByKeyword('Laravel');

        // Assert
        $this->assertCount(1, $results);
        $this->assertEquals('Laravel for Beginners', $results->first()->name);

        // Act - search by description
        $results = $this->courseRepository->searchByKeyword('Master');

        // Assert
        $this->assertCount(1, $results);
        $this->assertEquals('Advanced React Patterns', $results->first()->name);
    }

    public function test_get_all_category_returns_all_categories_with_courses()
    {
        // Arrange
        $category1 = new Category();
        $category1->name = 'Design';
        $category1->slug = 'design';
        $category1->save();

        $category2 = new Category();
        $category2->name = 'Development';
        $category2->slug = 'development';
        $category2->save();
        
        $course1 = new Course();

        $course1->name = 'UI/UX Basics';
        $course1->slug = 'ui-ux-basics';
        $course1->about = 'Learn design';
        $course1->thumbnail = 'thumbnail.jpg';
        $course1->is_popular = false;
        $course1->created_at = now()->subDay();
        $course1->category_id = $category1->id;
        $course1->save();

        $course2 = new Course();
        $course2->name = 'PHP Mastery';
        $course2->slug = 'php-mastery';
        $course2->about = 'Learn PHP';
        $course2->thumbnail = 'thumbnail.jpg';
        $course2->is_popular = true;
        $course2->created_at = now();
        $course2->category_id = $category2->id;
        $course2->save();

        // Act - Note: getAllCategory in repository actually returns COURSES with category, based on implementation
        // public function getAllCategory(): Collection { return Course::with('category')->latest()->get(); }
        // The method name is slightly misleading in the repository given its implementation, but we test the behavior.
        $results = $this->courseRepository->getAllCategory();

        // Assert
        $this->assertCount(2, $results);
        $this->assertTrue($results->first()->relationLoaded('category'));
        // latest() should put the last created course first
        $this->assertEquals('PHP Mastery', $results->first()->name);
    }
}
