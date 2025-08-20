<?php

use Illuminate\Support\Facades\Route;

// This route now points the root URL ('/') to your dashboard view.
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// Keep your other routes as they were.
Route::get('/curriculum_builder', function () {
    return view('curriculum_builder');
})->name('curriculum_builder');

Route::get('/subject_mapping', function () {
    return view('subject_mapping');
})->name('subject_mapping');

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


