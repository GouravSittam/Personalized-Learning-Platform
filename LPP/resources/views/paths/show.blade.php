@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Learning Path Header -->
        <div class="relative">
            @if($path->image_url)
                <img src="{{ $path->image_url }}" alt="{{ $path->title }}" class="w-full h-64 object-cover">
            @else
                <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-400">No image available</span>
                </div>
            @endif
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6">
                <h1 class="text-3xl font-bold text-white mb-2">{{ $path->title }}</h1>
                <div class="flex items-center gap-4">
                    <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded">
                        {{ ucfirst($path->difficulty_level) }}
                    </span>
                    <span class="text-white">{{ $path->estimated_duration }} hours</span>
                </div>
            </div>
        </div>

        <!-- Learning Path Content -->
        <div class="p-6">
            <!-- Description -->
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">Path Description</h2>
                <p class="text-gray-600">{{ $path->description }}</p>
            </div>

            @auth
                @if($userProgress)
                    <!-- Progress Section -->
                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-2">
                            <h2 class="text-xl font-semibold">Your Progress</h2>
                            <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded">
                                {{ ucfirst($userProgress->pivot->status) }}
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $userProgress->pivot->progress_percentage }}%"></div>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">{{ $userProgress->pivot->progress_percentage }}% Complete</p>
                        @if($userProgress->pivot->completed_at)
                            <p class="text-sm text-gray-600 mt-1">
                                Completed on {{ $userProgress->pivot->completed_at->format('M d, Y') }}
                            </p>
                        @endif
                    </div>
                @endif
            @endauth

            <!-- Course List -->
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">Courses in this Path</h2>
                <div class="space-y-4">
                    @foreach($path->courses as $index => $course)
                        <div class="border rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold">{{ $index + 1 }}. {{ $course->title }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($course->description, 100) }}</p>
                                </div>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                    {{ $course->difficulty_level }}
                                </span>
                            </div>
                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-sm text-gray-600">{{ $course->duration_in_hours }} hours</span>
                                @auth
                                    @if($userProgress)
                                        @php
                                            $enrollment = auth()->user()->enrolledCourses()->where('course_id', $course->id)->first();
                                        @endphp
                                        @if($enrollment)
                                            <div class="flex items-center gap-4">
                                                <div class="flex items-center gap-2">
                                                    <div class="w-20 bg-gray-200 rounded-full h-1.5">
                                                        <div class="bg-blue-600 h-1.5 rounded-full" style="width: {{ $enrollment->pivot->progress_percentage }}%"></div>
                                                    </div>
                                                    <span class="text-sm text-gray-600">{{ $enrollment->pivot->progress_percentage }}%</span>
                                                </div>
                                                <a href="{{ route('courses.show', $course) }}" 
                                                   class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                    {{ $enrollment->pivot->status === 'completed' ? 'Review Course' : 'Continue Course' }} →
                                                </a>
                                            </div>
                                        @else
                                            <span class="text-gray-400">Locked</span>
                                        @endif
                                    @else
                                        <a href="{{ route('courses.show', $course) }}" 
                                           class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                            View Course →
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        Login to Start →
                                    </a>
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Action Buttons -->
            @auth
                @if(!$userProgress)
                    <form action="{{ route('paths.start', $path) }}" method="POST" class="mt-8">
                        @csrf
                        <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                            Start Learning Path
                        </button>
                    </form>
                @else
                    <div class="mt-8 flex gap-4">
                        @if($path->courses->isNotEmpty())
                            <a href="{{ route('courses.show', $path->courses->first()) }}" 
                               class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors text-center">
                                Continue Learning
                            </a>
                        @endif
                        <form action="{{ route('paths.progress', $path) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full border border-blue-600 text-blue-600 px-6 py-3 rounded-lg hover:bg-blue-50 transition-colors">
                                Update Progress
                            </button>
                        </form>
                    </div>
                @endif
            @else
                <div class="mt-8">
                    <a href="{{ route('login') }}" class="block w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors text-center">
                        Login to Start Learning Path
                    </a>
                </div>
            @endauth
        </div>
    </div>
</div>
@endsection 