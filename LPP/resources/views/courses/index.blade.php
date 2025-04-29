@extends('layouts.app')

@section('content')
<div class="gradient-bg min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="heading-1 mb-4">Explore Our Courses</h1>
            <p class="text-lg text-neutral-600 max-w-2xl mx-auto">
                Discover a wide range of courses designed to help you master new skills and advance your career.
            </p>
        </div>

        <!-- Filters Section -->
        <div class="glass-effect rounded-xl p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="difficulty" class="block text-sm font-medium text-neutral-700 mb-2">Difficulty Level</label>
                    <select id="difficulty" class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500">
                        <option value="">All Levels</option>
                        <option value="beginner">Beginner</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="advanced">Advanced</option>
                    </select>
                </div>
                <div>
                    <label for="duration" class="block text-sm font-medium text-neutral-700 mb-2">Duration</label>
                    <select id="duration" class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500">
                        <option value="">Any Duration</option>
                        <option value="0-10">0-10 hours</option>
                        <option value="10-20">10-20 hours</option>
                        <option value="20+">20+ hours</option>
                    </select>
                </div>
                <div>
                    <label for="search" class="block text-sm font-medium text-neutral-700 mb-2">Search</label>
                    <input type="text" id="search" placeholder="Search courses..." 
                           class="w-full rounded-lg border-neutral-300 focus:border-primary-500 focus:ring-primary-500">
                </div>
            </div>
        </div>

        <!-- Featured Courses -->
        @if($courses->where('is_featured', true)->count() > 0)
        <div class="mb-12">
            <h2 class="heading-2 mb-6">Featured Courses</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($courses->where('is_featured', true) as $course)
                <div class="modern-card overflow-hidden fade-in">
                    <div class="relative">
                        @if($course->image_url)
                            <img src="{{ $course->image_url }}" alt="{{ $course->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-neutral-100 flex items-center justify-center">
                                <svg class="w-12 h-12 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4">
                            <span class="badge badge-primary">Featured</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="badge badge-accent">{{ ucfirst($course->difficulty_level) }}</span>
                            <span class="text-sm text-neutral-600">{{ $course->duration_in_hours }} hours</span>
                        </div>
                        <h3 class="heading-3 mb-2">{{ $course->title }}</h3>
                        <p class="text-neutral-600 mb-4">{{ Str::limit($course->description, 100) }}</p>
                        <div class="flex items-center justify-between">
                            @auth
                                @if(auth()->user()->enrolledCourses->contains($course->id))
                                    <a href="{{ route('courses.show', $course) }}" class="btn-secondary">Continue Learning</a>
                                @else
                                    <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-primary">Enroll Now</button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn-primary">Login to Enroll</a>
                            @endauth
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- All Courses -->
        <div>
            <h2 class="heading-2 mb-6">All Courses</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($courses->where('is_featured', false) as $course)
                <div class="modern-card overflow-hidden slide-up">
                    <div class="relative">
                        @if($course->image_url)
                            <img src="{{ $course->image_url }}" alt="{{ $course->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-neutral-100 flex items-center justify-center">
                                <svg class="w-12 h-12 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="badge badge-accent">{{ ucfirst($course->difficulty_level) }}</span>
                            <span class="text-sm text-neutral-600">{{ $course->duration_in_hours }} hours</span>
                        </div>
                        <h3 class="heading-3 mb-2">{{ $course->title }}</h3>
                        <p class="text-neutral-600 mb-4">{{ Str::limit($course->description, 100) }}</p>
                        <div class="flex items-center justify-between">
                            @auth
                                @if(auth()->user()->enrolledCourses->contains($course->id))
                                    <a href="{{ route('courses.show', $course) }}" class="btn-secondary">Continue Learning</a>
                                @else
                                    <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-primary">Enroll Now</button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn-primary">Login to Enroll</a>
                            @endauth
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="heading-3 mt-2">No courses available</h3>
                    <p class="text-neutral-600">Check back later for new courses.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection 