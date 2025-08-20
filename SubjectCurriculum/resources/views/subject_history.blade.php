@extends('layouts.app')

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-8">
    <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-200">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-6 border-b pb-4">Subject Offering History</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 items-end">
            <div>
                <label for="curriculum" class="block text-sm font-semibold text-gray-700 mb-2">Curriculum</label>
                <select id="curriculum" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg shadow-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                    <option>BET - Bachelor of Engineering Technology</option>
                    <option>BSIT - Bachelor of Science in Information Technology</option>
                    <option>BSED - Bachelor of Secondary Education</option>
                </select>
            </div>
            <div>
                <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">Subject</label>
                <select id="subject" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg shadow-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                    <option>Introduction to Programming</option>
                    <option>Database Management</option>
                    <option>Web Development</option>
                </select>
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" id="subject-search" placeholder="Search for subjects..." class="w-full bg-gray-50 border border-gray-300 rounded-lg py-2.5 pl-12 pr-4 text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150 ease-in-out">
            </div>
        </div>

        <div class="overflow-x-auto rounded-lg shadow-md border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr class="text-gray-500 uppercase text-xs">
                        <th class="px-6 py-3 text-left font-semibold tracking-wider">
                            <select class="bg-transparent border-none focus:ring-0 p-0 text-gray-500">
                                <option>All Years</option>
                                <option>2021-2022</option>
                                <option>2020-2021</option>
                            </select>
                        </th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wider">
                            <select class="bg-transparent border-none focus:ring-0 p-0 text-gray-500">
                                <option>All Semesters</option>
                                <option>1st Semester</option>
                                <option>2nd Semester</option>
                            </select>
                        </th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wider">Subject Code</th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wider">Units</th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">2021-2022</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2nd Semester</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">GE1 101</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900 transition-colors duration-150">View</a>
                            <a href="#" class="text-green-600 hover:text-green-900 ml-4 transition-colors duration-150">Export</a>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">2021-2022</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1st Semester</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">GE1 101</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900 transition-colors duration-150">View</a>
                            <a href="#" class="text-green-600 hover:text-green-900 ml-4 transition-colors duration-150">Export</a>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">2021-2022</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1st Semester</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">GE1 101</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900 transition-colors duration-150">View</a>
                            <a href="#" class="text-green-600 hover:text-green-900 ml-4 transition-colors duration-150">Export</a>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">2021-2022</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2nd Semester</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">GE1 101</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900 transition-colors duration-150">View</a>
                            <a href="#" class="text-green-600 hover:text-green-900 ml-4 transition-colors duration-150">Export</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </main>
@endsection