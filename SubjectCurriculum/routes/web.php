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

// New route for AI-powered lesson topic generation
Route::post('/api/generate-lesson-topics', [CurriculumController::class, 'generateLessonTopics'])->name('api.generate_lesson_topics');

// New route for AI-powered lesson plan generation
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
    // You'll need to pass the curriculums and CMOs to this view
    // from a controller method in a real application.
    $curriculums = []; // Replace with your actual data
    $cmos = []; // Replace with your actual data
    return view('compliance_validator', compact('curriculums', 'cmos'));
})->name('compliance.validator');

// You will also need a route to handle the form submission
Route::post('/compliance-validator/validate', function () {
    // Handle validation logic here
})->name('ched.validator.validate');