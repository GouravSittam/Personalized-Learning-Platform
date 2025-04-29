<?php

namespace App\Http\Controllers;

use App\Models\LearningPath;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LearningPathController extends Controller
{
    public function index()
    {
        $learningPaths = LearningPath::with(['courses'])->get();
        return view('paths.index', compact('learningPaths'));
    }

    public function show(LearningPath $path)
    {
        $path->load(['courses']);
        $userProgress = null;

        if (auth()->check()) {
            $userProgress = auth()->user()->learningPaths()
                ->where('learning_path_id', $path->id)
                ->first();
        }

        return view('paths.show', compact('path', 'userProgress'));
    }

    public function start(LearningPath $path)
    {
        if (!auth()->user()->learningPaths()->where('learning_path_id', $path->id)->exists()) {
            auth()->user()->learningPaths()->attach($path->id, [
                'status' => 'in_progress',
                'progress_percentage' => 0,
                'current_course_id' => $path->courses->first()->id ?? null
            ]);
        }

        return redirect()->route('paths.show', $path)
            ->with('success', 'Learning path started successfully!');
    }

    public function progress(LearningPath $path)
    {
        $user = auth()->user();
        $userPath = $user->learningPaths()->where('learning_path_id', $path->id)->first();
        
        if (!$userPath) {
            return redirect()->route('paths.index')
                ->with('error', 'You need to start the learning path first.');
        }

        try {
            DB::beginTransaction();

            // Get all courses in the path
            $courses = $path->courses;
            $totalCourses = $courses->count();
            $completedCourses = 0;
            $totalProgress = 0;

            // Calculate progress for each course
            foreach ($courses as $course) {
                $enrollment = $user->enrolledCourses()
                    ->where('course_id', $course->id)
                    ->first();

                if ($enrollment) {
                    $totalProgress += $enrollment->pivot->progress_percentage;
                    if ($enrollment->pivot->status === 'completed') {
                        $completedCourses++;
                    }
                }
            }

            // Calculate overall progress
            $progressPercentage = $totalCourses > 0 
                ? round($totalProgress / $totalCourses) 
                : 0;

            // Update learning path progress
            $user->learningPaths()->updateExistingPivot($path->id, [
                'progress_percentage' => $progressPercentage,
                'status' => $completedCourses === $totalCourses ? 'completed' : 'in_progress',
                'completed_at' => $completedCourses === $totalCourses ? now() : null
            ]);

            DB::commit();

            return redirect()->route('paths.show', $path)
                ->with('success', 'Progress updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to update progress. Please try again.');
        }
    }
}
