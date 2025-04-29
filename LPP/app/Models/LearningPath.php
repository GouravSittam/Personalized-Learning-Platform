<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LearningPath extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'difficulty_level',
        'estimated_duration',
        'image_url',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute($value)
    {
        if (!$value) {
            return asset('images/default-path.jpg');
        }

        if (str_starts_with($value, 'http')) {
            return $value;
        }

        return Storage::url($value);
    }

    /**
     * Get the courses in this learning path.
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class)
            ->withPivot('order')
            ->withTimestamps();
    }

    /**
     * Get the users enrolled in this learning path.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_learning_path')
            ->withPivot('status', 'progress_percentage', 'completed_at')
            ->withTimestamps();
    }
}
