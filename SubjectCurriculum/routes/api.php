<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\PrerequisiteController;

// API routes for subject mapping
Route::get('/curriculums', [CurriculumController::class, 'getCurriculums']);
Route::get('/curriculums/{id}', [CurriculumController::class, 'getCurriculumData']);
Route::post('/curriculums/save', [CurriculumController::class, 'saveSubjects']);
Route::get('/curriculums/{id}/with-subjects', [CurriculumController::class, 'getCurriculumWithSubjects']);

// Routes for handling subjects
Route::get('/subjects', [CurriculumController::class, 'getAllSubjects']);
Route::post('/subjects', [CurriculumController::class, 'storeSubject']);

// AI-powered lesson generation routes
Route::post('/generate-lesson-topics', [CurriculumController::class, 'generateLessonTopics']);
Route::post('/generate-lesson-plan', [CurriculumController::class, 'generateLessonPlan']);

// Prerequisite routes
Route::get('/prerequisites/{curriculumId}', [PrerequisiteController::class, 'getPrerequisites']);
Route::post('/prerequisites', [PrerequisiteController::class, 'savePrerequisites']);