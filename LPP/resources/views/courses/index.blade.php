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
                <div class="modern-card overflow-hidden fade-in transform hover:scale-105 transition-transform duration-300">
                    <div class="relative group">
                        <a href="{{ route('courses.show', $course) }}" class="block">
                            @php
                                $courseImages = [
                                    'web-development' => 'https://media.istockphoto.com/id/2151904502/photo/closeup-young-man-software-developers-using-computer-to-write-code-application-program-for-ai.jpg?s=1024x1024&w=is&k=20&c=Ni1sxybLm2zNGhH5zhbXnR88JLZG5Xs6Kr4LZwC_m0U=',
                                    'data-science' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
                                    'python' => 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
                                    'javascript' => 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
                                    'mobile-development' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
                                    'cloud-computing' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
                                ];
                                
                                $defaultImage = 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60';
                                
                                $courseImage = $course->image_url ?? $courseImages[strtolower($course->category ?? '')] ?? $defaultImage;
                            @endphp
                            
                            <img src="{{ $courseImage }}" alt="{{ $course->title }}" 
                                 class="w-full h-48 object-cover transform group-hover:scale-110 transition-transform duration-300"
                                 onerror="this.src='{{ $defaultImage }}'">
                            
                            <div class="absolute top-4 right-4">
                                <span class="badge badge-primary">Featured</span>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                                <h3 class="text-white font-semibold text-lg">{{ $course->title }}</h3>
                            </div>
                        </a>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="badge badge-accent">{{ ucfirst($course->difficulty_level) }}</span>
                            <span class="text-sm text-neutral-600">{{ $course->duration_in_hours }} hours</span>
                        </div>
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
                <div class="modern-card overflow-hidden slide-up transform hover:scale-105 transition-transform duration-300">
                    <div class="relative group">
                        <a href="{{ route('courses.show', $course) }}" class="block">
                            @php
                                $courseImages = [
                                    'web-development' => 'https://media.istockphoto.com/id/2151904502/photo/closeup-young-man-software-developers-using-computer-to-write-code-application-program-for-ai.jpg?s=1024x1024&w=is&k=20&c=Ni1sxybLm2zNGhH5zhbXnR88JLZG5Xs6Kr4LZwC_m0U=',
                                    'data-science' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
                                    'python' => 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
                                    'javascript' => 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
                                    'mobile-development' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
                                    'cloud-computing' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
                                ];
                                
                                $defaultImage = 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60';
                                
                                $courseImage = $course->image_url ?? $courseImages[strtolower($course->category ?? '')] ?? $defaultImage;
                            @endphp
                            
                            <img src="{{ $courseImage }}" alt="{{ $course->title }}" 
                                 class="w-full h-48 object-cover transform group-hover:scale-110 transition-transform duration-300"
                                 onerror="this.src='{{ $defaultImage }}'">
                            
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                                <h3 class="text-white font-semibold text-lg">{{ $course->title }}</h3>
                            </div>
                        </a>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="badge badge-accent">{{ ucfirst($course->difficulty_level) }}</span>
                            <span class="text-sm text-neutral-600">{{ $course->duration_in_hours }} hours</span>
                        </div>
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