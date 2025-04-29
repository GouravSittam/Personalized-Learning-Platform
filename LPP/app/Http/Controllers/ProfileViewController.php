<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileViewController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        
        $enrolledCourses = $user->enrolledCourses()
            ->withPivot('status', 'progress_percentage', 'completed_at')
            ->get();
            
        $inProgressCourses = $enrolledCourses->where('pivot.status', 'in_progress');
        $completedCourses = $enrolledCourses->where('pivot.status', 'completed');
        $wishlistedCourses = $user->wishlistedCourses;

        return view('profile.show', compact(
            'user',
            'inProgressCourses',
            'completedCourses',
            'wishlistedCourses'
        ));
    }
}
