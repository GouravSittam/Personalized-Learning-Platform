<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseLesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'title',
        'description',
        'content_type',
        'content',
        'duration_in_minutes',
        'order',
        'is_preview',
    ];

    protected $casts = [
        'content' => 'array',
        'is_preview' => 'boolean',
    ];

    /**
     * Get the section that owns the lesson.
     */
    public function section()
    {
        return $this->belongsTo(CourseSection::class, 'section_id');
    }

    /**
     * Get the progress records for the lesson.
     */
    public function progress()
    {
        return $this->hasMany(UserLessonProgress::class, 'lesson_id');
    }

    /**
     * Get the progress for a specific user.
     */
    public function userProgress($userId)
    {
        return $this->progress()->where('user_id', $userId)->first();
    }
} 