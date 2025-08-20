@extends('layouts.app')

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-8">
                <!-- Main Content Start -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div class="bg-white p-8 rounded-2xl shadow-lg">
                        <div class="pb-6">
                            <h1 class="text-3xl font-bold text-gray-900">Subject Equivalency Tool</h1>
                            <p class="mt-1 text-sm text-gray-500">Create and manage new academic curriculums.</p>
                        </div>
                        
                        <div class="mt-8 space-y-6">
                            <div>
                                <label for="source-subject" class="block text-sm font-medium text-gray-700">Source Subject</label>
                                <input type="text" id="source-subject" value="Programming/Fundamentals" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-gray-50 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label for="equivalent-subject" class="block text-sm font-medium text-gray-700">Equivalent Subject</label>
                                <select id="equivalent-subject" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option>CS101 - Introduction to Programming</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-10">
                            <button class="w-full bg-[#1e3a8a] hover:bg-blue-800 text-white font-bold py-3 px-4 rounded-lg transition duration-300">
                                Create Equivalency
                            </button>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="bg-white p-8 rounded-2xl shadow-lg">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Existing Equivalencies</h2>
                        <div class="relative flex items-center mb-6">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" placeholder="Search..." class="w-full bg-gray-100 border border-gray-300 rounded-lg py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="space-y-4 max-h-[60vh] overflow-y-auto pr-2">
                            <!-- Equivalency Item -->
                            <div class="p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                                <h3 class="font-semibold text-gray-800">Programming Fundamentals</h3>
                                <p class="text-sm text-gray-500">Equivalent to: CS101 - Introduction to Programming</p>
                            </div>
                             <!-- Repeat Item -->
                            <div class="p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                                <h3 class="font-semibold text-gray-800">College Mathematics</h3>
                                <p class="text-sm text-gray-500">Equivalent to: MATH101 - College Algebra</p>
                            </div>
                            <div class="p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                                <h3 class="font-semibold text-gray-800">Programming Fundamentals</h3>
                                <p class="text-sm text-gray-500">Equivalent to: CS101 - Introduction to Programming</p>
                            </div>
                            <div class="p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                                <h3 class="font-semibold text-gray-800">Programming Fundamentals</h3>
                                <p class="text-sm text-gray-500">Equivalent to: CS101 - Introduction to Programming</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Main Content End -->
            </main>
@endsection