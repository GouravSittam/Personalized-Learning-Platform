<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        try {
            // Get total number of courses
            $totalCourses = Course::count() ?? 0;

            // Get total number of students (users who have at least one enrollment)
            $totalStudents = User::whereHas('enrollments')->count() ?? 0;

            // Get total number of enrollments
            $totalEnrollments = Enrollment::count() ?? 0;

            // Get active enrollments (not completed)
            $activeEnrollments = Enrollment::where('status', 'in_progress')->count() ?? 0;

            // Get completed enrollments
            $completedEnrollments = Enrollment::where('status', 'completed')->count() ?? 0;

            // Calculate completion rate
            $completionRate = $totalEnrollments > 0 
                ? round(($completedEnrollments / $totalEnrollments) * 100) 
                : 0;

            // Get average progress across all enrollments
            $averageProgress = Enrollment::where('status', 'in_progress')
                ->avg('progress_percentage') ?? 0;

            // Get most popular courses (top 3)
            $popularCourses = Course::withCount(['enrollments' => function($query) {
                    $query->where('status', 'in_progress');
                }])
                ->orderBy('enrollments_count', 'desc')
                ->take(3)
                ->get();

            // Get recent enrollments with user and course details
            $recentEnrollments = Enrollment::with(['user', 'course'])
                ->latest()
                ->take(5)
                ->get();

            // Get enrollment statistics by status
            $enrollmentStats = [
                'in_progress' => Enrollment::where('status', 'in_progress')->count(),
                'completed' => Enrollment::where('status', 'completed')->count(),
                'not_started' => Enrollment::where('status', 'not_started')->count()
            ];

            return view('home', compact(
                'totalCourses',
                'totalStudents',
                'totalEnrollments',
                'activeEnrollments',
                'completedEnrollments',
                'completionRate',
                'averageProgress',
                'popularCourses',
                'recentEnrollments',
                'enrollmentStats'
            ));
        } catch (\Exception $e) {
            // Log the error
            \Log::error('HomeController error: ' . $e->getMessage());
            
            // Return view with default values
            return view('home', [
                'totalCourses' => 0,
                'totalStudents' => 0,
                'totalEnrollments' => 0,
                'activeEnrollments' => 0,
                'completedEnrollments' => 0,
                'completionRate' => 0,
                'averageProgress' => 0,
                'popularCourses' => collect(),
                'recentEnrollments' => collect(),
                'enrollmentStats' => [
                    'in_progress' => 0,
                    'completed' => 0,
                    'not_started' => 0
                ]
            ]);
        }
    }
} 