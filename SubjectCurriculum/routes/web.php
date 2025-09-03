<?php

use App\Http\Controllers\CurriculumController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/curriculum_builder', function () {
    return view('curriculum_builder');
})->name('curriculum_builder');

// Route for creating a new curriculum
Route::post('/curriculum_builder', [CurriculumController::class, 'store'])->name('curriculum_builder.store');

Route::get('/subject_mapping', function () {
    return view('subject_mapping');
})->name('subject_mapping');

// API routes for subject mapping
Route::get('/api/curriculums', [CurriculumController::class, 'getCurriculums'])->name('api.curriculums');
Route::get('/api/curriculums/{id}', [CurriculumController::class, 'getCurriculumData']);
Route::post('/api/curriculums/save', [CurriculumController::class, 'saveSubjects']);
Route::get('/api/curriculums/{id}/with-subjects', [CurriculumController::class, 'getCurriculumWithSubjects']);


// Routes for handling subjects
Route::get('/api/subjects', [CurriculumController::class, 'getAllSubjects'])->name('api.subjects.index'); // <-- NEW
Route::post('/api/subjects', [CurriculumController::class, 'storeSubject'])->name('api.subjects.store');

// AI-powered lesson generation routes
Route::post('/api/generate-lesson-topics', [CurriculumController::class, 'generateLessonTopics'])->name('api.generate_lesson_topics');
Route::post('/api/generate-lesson-plan', [CurriculumController::class, 'generateLessonPlan'])->name('api.generate_lesson_plan');


Route::get('/pre_requisite', function () {
    return view('pre_requisite');
})->name('pre_requisite');

Route::get('/grade_setup', function () {
    return view('grade_setup');
})->name('grade_setup');

Route::get('/curriculum_export_tool', function () {
    return view('curriculum_export_tool');
})->name('curriculum_export_tool');

Route::get('/equivalency_tool', function () {
    return view('equivalency_tool');
})->name('equivalency_tool');

Route::get('/subject_history', function () {
    return view('subject_history');
})->name('subject_history');

// CHED Compliance Validator
Route::get('/compliance-validator', function () {
    $curriculums = [];
    $cmos = [];
    return view('compliance_validator', compact('curriculums', 'cmos'));
})->name('compliance.validator');

Route::post('/compliance-validator/validate', function () {
    // Handle validation logic here
})->name('ched.validator.validate');