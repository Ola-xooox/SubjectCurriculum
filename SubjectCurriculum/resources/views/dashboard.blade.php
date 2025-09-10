@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h2 class="text-2xl font-semibold text-gray-700">Dashboard</h2>
    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow p-6 flex items-center">
            <div class="flex-shrink-0 w-14 h-14 bg-green-100 rounded-full flex items-center justify-center mr-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 01-8 0m8 0a4 4 0 00-8 0m8 0V5a4 4 0 00-8 0v2m8 0v2a4 4 0 01-8 0V7"></path></svg>
            </div>
            <div>
                <p class="text-lg font-bold text-gray-800">Senior High Programs</p>
                <p class="text-3xl font-extrabold text-green-700">{{ $seniorHighCount }}</p>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 flex items-center">
            <div class="flex-shrink-0 w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 7v-7"></path></svg>
            </div>
            <div>
                <p class="text-lg font-bold text-gray-800">College Programs</p>
                <p class="text-3xl font-extrabold text-blue-700">{{ $collegeCount }}</p>
            </div>
        </div>
    </div>
    <div class="mt-10 grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-6 flex items-center">
            <div class="flex-shrink-0 w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center mr-4">
                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
            </div>
            <div>
                <p class="text-lg font-bold text-gray-800">Total Subjects</p>
                <p class="text-3xl font-extrabold text-purple-700">{{ $totalSubjects }}</p>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 flex items-center">
            <div class="flex-shrink-0 w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
            </div>
            <div>
                <p class="text-lg font-bold text-gray-800">Major Subjects</p>
                <p class="text-3xl font-extrabold text-blue-700">{{ $majorCount }}</p>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 flex items-center">
            <div class="flex-shrink-0 w-14 h-14 bg-green-100 rounded-full flex items-center justify-center mr-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 01-8 0m8 0a4 4 0 00-8 0m8 0V5a4 4 0 00-8 0v2m8 0v2a4 4 0 01-8 0V7"></path></svg>
            </div>
            <div>
                <p class="text-lg font-bold text-gray-800">Minor Subjects</p>
                <p class="text-3xl font-extrabold text-green-700">{{ $minorCount }}</p>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 flex items-center">
            <div class="flex-shrink-0 w-14 h-14 bg-yellow-100 rounded-full flex items-center justify-center mr-4">
                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01" /></svg>
            </div>
            <div>
                <p class="text-lg font-bold text-gray-800">Elective Subjects</p>
                <p class="text-3xl font-extrabold text-yellow-700">{{ $electiveCount }}</p>
            </div>
        </div>
    </div>
    <div class="mt-4 h-96 rounded-lg border-2 border-dashed border-gray-300">
    </div>
</div>
@endsection