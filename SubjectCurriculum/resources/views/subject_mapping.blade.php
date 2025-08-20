@extends('layouts.app')

@section('content')
 <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    
                    <div class="mb-6">
                        <h1 class="text-3xl font-bold text-gray-800">Subject Mapping</h1>
                        <p class="text-sm text-gray-500 mt-1">Drag and drop subjects to build the curriculum for a specific course and academic year.</p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        
                        <div class="lg:col-span-1 bg-gray-50 border border-gray-200 rounded-xl p-6 flex flex-col">
                            <div class="pb-4 border-b border-gray-200">
                                <h2 class="text-xl font-semibold text-gray-800">Available Subjects</h2>
                                <p class="text-sm text-gray-500">Find and select subjects to add to the curriculum.</p>
                            </div>
                            
                            <div class="flex flex-col sm:flex-row gap-3 my-4">
                                <div class="relative flex-grow">
                                    <input type="text" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition" placeholder="Search subject...">
                                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </div>
                                <select class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                                    <option>All Types</option>
                                    <option>Major</option>
                                    <option>Minor</option>
                                    <option>Elective</option>
                                </select>
                            </div>

                            <div class="flex-1 overflow-y-auto pr-2 -mr-2 space-y-2">
                                <div class="flex items-center justify-between p-3 bg-white hover:bg-blue-50 border border-gray-200 rounded-lg cursor-pointer transition">
                                    <div>
                                        <p class="font-semibold text-gray-700">COMPROG1</p>
                                        <p class="text-xs text-gray-500">Computer Programming 1</p>
                                    </div>
                                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div class="flex items-center justify-between p-3 bg-white hover:bg-blue-50 border border-gray-200 rounded-lg cursor-pointer transition">
                                    <div>
                                        <p class="font-semibold text-gray-700">PHILO1</p>
                                        <p class="text-xs text-gray-500">Introduction to Philosophy</p>
                                    </div>
                                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                </div>
                        </div>

                        <div class="lg:col-span-2 bg-gray-50 border border-gray-200 rounded-xl p-6">
                            <div class="pb-4 border-b border-gray-200">
                                <h2 class="text-xl font-semibold text-gray-800">Curriculum Overview</h2>
                                <div class="mt-1">
                                    <span class="text-md font-medium text-blue-700">Bachelor of Science in Information Technology</span>
                                    <span class="text-sm text-gray-500 ml-2">(A.Y. 2025-2026)</span>
                                </div>
                            </div>

                            <div class="mt-4 space-y-6">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-700 mb-3">1st Year</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                                            <h4 class="font-semibold text-gray-600 border-b border-gray-200 pb-2 mb-3">First Semester</h4>
                                            <div class="flex flex-wrap gap-2">
                                                <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">COMPROG1</span>
                                                <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">ITCOMP1</span>
                                                <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">MMW</span>
                                                <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">PURPCOMM</span>
                                                <span class="bg-gray-200 text-gray-800 text-sm font-medium px-3 py-1 rounded-full">PE1</span>
                                                <span class="bg-gray-200 text-gray-800 text-sm font-medium px-3 py-1 rounded-full">NSTP1</span>
                                            </div>
                                        </div>
                                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                                            <h4 class="font-semibold text-gray-600 border-b border-gray-200 pb-2 mb-3">Second Semester</h4>
                                            <div class="flex flex-wrap gap-2">
                                                </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="text-lg font-semibold text-gray-700 mb-3">2nd Year</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                         <div class="bg-white border border-gray-200 rounded-lg p-4">
                                            <h4 class="font-semibold text-gray-600 border-b border-gray-200 pb-2 mb-3">First Semester</h4>
                                            <div class="flex flex-wrap gap-2">
                                                <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">COMPROG2</span>
                                                <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">DSA</span>
                                                <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">LITERA</span>
                                                <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">RPH</span>
                                            </div>
                                        </div>
                                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                                            <h4 class="font-semibold text-gray-600 border-b border-gray-200 pb-2 mb-3">Second Semester</h4>
                                            <div class="flex flex-wrap gap-2">
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-8 pt-4 border-t border-gray-200 flex justify-end gap-3">
                                <button class="px-5 py-2 text-sm font-medium text-gray-600 bg-gray-200 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition">
                                    Cancel
                                </button>
                                <button class="px-5 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                                    Save Curriculum
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </main>
@endsection