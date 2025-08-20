@extends('layouts.app')

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                <div class="container mx-auto">
                    <div class="bg-white p-8 rounded-2xl shadow-lg">
                        
                        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                            <h1 class="text-2xl font-bold text-gray-800">Prerequisites Configuration</h1>
                            <div class="relative flex items-center">
                                <button class="absolute left-0 pl-3 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </button>
                                <input type="text" placeholder="Search..." class="w-full bg-gray-100 border border-gray-300 rounded-lg py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                            <div>
                                <label for="curriculum" class="block text-sm font-medium text-gray-700 mb-1">Curriculum</label>
                                <select id="curriculum" class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option>Select Curriculum</option>
                                </select>
                            </div>
                            <div>
                                <label for="year-level" class="block text-sm font-medium text-gray-700 mb-1">Year Level</label>
                                <select id="year-level" class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option>Select Year Level</option>
                                </select>
                            </div>
                            <div>
                                <label for="section" class="block text-sm font-medium text-gray-700 mb-1">Section</label>
                                <select id="section" class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option>Select Section</option>
                                </select>
                            </div>
                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                                <select id="subject" class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option>Select Subject</option>
                                </select>
                            </div>
                        </div>

                        <div class="overflow-x-auto rounded-lg shadow">
                            <table class="min-w-full">
                                <thead class="bg-[#1e3a8a] text-white">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">#</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Student ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Grade</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">22012345</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Mark James</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Passed</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">22012345</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Mark James</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Failed</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">22012345</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Mark James</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Passed</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">4</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">22012345</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Mark James</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Passed</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
              </main>
              @endsection