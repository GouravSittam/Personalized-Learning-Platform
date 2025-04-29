@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Profile Header -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="bg-blue-100 rounded-full p-3">
                    <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
                    <p class="text-gray-600">{{ $user->email }}</p>
                </div>
            </div>
            <a href="{{ route('profile.edit') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                Profile Settings →
            </a>
        </div>
    </div>

    <!-- Learning Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold mb-2">In Progress Courses</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $inProgressCourses->count() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold mb-2">Completed Courses</h3>
            <p class="text-3xl font-bold text-green-600">{{ $completedCourses->count() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold mb-2">Wishlisted Courses</h3>
            <p class="text-3xl font-bold text-purple-600">{{ $wishlistedCourses->count() }}</p>
        </div>
    </div>

    <!-- Courses In Progress -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <h2 class="text-xl font-bold mb-4">Courses In Progress</h2>
        @if($inProgressCourses->count() > 0)
            <div class="space-y-4">
                @foreach($inProgressCourses as $course)
                    <div class="border rounded-lg p-4">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h3 class="font-semibold">{{ $course->title }}</h3>
                                <p class="text-sm text-gray-600">{{ Str::limit($course->description, 100) }}</p>
                            </div>
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                {{ $course->difficulty_level }}
                            </span>
                        </div>
                        <div class="mt-4">
                            <div class="flex justify-between text-sm text-gray-600 mb-1">
                                <span>Progress</span>
                                <span>{{ $course->pivot->progress_percentage }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $course->pivot->progress_percentage }}%"></div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('courses.show', $course) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Continue Learning →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">You haven't started any courses yet.</p>
        @endif
    </div>

    <!-- Completed Courses -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <h2 class="text-xl font-bold mb-4">Completed Courses</h2>
        @if($completedCourses->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($completedCourses as $course)
                    <div class="border rounded-lg p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-semibold">{{ $course->title }}</h3>
                                <p class="text-sm text-gray-600">Completed on {{ $course->pivot->completed_at->format('M d, Y') }}</p>
                            </div>
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                Completed
                            </span>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('courses.show', $course) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Review Course →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">You haven't completed any courses yet.</p>
        @endif
    </div>

    <!-- Wishlist -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-xl font-bold mb-4">My Wishlist</h2>
        @if($wishlistedCourses->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($wishlistedCourses as $course)
                    <div class="border rounded-lg p-4">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h3 class="font-semibold">{{ $course->title }}</h3>
                                <p class="text-sm text-gray-600">{{ Str::limit($course->description, 100) }}</p>
                            </div>
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                {{ $course->difficulty_level }}
                            </span>
                        </div>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-sm text-gray-600">{{ $course->duration_in_hours }} hours</span>
                            <form action="{{ route('courses.unwishlist', $course) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                    Remove from Wishlist
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">Your wishlist is empty.</p>
        @endif
    </div>
</div>
@endsection 