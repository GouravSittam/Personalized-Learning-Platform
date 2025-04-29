<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ProfileViewController;
use App\Http\Controllers\LearningPathController;
use App\Http\Controllers\CourseSectionController;
use App\Http\Controllers\CourseLessonController;
use Illuminate\Support\Facades\Route;

// Learning Path Platform Routes
Route::get('/', function () {
    return view('home');
})->name('home');

// Public Routes
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/paths', [LearningPathController::class, 'index'])->name('paths.index');
Route::get('/paths/{path}', [LearningPathController::class, 'show'])->name('paths.show');

// Authentication Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Profile Routes
    Route::get('/profile', [ProfileViewController::class, 'show'])->name('profile.show');
    Route::get('/profile/settings', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/settings', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/settings', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Course Enrollment Routes
    Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'store'])->name('courses.enroll');
    Route::delete('/courses/{course}/enroll', [EnrollmentController::class, 'destroy'])->name('courses.unenroll');
    
    // Course Creation Route
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    
    // Wishlist Routes
    Route::post('/courses/{course}/wishlist', [WishlistController::class, 'store'])->name('courses.wishlist');
    Route::delete('/courses/{course}/wishlist', [WishlistController::class, 'destroy'])->name('courses.unwishlist');

    // Learning Path Routes
    Route::post('/paths/{path}/start', [LearningPathController::class, 'start'])->name('paths.start');
    Route::post('/paths/{path}/progress', [LearningPathController::class, 'progress'])->name('paths.progress');

    // Course Content Management Routes
    Route::middleware('verified')->group(function () {
        // Section Routes
        Route::post('/courses/{course}/sections', [CourseSectionController::class, 'store'])->name('sections.store');
        Route::put('/sections/{section}', [CourseSectionController::class, 'update'])->name('sections.update');
        Route::delete('/sections/{section}', [CourseSectionController::class, 'destroy'])->name('sections.destroy');
        Route::post('/sections/reorder', [CourseSectionController::class, 'reorder'])->name('sections.reorder');

        // Lesson Routes
        Route::post('/sections/{section}/lessons', [CourseLessonController::class, 'store'])->name('lessons.store');
        Route::get('/lessons/{lesson}', [CourseLessonController::class, 'show'])->name('lessons.show');
        Route::put('/lessons/{lesson}', [CourseLessonController::class, 'update'])->name('lessons.update');
        Route::delete('/lessons/{lesson}', [CourseLessonController::class, 'destroy'])->name('lessons.destroy');
        Route::post('/lessons/reorder', [CourseLessonController::class, 'reorder'])->name('lessons.reorder');
        Route::post('/lessons/{lesson}/complete', [CourseLessonController::class, 'markAsComplete'])->name('lessons.complete');
    });
});

require __DIR__.'/auth.php';
