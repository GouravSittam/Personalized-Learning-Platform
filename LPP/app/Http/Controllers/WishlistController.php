<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function store(Course $course)
    {
        $user = auth()->user();

        // Check if already in wishlist
        if ($user->wishlistedCourses()->where('course_id', $course->id)->exists()) {
            return redirect()->back()->with('error', 'Course is already in your wishlist.');
        }

        // Add to wishlist
        $user->wishlistedCourses()->attach($course->id);

        return redirect()->back()->with('success', 'Course added to wishlist!');
    }

    public function destroy(Course $course)
    {
        $user = auth()->user();
        $user->wishlistedCourses()->detach($course->id);

        return redirect()->back()->with('success', 'Course removed from wishlist.');
    }
}
