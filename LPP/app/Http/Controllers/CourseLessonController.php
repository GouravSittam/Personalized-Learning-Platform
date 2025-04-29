<?php

namespace App\Http\Controllers;

use App\Models\CourseSection;
use App\Models\CourseLesson;
use Illuminate\Http\Request;

class CourseLessonController extends Controller
{
    public function store(Request $request, CourseSection $section)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content_type' => 'required|string|in:video,text,quiz',
            'content' => 'required|array',
            'duration_in_minutes' => 'required|integer|min:0',
            'order' => 'nullable|integer|min:0',
            'is_preview' => 'boolean',
        ]);

        $lesson = $section->lessons()->create($validated);

        return redirect()->back()->with('success', 'Lesson created successfully.');
    }

    public function show(CourseLesson $lesson)
    {
        $lesson->load('section.course');
        return view('lessons.show', compact('lesson'));
    }

    public function update(Request $request, CourseLesson $lesson)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content_type' => 'required|string|in:video,text,quiz',
            'content' => 'required|array',
            'duration_in_minutes' => 'required|integer|min:0',
            'order' => 'nullable|integer|min:0',
            'is_preview' => 'boolean',
        ]);

        $lesson->update($validated);

        return redirect()->back()->with('success', 'Lesson updated successfully.');
    }

    public function destroy(CourseLesson $lesson)
    {
        $lesson->delete();

        return redirect()->back()->with('success', 'Lesson deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'lessons' => 'required|array',
            'lessons.*.id' => 'required|exists:course_lessons,id',
            'lessons.*.order' => 'required|integer|min:0',
        ]);

        foreach ($validated['lessons'] as $lessonData) {
            CourseLesson::where('id', $lessonData['id'])
                ->update(['order' => $lessonData['order']]);
        }

        return response()->json(['message' => 'Lessons reordered successfully']);
    }

    public function markAsComplete(CourseLesson $lesson)
    {
        $user = auth()->user();
        
        $progress = $lesson->progress()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'status' => 'completed',
                'completed_at' => now(),
            ]
        );

        return response()->json([
            'message' => 'Lesson marked as complete',
            'progress' => $progress
        ]);
    }
} 