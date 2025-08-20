@extends('layouts.app')

@section('content')
 <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-8">
                <!-- Main Content Start -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column -->
                    <div class="lg:col-span-2 bg-white p-8 rounded-2xl shadow-lg">
                        <div class="pb-6 border-b border-gray-200">
                            <h1 class="text-3xl font-bold text-gray-900">Grade Weighting Setup</h1>
                            <p class="mt-1 text-sm text-gray-500">Configure grade computation and weighting schemes</p>
                        </div>
                        
                        <div class="mt-8">
                            <h2 class="text-xl font-semibold text-gray-800">Weighting Configuration</h2>
                            <div class="space-y-6 mt-4">
                                <div>
                                    <label for="curriculum" class="block text-sm font-medium text-gray-700">Curriculum</label>
                                    <select id="curriculum" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option>BSIT - Bachelor of Science and Information Technology</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="subject" class="block text-sm font-medium text-gray-700">Subject/Course</label>
                                    <select id="subject" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option>CS101 - Introduction to Programming</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mt-10">
                            <h2 class="text-xl font-semibold text-gray-800">Grade Components</h2>
                             <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">AAE</label>
                                    <input type="text" value="20 %" class="mt-1 text-center block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Evaluation</label>
                                    <input type="text" value="20 %" class="mt-1 text-center block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Assignment</label>
                                    <input type="text" value="20 %" class="mt-1 text-center block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Prelim Exam</label>
                                    <input type="text" value="40 %" class="mt-1 text-center block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Midterm Exam</label>
                                    <input type="text" value="40 %" class="mt-1 text-center block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Final Exam</label>
                                    <input type="text" value="40 %" class="mt-1 text-center block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm">
                                </div>
                            </div>
                            <div class="mt-6 bg-gray-50 p-4 rounded-lg flex justify-between items-center">
                                <span class="font-semibold text-gray-800">Total Weight:</span>
                                <span class="font-bold text-xl text-gray-900">100%</span>
                            </div>
                        </div>

                        <div class="mt-10">
                            <button class="w-full bg-[#1e3a8a] hover:bg-blue-800 text-white font-bold py-3 px-4 rounded-lg transition duration-300">
                                Create Equivalency
                            </button>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-8">
                        <div class="bg-white p-8 rounded-2xl shadow-lg">
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">Grade Scale</h2>
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="border-b">
                                        <th class="pb-2 font-semibold text-gray-700">Grade</th>
                                        <th class="pb-2 font-semibold text-gray-700">Range</th>
                                        <th class="pb-2 font-semibold text-gray-700">Description</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600">
                                    <tr class="border-b"><td class="py-2">1.00</td><td>97-100</td><td>Excellent</td></tr>
                                    <tr class="border-b"><td class="py-2">1.25</td><td>94-96</td><td>Very Good</td></tr>
                                    <tr class="border-b"><td class="py-2">1.50</td><td>91-93</td><td>Good</td></tr>
                                    <tr class="border-b"><td class="py-2">2.00</td><td>85-90</td><td>Satisfactory</td></tr>
                                    <tr class="border-b"><td class="py-2">2.50</td><td>80-84</td><td>Fair</td></tr>
                                    <tr class="border-b"><td class="py-2">3.00</td><td>75-79</td><td>Passing</td></tr>
                                    <tr><td class="pt-2">5.00</td><td>Below 75</td><td>Failing</td></tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="bg-white p-6 rounded-2xl shadow-lg space-y-4 max-h-96 overflow-y-auto">
                             <div class="p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow cursor-pointer">
                                <h3 class="font-bold text-gray-900">Computer Programming 1 - COMPROG1</h3>
                                <p class="text-sm text-gray-500 mt-1">Aug 19 2025</p>
                             </div>
                             <div class="p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow cursor-pointer">
                                <h3 class="font-bold text-gray-900">Database Management System - DBMS101</h3>
                                <p class="text-sm text-gray-500 mt-1">Aug 19 2025</p>
                             </div>
                             <div class="p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow cursor-pointer">
                                <h3 class="font-bold text-gray-900">Object-Oriented Programming - OOP201</h3>
                                <p class="text-sm text-gray-500 mt-1">Aug 19 2025</p>
                             </div>
                              <div class="p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow cursor-pointer">
                                <h3 class="font-bold text-gray-900">Computer Programming 1 - COMPROG1</h3>
                                <p class="text-sm text-gray-500 mt-1">Aug 19 2025</p>
                             </div>
                        </div>
                    </div>
                </div>
                <!-- Main Content End -->
            </main>
@endsection