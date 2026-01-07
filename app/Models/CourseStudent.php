<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseStudent extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'course_id',
        'is_active',
    ];

    public function courses(): BelongsTo
    {
        return $this->hasMany(Course::class, 'course_id');
    }

    public function users(): BelongsTo
    {
        return $this->hasMany(User::class, 'user_id');
    }
}
