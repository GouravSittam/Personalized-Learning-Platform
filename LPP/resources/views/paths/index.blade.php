@extends('layouts.app')

@section('content')
<div class="gradient-bg min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="heading-1 mb-4">Learning Paths</h1>
            <p class="text-lg text-neutral-600 max-w-2xl mx-auto">
                Follow structured learning paths designed by experts to master complete skill sets and achieve your career goals.
            </p>
        </div>

        <!-- Learning Paths Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @forelse($learningPaths as $path)
            <div class="modern-card slide-up">
                <div class="relative">
                    @if($path->image_url)
                        <img src="{{ $path->image_url }}" alt="{{ $path->title }}" class="w-full h-64 object-cover">
                    @else
                        <div class="w-full h-64 bg-gradient-to-r from-primary-100 to-accent-100 flex items-center justify-center">
                            <svg class="w-16 h-16 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                    @endif
                    <div class="absolute top-4 right-4">
                        <span class="badge badge-primary">{{ ucfirst($path->difficulty_level) }}</span>
                    </div>
                </div>

                <div class="p-6">
                    <h2 class="heading-2 mb-4">{{ $path->title }}</h2>
                    <p class="text-neutral-600 mb-6">{{ $path->description }}</p>

                    @if($path->courses->isNotEmpty())
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-neutral-800 mb-3">Path Includes:</h3>
                        <div class="space-y-3">
                            @foreach($path->courses as $course)
                            <div class="flex items-center space-x-3 text-neutral-600">
                                <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ $course->title }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-neutral-600">{{ $path->estimated_duration }} hours</span>
                        </div>

                        @auth
                            @if(auth()->user()->learningPaths()->where('learning_path_id', $path->id)->exists())
                                <a href="{{ route('paths.show', $path) }}" class="btn-secondary">
                                    Continue Path
                                </a>
                            @else
                                <form action="{{ route('paths.start', $path) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-primary">
                                        Start Path
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn-primary">
                                Login to Start
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-2 glass-effect rounded-xl p-12 text-center">
                <svg class="mx-auto h-16 w-16 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="heading-3 mt-4">No learning paths available</h3>
                <p class="text-neutral-600 mt-2">Check back later for new learning paths.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection 