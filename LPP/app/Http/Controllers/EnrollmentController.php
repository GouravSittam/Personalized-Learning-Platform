<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function store(Course $course)
    {
        $user = auth()->user();

        // Check if already enrolled
        if ($user->enrolledCourses()->where('course_id', $course->id)->exists()) {
            return redirect()->back()->with('error', 'You are already enrolled in this course.');
        }

        // Create enrollment
        $user->enrolledCourses()->attach($course->id, [
            'status' => 'in_progress',
            'progress_percentage' => 0
        ]);

        return redirect()->route('courses.show', $course)
            ->with('success', 'Successfully enrolled in the course!');
    }

    public function destroy(Course $course)
    {
        $user = auth()->user();
        $user->enrolledCourses()->detach($course->id);

        return redirect()->back()->with('success', 'Successfully unenrolled from the course.');
    }
}
