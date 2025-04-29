<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LearningPathController;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\ProgressTrackingController;
use App\Http\Controllers\API\SkillAssessmentController;
use App\Http\Controllers\API\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Authentication Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Learning Path Routes
    Route::apiResource('learning-paths', LearningPathController::class);
    Route::post('learning-paths/{learningPath}/complete', [LearningPathController::class, 'markAsCompleted']);
    Route::get('learning-paths/{learningPath}/progress', [LearningPathController::class, 'getProgress']);

    // Course Routes
    Route::apiResource('courses', CourseController::class);
    Route::get('courses/category/{category}', [CourseController::class, 'getByCategory']);
    Route::get('courses/difficulty/{level}', [CourseController::class, 'getByDifficultyLevel']);
    Route::post('courses/{course}/toggle-active', [CourseController::class, 'toggleActive']);

    // Progress Tracking Routes
    Route::apiResource('progress-tracking', ProgressTrackingController::class);
    Route::get('progress-tracking/learning-path/{learningPath}', [ProgressTrackingController::class, 'getProgressByLearningPath']);
    Route::get('progress-tracking/overall', [ProgressTrackingController::class, 'getOverallProgress']);

    // Skill Assessment Routes
    Route::apiResource('skill-assessments', SkillAssessmentController::class);
    Route::get('skill-assessments/skill/{skillName}/history', [SkillAssessmentController::class, 'getSkillHistory']);
    Route::get('skill-assessments/latest', [SkillAssessmentController::class, 'getLatestAssessments']);
    Route::get('skill-assessments/levels', [SkillAssessmentController::class, 'getSkillLevels']);
}); 