@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 fade-in max-w-7xl">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-neutral-900">
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-primary-600 to-accent-600">
                Learning Platform Statistics
            </span>
        </h1>
        <span class="badge badge-primary text-xs">Dashboard</span>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Total Courses Card -->
        <div class="card card-hover scale-in" style="animation-delay: 0.1s">
            <div class="flex items-center justify-between p-4">
                <div>
                    <p class="text-xs font-medium text-neutral-600">Total Courses</p>
                    <p class="text-xl font-bold text-neutral-900">{{ $totalCourses ?? 0 }}</p>
                </div>
                <div class="p-2 bg-primary-50 rounded-full">
                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
            </div>
            <div class="px-4 pb-3">
                <div class="text-xs text-neutral-500">
                    <span class="inline-flex items-center text-success-600">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                        </svg>
                        12% increase
                    </span>
                    from last month
                </div>
            </div>
        </div>

        <!-- Total Students Card -->
        <div class="card card-hover scale-in" style="animation-delay: 0.2s">
            <div class="flex items-center justify-between p-4">
                <div>
                    <p class="text-xs font-medium text-neutral-600">Total Students</p>
                    <p class="text-xl font-bold text-neutral-900">{{ $totalStudents ?? 0 }}</p>
                </div>
                <div class="p-2 bg-accent-50 rounded-full">
                    <svg class="w-5 h-5 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="px-4 pb-3">
                <div class="text-xs text-neutral-500">
                    <span class="inline-flex items-center text-success-600">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                        </svg>
                        8% increase
                    </span>
                    from last month
                </div>
            </div>
        </div>

        <!-- Active Enrollments Card -->
        <div class="card card-hover scale-in" style="animation-delay: 0.3s">
            <div class="flex items-center justify-between p-4">
                <div>
                    <p class="text-xs font-medium text-neutral-600">Active Enrollments</p>
                    <p class="text-xl font-bold text-neutral-900">{{ $activeEnrollments ?? 0 }}</p>
                </div>
                <div class="p-2 bg-primary-50 rounded-full">
                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
            </div>
            <div class="px-4 pb-3">
                <div class="text-xs text-neutral-500">
                    <span class="inline-flex items-center text-success-600">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                        </svg>
                        15% increase
                    </span>
                    from last month
                </div>
            </div>
        </div>

        <!-- Completion Rate Card -->
        <div class="card card-hover scale-in" style="animation-delay: 0.4s">
            <div class="flex items-center justify-between p-4">
                <div>
                    <p class="text-xs font-medium text-neutral-600">Completion Rate</p>
                    <p class="text-xl font-bold text-neutral-900">{{ $completionRate ?? 0 }}%</p>
                </div>
                <div class="p-2 bg-accent-50 rounded-full">
                    <svg class="w-5 h-5 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
            </div>
            <div class="px-4 pb-3">
                <div class="text-xs text-neutral-500">
                    <span class="inline-flex items-center text-warning-600">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                        2% decrease
                    </span>
                    from last month
                </div>
            </div>
        </div>
    </div>

    <!-- Enrollment Statistics Section -->
    <div class="card mb-6 slide-up" style="animation-delay: 0.5s">
        <div class="p-4">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-neutral-900">Enrollment Statistics</h2>
                <span class="tooltip">
                    <svg class="w-4 h-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="tooltip-text">Statistics for the current month</span>
                </span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-primary-50 rounded-lg p-3 transform hover:scale-105 transition-transform duration-200">
                    <h3 class="text-sm font-semibold text-primary-800 mb-2">In Progress</h3>
                    <p class="text-2xl font-bold text-primary-600">{{ $enrollmentStats['in_progress'] ?? 0 }}</p>
                    <div class="mt-2">
                        <div class="progress-bar">
                            <div class="progress-bar-fill" style="width: 65%"></div>
                        </div>
                    </div>
                </div>
                <div class="bg-success-50 rounded-lg p-3 transform hover:scale-105 transition-transform duration-200">
                    <h3 class="text-sm font-semibold text-success-800 mb-2">Completed</h3>
                    <p class="text-2xl font-bold text-success-600">{{ $enrollmentStats['completed'] ?? 0 }}</p>
                    <div class="mt-2">
                        <div class="progress-bar">
                            <div class="progress-bar-fill bg-success-600" style="width: 40%"></div>
                        </div>
                    </div>
                </div>
                <div class="bg-neutral-50 rounded-lg p-3 transform hover:scale-105 transition-transform duration-200">
                    <h3 class="text-sm font-semibold text-neutral-800 mb-2">Not Started</h3>
                    <p class="text-2xl font-bold text-neutral-600">{{ $enrollmentStats['not_started'] ?? 0 }}</p>
                    <div class="mt-2">
                        <div class="progress-bar">
                            <div class="progress-bar-fill bg-neutral-600" style="width: 25%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Courses Section -->
    <div class="card mb-6 slide-up" style="animation-delay: 0.6s">
        <div class="p-4">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-neutral-900">Most Popular Courses</h2>
                <a href="{{ route('courses.index') }}" class="btn-secondary text-xs">View All Courses</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @forelse($popularCourses ?? [] as $course)
                <div class="course-card">
                    <div class="relative">
                        <img src="{{ $course->image_url ?? asset('images/default-course.jpg') }}" 
                             alt="{{ $course->title ?? 'Course' }}" 
                             class="course-card-image">
                        <div class="absolute top-2 right-2">
                            <span class="badge badge-success text-xs">
                                {{ $course->enrollments_count ?? 0 }} enrolled
                            </span>
                        </div>
                    </div>
                    <div class="course-card-content">
                        <h3 class="course-card-title text-base">{{ $course->title ?? 'Untitled Course' }}</h3>
                        <p class="course-card-description text-xs">{{ $course->description ?? 'No description available' }}</p>
                        <div class="flex items-center justify-between mt-3">
                            <div class="flex items-center">
                                <img src="{{ $course->instructor_avatar ?? asset('images/default-avatar.jpg') }}" 
                                     alt="Instructor" 
                                     class="w-6 h-6 rounded-full mr-2">
                                <span class="text-xs text-neutral-600">{{ $course->instructor_name ?? 'Unknown Instructor' }}</span>
                            </div>
                            <span class="text-xs font-medium text-primary-600">
                                {{ $course->duration ?? '0h 0m' }}
                            </span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3">
                    <div class="empty-state py-6">
                        <div class="empty-state-icon">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-neutral-900 mb-1">No Popular Courses</h3>
                        <p class="text-sm text-neutral-600">There are no popular courses to display at the moment.</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Recent Enrollments Section -->
    <div class="card slide-up" style="animation-delay: 0.7s">
        <div class="p-4">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-neutral-900">Recent Enrollments</h2>
                <button class="btn-secondary text-xs">Export Report</button>
            </div>
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th class="py-2 text-xs">Student</th>
                            <th class="py-2 text-xs">Course</th>
                            <th class="py-2 text-xs">Status</th>
                            <th class="py-2 text-xs">Progress</th>
                            <th class="py-2 text-xs">Enrolled Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-200">
                        @forelse($recentEnrollments ?? [] as $enrollment)
                        <tr>
                            <td class="py-2">
                                <div class="flex items-center">
                                    <img class="h-6 w-6 rounded-full" 
                                         src="{{ $enrollment->user->avatar ?? asset('images/default-avatar.jpg') }}" 
                                         alt="{{ $enrollment->user->name ?? 'User' }}">
                                    <div class="ml-2">
                                        <div class="text-xs font-medium text-neutral-900">
                                            {{ $enrollment->user->name ?? 'Unknown User' }}
                                        </div>
                                        <div class="text-xs text-neutral-500">
                                            {{ $enrollment->user->email ?? '' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-2">
                                <div class="text-xs text-neutral-900">{{ $enrollment->course->title ?? 'Unknown Course' }}</div>
                                <div class="text-xs text-neutral-500">{{ $enrollment->course->category ?? 'Uncategorized' }}</div>
                            </td>
                            <td class="py-2">
                                @php
                                    $statusColor = [
                                        'completed' => 'badge-success',
                                        'in_progress' => 'badge-primary',
                                        'not_started' => 'badge-accent'
                                    ][$enrollment->status ?? 'not_started'];
                                @endphp
                                <span class="badge {{ $statusColor }} text-xs">
                                    {{ ucfirst($enrollment->status ?? 'unknown') }}
                                </span>
                            </td>
                            <td class="py-2">
                                <div class="w-full max-w-xs">
                                    <div class="progress-bar h-1.5">
                                        <div class="progress-bar-fill" style="width: {{ $enrollment->progress_percentage ?? 0 }}%"></div>
                                    </div>
                                    <div class="text-xs text-neutral-500 mt-1">
                                        {{ $enrollment->progress_percentage ?? 0 }}% Complete
                                    </div>
                                </div>
                            </td>
                            <td class="py-2 text-xs text-neutral-500">
                                {{ $enrollment->created_at ? $enrollment->created_at->format('M d, Y') : 'N/A' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center">
                                <div class="empty-state py-4">
                                    <div class="empty-state-icon">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm">No recent enrollments</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection