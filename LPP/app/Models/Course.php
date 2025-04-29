<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image_url',
        'difficulty_level',
        'duration_in_hours',
        'prerequisites',
        'skills_covered',
        'is_featured'
    ];

    protected $casts = [
        'prerequisites' => 'array',
        'skills_covered' => 'array',
        'is_featured' => 'boolean'
    ];

    protected $appends = ['image_url'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getImageUrlAttribute($value)
    {
        if (!$value) {
            return asset('images/default-course.jpg');
        }

        if (str_starts_with($value, 'http')) {
            return $value;
        }

        return Storage::url($value);
    }

    /**
     * Get the sections for the course.
     */
    public function sections()
    {
        return $this->hasMany(CourseSection::class)->orderBy('order');
    }

    /**
     * Get all lessons for the course through sections.
     */
    public function lessons()
    {
        return $this->hasManyThrough(CourseLesson::class, CourseSection::class, 'course_id', 'section_id');
    }

    /**
     * Get the learning paths that include this course.
     */
    public function learningPaths()
    {
        return $this->belongsToMany(LearningPath::class)
            ->withPivot('order')
            ->withTimestamps();
    }

    /**
     * Get the enrollments for the course.
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Get the users enrolled in this course.
     */
    public function enrolledUsers()
    {
        return $this->belongsToMany(User::class, 'enrollments')
            ->withPivot('status', 'progress_percentage', 'completed_at')
            ->withTimestamps();
    }

    /**
     * Get the wishlists for the course.
     */
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    /**
     * Get the users who have wishlisted this course.
     */
    public function wishlistedUsers()
    {
        return $this->belongsToMany(User::class, 'wishlists')
            ->withTimestamps();
    }
}
