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
                    <p class="text-xl font-bold text-neutral-900">156</p>
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
                    <p class="text-xl font-bold text-neutral-900">2,845</p>
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
                    <p class="text-xl font-bold text-neutral-900">1,234</p>
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
                    <p class="text-xl font-bold text-neutral-900">78%</p>
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
                    <p class="text-2xl font-bold text-primary-600">856</p>
                    <div class="mt-2">
                        <div class="progress-bar">
                            <div class="progress-bar-fill" style="width: 65%"></div>
                        </div>
                    </div>
                </div>
                <div class="bg-success-50 rounded-lg p-3 transform hover:scale-105 transition-transform duration-200">
                    <h3 class="text-sm font-semibold text-success-800 mb-2">Completed</h3>
                    <p class="text-2xl font-bold text-success-600">523</p>
                    <div class="mt-2">
                        <div class="progress-bar">
                            <div class="progress-bar-fill bg-success-600" style="width: 40%"></div>
                        </div>
                    </div>
                </div>
                <div class="bg-neutral-50 rounded-lg p-3 transform hover:scale-105 transition-transform duration-200">
                    <h3 class="text-sm font-semibold text-neutral-800 mb-2">Not Started</h3>
                    <p class="text-2xl font-bold text-neutral-600">321</p>
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
                <div class="course-card">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" 
                             alt="Web Development" 
                             class="course-card-image">
                        <div class="absolute top-2 right-2">
                            <span class="badge badge-success text-xs">
                                245 enrolled
                            </span>
                        </div>
                    </div>
                    <div class="course-card-content">
                        <h3 class="course-card-title text-base">Advanced Web Development</h3>
                        <p class="course-card-description text-xs">Master modern web development with React, Node.js, and MongoDB</p>
                        <div class="flex items-center justify-between mt-3">
                            <div class="flex items-center">
                                <img src="https://ui-avatars.com/api/?name=John+Doe&background=random" 
                                     alt="Instructor" 
                                     class="w-6 h-6 rounded-full mr-2">
                                <span class="text-xs text-neutral-600">John Doe</span>
                            </div>
                            <span class="text-xs font-medium text-primary-600">
                                8h 30m
                            </span>
                        </div>
                    </div>
                </div>

                <div class="course-card">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" 
                             alt="Data Science" 
                             class="course-card-image">
                        <div class="absolute top-2 right-2">
                            <span class="badge badge-success text-xs">
                                189 enrolled
                            </span>
                        </div>
                    </div>
                    <div class="course-card-content">
                        <h3 class="course-card-title text-base">Data Science Fundamentals</h3>
                        <p class="course-card-description text-xs">Learn data analysis, visualization, and machine learning basics</p>
                        <div class="flex items-center justify-between mt-3">
                            <div class="flex items-center">
                                <img src="https://ui-avatars.com/api/?name=Sarah+Smith&background=random" 
                                     alt="Instructor" 
                                     class="w-6 h-6 rounded-full mr-2">
                                <span class="text-xs text-neutral-600">Sarah Smith</span>
                            </div>
                            <span class="text-xs font-medium text-primary-600">
                                12h 15m
                            </span>
                        </div>
                    </div>
                </div>

                <div class="course-card">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1515879218367-8466d910aaa4?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" 
                             alt="Python Programming" 
                             class="course-card-image">
                        <div class="absolute top-2 right-2">
                            <span class="badge badge-success text-xs">
                                167 enrolled
                            </span>
                        </div>
                    </div>
                    <div class="course-card-content">
                        <h3 class="course-card-title text-base">Python for Beginners</h3>
                        <p class="course-card-description text-xs">Start your programming journey with Python basics</p>
                        <div class="flex items-center justify-between mt-3">
                            <div class="flex items-center">
                                <img src="https://ui-avatars.com/api/?name=Mike+Johnson&background=random" 
                                     alt="Instructor" 
                                     class="w-6 h-6 rounded-full mr-2">
                                <span class="text-xs text-neutral-600">Mike Johnson</span>
                            </div>
                            <span class="text-xs font-medium text-primary-600">
                                6h 45m
                            </span>
                        </div>
                    </div>
                </div>
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
                        <tr>
                            <td class="py-2">
                                <div class="flex items-center">
                                    <img class="h-6 w-6 rounded-full" 
                                         src="https://ui-avatars.com/api/?name=Alex+Brown&background=random" 
                                         alt="Alex Brown">
                                    <div class="ml-2">
                                        <div class="text-xs font-medium text-neutral-900">
                                            Alex Brown
                                        </div>
                                        <div class="text-xs text-neutral-500">
                                            alex.brown@example.com
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-2">
                                <div class="text-xs text-neutral-900">Advanced Web Development</div>
                                <div class="text-xs text-neutral-500">Web Development</div>
                            </td>
                            <td class="py-2">
                                <span class="badge badge-primary text-xs">
                                    In Progress
                                </span>
                            </td>
                            <td class="py-2">
                                <div class="w-full max-w-xs">
                                    <div class="progress-bar h-1.5">
                                        <div class="progress-bar-fill" style="width: 65%"></div>
                                    </div>
                                    <div class="text-xs text-neutral-500 mt-1">
                                        65% Complete
                                    </div>
                                </div>
                            </td>
                            <td class="py-2 text-xs text-neutral-500">
                                Mar 15, 2024
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2">
                                <div class="flex items-center">
                                    <img class="h-6 w-6 rounded-full" 
                                         src="https://ui-avatars.com/api/?name=Emma+Wilson&background=random" 
                                         alt="Emma Wilson">
                                    <div class="ml-2">
                                        <div class="text-xs font-medium text-neutral-900">
                                            Emma Wilson
                                        </div>
                                        <div class="text-xs text-neutral-500">
                                            emma.wilson@example.com
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-2">
                                <div class="text-xs text-neutral-900">Data Science Fundamentals</div>
                                <div class="text-xs text-neutral-500">Data Science</div>
                            </td>
                            <td class="py-2">
                                <span class="badge badge-success text-xs">
                                    Completed
                                </span>
                            </td>
                            <td class="py-2">
                                <div class="w-full max-w-xs">
                                    <div class="progress-bar h-1.5">
                                        <div class="progress-bar-fill" style="width: 100%"></div>
                                    </div>
                                    <div class="text-xs text-neutral-500 mt-1">
                                        100% Complete
                                    </div>
                                </div>
                            </td>
                            <td class="py-2 text-xs text-neutral-500">
                                Mar 10, 2024
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2">
                                <div class="flex items-center">
                                    <img class="h-6 w-6 rounded-full" 
                                         src="https://ui-avatars.com/api/?name=David+Lee&background=random" 
                                         alt="David Lee">
                                    <div class="ml-2">
                                        <div class="text-xs font-medium text-neutral-900">
                                            David Lee
                                        </div>
                                        <div class="text-xs text-neutral-500">
                                            david.lee@example.com
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-2">
                                <div class="text-xs text-neutral-900">Python for Beginners</div>
                                <div class="text-xs text-neutral-500">Programming</div>
                            </td>
                            <td class="py-2">
                                <span class="badge badge-accent text-xs">
                                    Not Started
                                </span>
                            </td>
                            <td class="py-2">
                                <div class="w-full max-w-xs">
                                    <div class="progress-bar h-1.5">
                                        <div class="progress-bar-fill" style="width: 0%"></div>
                                    </div>
                                    <div class="text-xs text-neutral-500 mt-1">
                                        0% Complete
                                    </div>
                                </div>
                            </td>
                            <td class="py-2 text-xs text-neutral-500">
                                Mar 18, 2024
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Sidebar Widgets -->
    <div class="col-lg-4">
        <!-- Upcoming Deadlines -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Upcoming Deadlines</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">Complete Module 3</h6>
                            <small class="text-muted">Web Development Fundamentals</small>
                        </div>
                        <span class="badge bg-danger">Due Tomorrow</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">Submit Assignment</h6>
                            <small class="text-muted">Data Science Basics</small>
                        </div>
                        <span class="badge bg-warning">3 days left</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Motivational Quote/Tip of the Day -->
        <div class="card mb-4">
            <div class="card-header bg-gradient-primary text-white">
                <h5 class="mb-0">Daily Inspiration</h5>
            </div>
            <div class="card-body">
                <div class="quote-container">
                    <div class="quote-icon mb-3">
                        <i class="fas fa-quote-left fa-2x text-primary"></i>
                    </div>
                    <p class="quote-text mb-3">"The expert in anything was once a beginner. Keep learning, keep growing!"</p>
                    <div class="quote-author text-end">
                        <small class="text-muted">- Learning Tip of the Day</small>
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-sm btn-outline-primary" id="refreshQuote">
                        <i class="fas fa-sync-alt me-2"></i>New Quote
                    </button>
                </div>
            </div>
        </div>

        <!-- Certificate Vault -->
        <!-- <div class="card mb-4">
            <div class="card-header bg-gradient-success text-white">
                <h5 class="mb-0">Certificate Vault</h5>
            </div>
            <div class="card-body">
                <div class="certificate-grid">
                    <div class="certificate-item">
                        <div class="certificate-preview">
                            <img src="{{ asset('images/certificates/web-dev-cert.jpg') }}" 
                                 alt="Web Development Certificate" 
                                 class="img-fluid rounded">
                            <div class="certificate-overlay">
                                <a href="{{ asset('images/certificates/web-dev-cert.jpg') }}" 
                                   class="btn btn-sm btn-light" 
                                   download="Web-Development-Certificate.jpg"
                                   title="Download Certificate">
                                    <i class="fas fa-download"></i>
                                </a>
                                <button class="btn btn-sm btn-light share-certificate" 
                                        data-certificate="web-dev-cert.jpg"
                                        title="Share Certificate">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                            </div>
                        </div>
                        <div class="certificate-info mt-2">
                            <h6 class="mb-1">Web Development Fundamentals</h6>
                            <small class="text-muted">Completed: June 15, 2023</small>
                        </div>
                    </div>
                    <div class="certificate-item">
                        <div class="certificate-preview">
                            <img src="{{ asset('images/certificates/data-science-cert.jpg') }}" 
                                 alt="Data Science Certificate" 
                                 class="img-fluid rounded">
                            <div class="certificate-overlay">
                                <a href="{{ asset('images/certificates/data-science-cert.jpg') }}" 
                                   class="btn btn-sm btn-light" 
                                   download="Data-Science-Certificate.jpg"
                                   title="Download Certificate">
                                    <i class="fas fa-download"></i>
                                </a>
                                <button class="btn btn-sm btn-light share-certificate" 
                                        data-certificate="data-science-cert.jpg"
                                        title="Share Certificate">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                            </div>
                        </div>
                        <div class="certificate-info mt-2">
                            <h6 class="mb-1">Data Science Basics</h6>
                            <small class="text-muted">Completed: May 20, 2023</small>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="#" class="btn btn-outline-success btn-sm">
                        <i class="fas fa-folder-open me-2"></i>View All Certificates
                    </a>
                </div>
            </div>
        </div> -->

        <!-- Achievement Progress -->
        <div class="card mb-4">
            <div class="card-header bg-gradient-info text-white">
                <h5 class="mb-0">Achievement Progress</h5>
            </div>
            <div class="card-body">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="mt-3">
                    <small class="text-muted">75% of the learning path completed</small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Quote Styles */
