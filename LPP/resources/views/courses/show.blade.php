@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Course Header -->
        <div class="relative">
            @if($course->image_url)
                <img src="{{ $course->image_url }}" alt="{{ $course->title }}" class="w-full h-64 object-cover">
            @else
                <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-400">No image available</span>
                </div>
            @endif
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6">
                <h1 class="text-3xl font-bold text-white mb-2">{{ $course->title }}</h1>
                <div class="flex items-center gap-4">
                    <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded">
                        {{ ucfirst($course->difficulty_level) }}
                    </span>
                    <span class="text-white">{{ $course->duration_in_hours }} hours</span>
                </div>
            </div>
        </div>

        <!-- Course Content -->
        <div class="p-6">
            <!-- Description -->
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">Course Description</h2>
                <p class="text-gray-600">{{ $course->description }}</p>
            </div>

            <!-- Skills You'll Learn -->
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">Skills You'll Learn</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($course->skills_covered as $skill)
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-600">{{ $skill }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Prerequisites -->
            @if($course->prerequisites)
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">Prerequisites</h2>
                <ul class="list-disc list-inside text-gray-600">
                    @foreach($course->prerequisites as $prerequisite)
                        <li>{{ $prerequisite }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Course Content Sections -->
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">Course Content</h2>
                <div class="space-y-6">
                    @foreach($course->sections as $section)
                        <div class="border rounded-lg overflow-hidden">
                            <div class="bg-gray-50 p-4">
                                <h3 class="text-lg font-semibold">{{ $section->title }}</h3>
                                @if($section->description)
                                    <p class="text-gray-600 mt-1">{{ $section->description }}</p>
                                @endif
                            </div>
                            <div class="divide-y">
                                @foreach($section->lessons as $lesson)
                                    <div class="p-4 flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            @if($lesson->is_preview)
                                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                                    Preview
                                                </span>
                                            @endif
                                            <div>
                                                <h4 class="font-medium">{{ $lesson->title }}</h4>
                                                <p class="text-sm text-gray-600">{{ $lesson->duration_in_minutes }} minutes</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            @auth
                                                @if(auth()->user()->enrolledCourses()->where('course_id', $course->id)->exists())
                                                    <a href="{{ route('lessons.show', $lesson) }}" class="text-blue-600 hover:text-blue-800">
                                                        Start Lesson
                                                    </a>
                                                @else
                                                    <span class="text-gray-400">Enroll to access</span>
                                                @endif
                                            @else
                                                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800">
                                                    Login to access
                                                </a>
                                            @endauth
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Course Actions -->
            <div class="mt-8 flex gap-4">
                @auth
                    @if(auth()->user()->enrolledCourses()->where('course_id', $course->id)->exists())
                        <form action="{{ route('courses.unenroll', $course) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition-colors">
                                Unenroll
                            </button>
                        </form>
                    @else
                        <form action="{{ route('courses.enroll', $course) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                                Enroll Now
                            </button>
                        </form>
                    @endif

                    @if(auth()->user()->wishlistedCourses()->where('course_id', $course->id)->exists())
                        <form action="{{ route('courses.unwishlist', $course) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="border border-red-600 text-red-600 px-6 py-3 rounded-lg hover:bg-red-50 transition-colors">
                                Remove from Wishlist
                            </button>
                        </form>
                    @else
                        <form action="{{ route('courses.wishlist', $course) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="border border-blue-600 text-blue-600 px-6 py-3 rounded-lg hover:bg-blue-50 transition-colors">
                                Add to Wishlist
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                        Login to Enroll
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection 