<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $featuredCourses = Course::where('is_featured', true)->take(6)->get();
        $courses = Course::latest()->paginate(12);
        
        return view('courses.index', compact('courses', 'featuredCourses'));
    }

    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|url',
            'duration' => 'required|string',
            'is_featured' => 'boolean',
        ]);

        $course = Course::create($validated);

        return redirect()->route('courses.show', $course)
            ->with('success', 'Course created successfully.');
    }
} 