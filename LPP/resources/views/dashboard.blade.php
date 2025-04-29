@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-2xl font-bold mb-6">My Learning Dashboard</h1>
        
        <!-- Learning Progress Section -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">My Learning Progress</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-blue-50 p-4 rounded-lg">
                    <h3 class="font-medium text-blue-800">Courses In Progress</h3>
                    <p class="text-2xl font-bold text-blue-600">{{ auth()->user()->enrolledCourses()->where('status', 'in_progress')->count() }}</p>
                </div>
                <div class="bg-green-50 p-4 rounded-lg">
                    <h3 class="font-medium text-green-800">Completed Courses</h3>
                    <p class="text-2xl font-bold text-green-600">{{ auth()->user()->enrolledCourses()->where('status', 'completed')->count() }}</p>
                </div>
                <div class="bg-purple-50 p-4 rounded-lg">
                    <h3 class="font-medium text-purple-800">Wishlisted Courses</h3>
                    <p class="text-2xl font-bold text-purple-600">{{ auth()->user()->wishlistedCourses()->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Enrolled Courses Section -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">My Enrolled Courses</h2>
            @if(auth()->user()->enrolledCourses()->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach(auth()->user()->enrolledCourses as $course)
                        <div class="border rounded-lg p-4">
                            <h3 class="font-semibold mb-2">{{ $course->title }}</h3>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-gray-600">Progress: {{ $course->pivot->progress_percentage }}%</span>
                                <span class="text-sm text-gray-600">{{ $course->duration_in_hours }} hours</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $course->pivot->progress_percentage }}%"></div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('courses.show', $course) }}" class="text-blue-600 hover:text-blue-800">Continue Learning →</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">You haven't enrolled in any courses yet.</p>
            @endif
        </div>

        <!-- Wishlisted Courses Section -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">My Wishlist</h2>
            @if(auth()->user()->wishlistedCourses()->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach(auth()->user()->wishlistedCourses as $course)
                        <div class="border rounded-lg p-4">
                            <h3 class="font-semibold mb-2">{{ $course->title }}</h3>
                            <p class="text-sm text-gray-600 mb-4">{{ Str::limit($course->description, 100) }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">{{ $course->duration_in_hours }} hours</span>
                                <a href="{{ route('courses.show', $course) }}" class="text-blue-600 hover:text-blue-800">View Course →</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">Your wishlist is empty.</p>
            @endif
        </div>

        <!-- Learning Path Progress -->
        <div>
            <h2 class="text-xl font-semibold mb-4">My Learning Path</h2>
            <div class="border rounded-lg p-4">
                <p class="text-gray-500">Your personalized learning path will appear here once you start your journey.</p>
            </div>
        </div>
    </div>
</div>
@endsection