.quote-container {
    background-color: #f8f9fa;
    padding: 1.5rem;
    border-radius: 0.5rem;
    position: relative;
}

.quote-icon {
    color: #4e73df;
    opacity: 0.2;
}

.quote-text {
    font-style: italic;
    font-size: 1.1rem;
    line-height: 1.6;
}

/* Certificate Vault Styles */
.certificate-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.certificate-item {
    position: relative;
}

.certificate-preview {
    position: relative;
    overflow: hidden;
    border-radius: 0.5rem;
}

.certificate-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.5rem;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.certificate-preview:hover .certificate-overlay {
    opacity: 1;
}

.certificate-info {
    text-align: center;
}
</style>

<script>
// Quote Refresh Functionality
document.getElementById('refreshQuote').addEventListener('click', function() {
    const quotes = [
        {
            text: "The expert in anything was once a beginner. Keep learning, keep growing!",
            author: "Learning Tip of the Day"
        },
        {
            text: "Success is not final, failure is not fatal: it is the courage to continue that counts.",
            author: "Winston Churchill"
        },
        {
            text: "The more that you read, the more things you will know. The more that you learn, the more places you'll go.",
            author: "Dr. Seuss"
        },
        {
            text: "Learning is a treasure that will follow its owner everywhere.",
            author: "Chinese Proverb"
        },
        {
            text: "The beautiful thing about learning is that nobody can take it away from you.",
            author: "B.B. King"
        }
    ];
    
    const randomQuote = quotes[Math.floor(Math.random() * quotes.length)];
    document.querySelector('.quote-text').textContent = `"${randomQuote.text}"`;
    document.querySelector('.quote-author small').textContent = `- ${randomQuote.author}`;
});
</script>
@endsection