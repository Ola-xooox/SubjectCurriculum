@extends('layouts.app')

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
    <div class="bg-white rounded-2xl shadow-xl p-8">
        
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Subject Mapping</h1>
                <p class="text-sm text-gray-500 mt-1">Drag and drop subjects to build the curriculum for a specific course and academic year.</p>
            </div>
            <button id="addSubjectButton" class="flex items-center space-x-2 px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition-colors shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>Add New Subject</span>
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="lg:col-span-1 bg-gray-50 border border-gray-200 rounded-xl p-6 flex flex-col">
                <div class="pb-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">Available Subjects</h2>
                    <p class="text-sm text-gray-500">Find and select subjects to add to the curriculum.</p>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3 my-4">
                    <div class="relative flex-grow">
                        <input type="text" id="searchInput" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition" placeholder="Search subject...">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <select id="typeFilter" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        <option>All Types</option>
                        <option>Major</option>
                        <option>Minor</option>
                        <option>Elective</option>
                    </select>
                </div>

                {{-- Subject List --}}
                <div id="availableSubjects" class="flex-1 overflow-y-auto pr-2 -mr-2 space-y-2">
                    {{-- Subject Card with Delete Button --}}
                    <div id="subject-comprog1" class="subject-card flex items-center justify-between p-3 bg-white hover:bg-blue-50 border border-gray-200 rounded-lg cursor-grab transition" draggable="true" data-subject-data='{"subjectCode":"COMPROG1","subjectName":"Computer Programming 1","subjectType":"Major","subjectUnit":"3","lessons":{"Week 1":"Introduction to Programming, Variables and Data Types","Week 2":"Control Structures","Week 3":"Loops and Arrays"}}'>
                        <div>
                            <p class="font-semibold text-gray-700">COMPROG1</p>
                            <p class="text-xs text-gray-500">Computer Programming 1</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="delete-subject-btn text-gray-400 hover:text-red-500 transition-colors duration-200" aria-label="Delete subject">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <div id="subject-philo1" class="subject-card flex items-center justify-between p-3 bg-white hover:bg-blue-50 border border-gray-200 rounded-lg cursor-grab transition" draggable="true" data-subject-data='{"subjectCode":"PHILO1","subjectName":"Introduction to Philosophy","subjectType":"Minor","subjectUnit":"3","lessons":{"Week 1":"What is Philosophy?","Week 2":"Metaphysics","Week 3":"Epistemology"}}'>
                        <div>
                            <p class="font-semibold text-gray-700">PHILO1</p>
                            <p class="text-xs text-gray-500">Introduction to Philosophy</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="delete-subject-btn text-gray-400 hover:text-red-500 transition-colors duration-200" aria-label="Delete subject">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 bg-gray-50 border border-gray-200 rounded-xl p-6 flex flex-col">
                <div class="pb-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Curriculum Overview</h2>
                    <select id="curriculumSelector" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        <option value="bsit">BS in Information Technology (A.Y. 2025-2026)</option>
                        <option value="bsa">BS in Accountancy (A.Y. 2025-2026)</option>
                    </select>
                </div>

                <div class="mt-4 space-y-6 flex-1">
                    @php
                        $years = ['1st Year', '2nd Year', '3rd Year', '4th Year'];
                    @endphp
                    @foreach ($years as $year)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-3">{{ $year }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="semester-dropzone bg-white border border-gray-200 rounded-lg p-4 min-h-[100px] hover:border-blue-500 transition-colors" data-year="{{ $year }}" data-semester="First Semester">
                                <h4 class="font-semibold text-gray-600 border-b border-gray-200 pb-2 mb-3">First Semester</h4>
                                <div class="flex flex-wrap gap-2">
                                    {{-- Initial subjects for BSIT, 1st Year, 1st Semester --}}
                                    @if ($year == '1st Year')
                                        <div class="subject-tag bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full cursor-grab" draggable="true" data-subject-data='{"subjectCode":"COMPROG1","subjectName":"Computer Programming 1","subjectType":"Major","subjectUnit":"3"}'>COMPROG1</div>
                                        <div class="subject-tag bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full cursor-grab" draggable="true" data-subject-data='{"subjectCode":"ITCOMP1","subjectName":"IT Computer Fundamentals","subjectType":"Major","subjectUnit":"3"}'>ITCOMP1</div>
                                        <div class="subject-tag bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full cursor-grab" draggable="true" data-subject-data='{"subjectCode":"MMW","subjectName":"Mathematics in the Modern World","subjectType":"Minor","subjectUnit":"3"}'>MMW</div>
                                        <div class="subject-tag bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full cursor-grab" draggable="true" data-subject-data='{"subjectCode":"PURPCOMM","subjectName":"Purposive Communication","subjectType":"Minor","subjectUnit":"3"}'>PURPCOMM</div>
                                        <div class="subject-tag bg-gray-200 text-gray-800 text-sm font-medium px-3 py-1 rounded-full cursor-grab" draggable="true" data-subject-data='{"subjectCode":"PE1","subjectName":"Physical Education 1","subjectType":"PE","subjectUnit":"2"}'>PE1</div>
                                        <div class="subject-tag bg-gray-200 text-gray-800 text-sm font-medium px-3 py-1 rounded-full cursor-grab" draggable="true" data-subject-data='{"subjectCode":"NSTP1","subjectName":"National Service Training Program 1","subjectType":"NSTP","subjectUnit":"3"}'>NSTP1</div>
                                    @endif
                                    @if ($year == '2nd Year' && $loop->first)
                                        <div class="subject-tag bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full cursor-grab" draggable="true" data-subject-data='{"subjectCode":"COMPROG2","subjectName":"Computer Programming 2","subjectType":"Major","subjectUnit":"3"}'>COMPROG2</div>
                                        <div class="subject-tag bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full cursor-grab" draggable="true" data-subject-data='{"subjectCode":"DSA","subjectName":"Data Structures and Algorithms","subjectType":"Major","subjectUnit":"3"}'>DSA</div>
                                        <div class="subject-tag bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full cursor-grab" draggable="true" data-subject-data='{"subjectCode":"LITERA","subjectName":"The Literature of the Philippines","subjectType":"Minor","subjectUnit":"3"}'>LITERA</div>
                                        <div class="subject-tag bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full cursor-grab" draggable="true" data-subject-data='{"subjectCode":"RPH","subjectName":"Readings in Philippine History","subjectType":"Minor","subjectUnit":"3"}'>RPH</div>
                                    @endif
                                </div>
                            </div>
                            <div class="semester-dropzone bg-white border border-gray-200 rounded-lg p-4 min-h-[100px] hover:border-blue-500 transition-colors" data-year="{{ $year }}" data-semester="Second Semester">
                                <h4 class="font-semibold text-gray-600 border-b border-gray-200 pb-2 mb-3">Second Semester</h4>
                                <div class="flex flex-wrap gap-2">
                                    {{-- Subjects will be dropped here --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                {{-- Save Button --}}
                <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end">
                    <button id="saveCurriculumButton" class="px-6 py-3 rounded-lg text-sm font-semibold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors shadow-md">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v6a2 2 0 002 2h6m4-4H9m0 0V9m0 0V5a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2h-3m-4-4V9"></path></svg>
                        Save Curriculum
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

{{-- Modal for adding a new subject --}}
<div id="addSubjectModal" class="fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-75 transition-opacity duration-300 ease-out hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white w-full max-w-2xl rounded-2xl shadow-2xl p-6 md:p-8 transform scale-95 opacity-0 transition-all duration-300 ease-out" id="modal-subject-panel">
            
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-extrabold text-gray-800">Create New Subject</h2>
                <button id="closeSubjectModalButton" class="text-gray-400 hover:text-gray-600 focus:outline-none transition-colors duration-200" aria-label="Close modal">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <form id="subjectForm" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-1">
                        <label for="subjectName" class="block text-sm font-semibold text-gray-700 mb-1">Subject Name</label>
                        <input type="text" id="subjectName" name="subjectName" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required>
                    </div>
                    <div class="md:col-span-1">
                        <label for="subjectCode" class="block text-sm font-semibold text-gray-700 mb-1">Subject Code</label>
                        <input type="text" id="subjectCode" name="subjectCode" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"  required>
                    </div>
                    <div class="md:col-span-1">
                        <label for="subjectType" class="block text-sm font-semibold text-gray-700 mb-1">Type</label>
                        <select id="subjectType" name="subjectType" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required>
                            <option value="" disabled selected>Select Type</option>
                            <option value="Major">Major</option>
                            <option value="Minor">Minor</option>
                            <option value="Elective">Elective</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="subjectUnit" class="block text-sm font-semibold text-gray-700 mb-1">Unit</label>
                    <input type="number" id="subjectUnit" name="subjectUnit" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required>
                </div>
                
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-gray-700">Lesson per Week (Microsoft Word Tool)</h3>
                    @for ($i = 1; $i <= 15; $i++)
                    <div>
                        <button type="button" class="week-toggle-btn w-full flex justify-between items-center p-3 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors" data-week="{{ $i }}">
                            <span class="font-medium text-gray-700">Week {{ $i }}</span>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div class="week-input hidden mt-2">
                            <textarea id="week-{{ $i }}-lessons" name="week-{{ $i }}-lessons" class="w-full h-24 p-3 border border-gray-300 rounded-lg resize-y focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors font-mono text-sm" style="min-height: 5rem;"></textarea>
                        </div>
                    </div>
                    @endfor
                </div>

                <div class="pt-4 flex justify-end gap-3">
                    <button type="button" id="cancelSubjectModalButton" class="px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-3 rounded-lg text-sm font-semibold text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal for displaying subject details on double-click --}}
<div id="subjectDetailsModal" class="fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-75 transition-opacity duration-300 ease-out hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white w-full max-w-2xl rounded-2xl shadow-2xl p-6 md:p-8 transform scale-95 opacity-0 transition-all duration-300 ease-out" id="modal-details-panel">
            <div class="flex justify-between items-center mb-6">
                <h2 id="detailsSubjectName" class="text-2xl font-extrabold text-gray-800"></h2>
                <button id="closeDetailsModalButton" class="text-gray-400 hover:text-gray-600 focus:outline-none transition-colors duration-200" aria-label="Close modal">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-semibold text-gray-700">Subject Code:</p>
                        <p id="detailsSubjectCode" class="text-lg text-gray-900"></p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-700">Type:</p>
                        <p id="detailsSubjectType" class="text-lg text-gray-900"></p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-700">Unit:</p>
                        <p id="detailsSubjectUnit" class="text-lg text-gray-900"></p>
                    </div>
                </div>
                <div class="space-y-2" id="detailsLessonsContainer">
                    <h3 class="text-md font-bold text-gray-800 pt-4">Lessons</h3>
                    {{-- Lessons will be populated here --}}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Success Alert Modal --}}
<div id="successModal" class="fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-75 transition-opacity duration-300 ease-out hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white w-full max-w-sm rounded-2xl shadow-2xl p-6 text-center transform scale-95 opacity-0 transition-all duration-300 ease-out" id="modal-success-panel">
            <div class="flex justify-center mb-4">
                <svg class="w-16 h-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Success!</h3>
            <p class="text-sm text-gray-600 mb-6">The subject mapping has been saved successfully.</p>
            <button id="closeSuccessModalButton" class="w-full px-6 py-3 rounded-lg text-sm font-semibold text-white bg-green-600 hover:bg-green-700 transition-colors">
                OK
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // --- Modal and Form Logic for Add Subject ---
        const addSubjectButton = document.getElementById('addSubjectButton');
        const addSubjectModal = document.getElementById('addSubjectModal');
        const closeSubjectModalButton = document.getElementById('closeSubjectModalButton');
        const cancelSubjectModalButton = document.getElementById('cancelSubjectModalButton');
        const subjectModalPanel = document.getElementById('modal-subject-panel');
        const subjectForm = document.getElementById('subjectForm');
        const availableSubjectsContainer = document.getElementById('availableSubjects');

        const showSubjectModal = () => {
            addSubjectModal.classList.remove('hidden');
            setTimeout(() => {
                addSubjectModal.classList.remove('opacity-0');
                subjectModalPanel.classList.remove('opacity-0', 'scale-95');
            }, 10);
        };

        const hideSubjectModal = () => {
            addSubjectModal.classList.add('opacity-0');
            subjectModalPanel.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                addSubjectModal.classList.add('hidden');
                subjectForm.reset();
                document.querySelectorAll('.week-input').forEach(input => {
                    input.classList.add('hidden');
                });
                document.querySelectorAll('.week-toggle-btn svg').forEach(svg => {
                    svg.classList.remove('rotate-180');
                });
            }, 300);
        };

        addSubjectButton.addEventListener('click', showSubjectModal);
        closeSubjectModalButton.addEventListener('click', hideSubjectModal);
        cancelSubjectModalButton.addEventListener('click', hideSubjectModal);
        addSubjectModal.addEventListener('click', (e) => {
            if (e.target.id === 'addSubjectModal') {
                hideSubjectModal();
            }
        });

        document.querySelectorAll('.week-toggle-btn').forEach(button => {
            button.addEventListener('click', () => {
                const parent = button.parentElement;
                const inputDiv = parent.querySelector('.week-input');
                const svg = button.querySelector('svg');
                
                inputDiv.classList.toggle('hidden');
                svg.classList.toggle('rotate-180');
            });
        });

        subjectForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const subjectCode = document.getElementById('subjectCode').value;
            const subjectName = document.getElementById('subjectName').value;
            const subjectType = document.getElementById('subjectType').value;
            const subjectUnit = document.getElementById('subjectUnit').value;

            const lessons = {};
            for (let i = 1; i <= 15; i++) {
                const weekLessons = document.getElementById(`week-${i}-lessons`).value;
                if (weekLessons.trim() !== '') {
                    lessons[`Week ${i}`] = weekLessons.trim();
                }
            }

            const newSubjectCard = document.createElement('div');
            newSubjectCard.id = `subject-${subjectCode.toLowerCase()}`;
            newSubjectCard.classList.add(
                'subject-card',
                'flex',
                'items-center',
                'justify-between',
                'p-3',
                'bg-white',
                'hover:bg-blue-50',
                'border',
                'border-gray-200',
                'rounded-lg',
                'cursor-grab',
                'transition'
            );
            newSubjectCard.setAttribute('draggable', 'true');
            newSubjectCard.dataset.subjectData = JSON.stringify({
                subjectCode: subjectCode,
                subjectName: subjectName,
                subjectType: subjectType,
                subjectUnit: subjectUnit,
                lessons: lessons
            });

            newSubjectCard.innerHTML = `
                <div>
                    <p class="font-semibold text-gray-700">${subjectCode}</p>
                    <p class="text-xs text-gray-500">${subjectName}</p>
                </div>
                <div class="flex items-center space-x-2">
                    <button class="delete-subject-btn text-gray-400 hover:text-red-500 transition-colors duration-200" aria-label="Delete subject">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            `;

            availableSubjectsContainer.appendChild(newSubjectCard);
            addDraggableEvents(newSubjectCard);
            addDoubleClickEvents(newSubjectCard);
            addDeleteButtonEvents(newSubjectCard);

            hideSubjectModal();
        });

        // --- Search and Filter Logic ---
        const searchInput = document.getElementById('searchInput');
        const typeFilter = document.getElementById('typeFilter');

        const filterSubjects = () => {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedType = typeFilter.value;
            const subjectCards = availableSubjectsContainer.querySelectorAll('.subject-card');

            subjectCards.forEach(card => {
                const subjectData = JSON.parse(card.dataset.subjectData);
                const subjectName = subjectData.subjectName.toLowerCase();
                const subjectCode = subjectData.subjectCode.toLowerCase();
                const subjectType = subjectData.subjectType;

                // Check if card matches search term and selected type
                const searchMatch = subjectName.includes(searchTerm) || subjectCode.includes(searchTerm);
                const typeMatch = (selectedType === 'All Types' || subjectType === selectedType);

                if (searchMatch && typeMatch) {
                    card.style.display = 'flex'; // Use 'flex' to match original styling
                } else {
                    card.style.display = 'none'; // Hide the card
                }
            });
        };

        // Add event listeners to trigger the filter function
        searchInput.addEventListener('input', filterSubjects);
        typeFilter.addEventListener('change', filterSubjects);

        // --- Double-click Modal Logic ---
        const subjectDetailsModal = document.getElementById('subjectDetailsModal');
        const closeDetailsModalButton = document.getElementById('closeDetailsModalButton');
        const modalDetailsPanel = document.getElementById('modal-details-panel');

        const showDetailsModal = (data) => {
            document.getElementById('detailsSubjectName').textContent = `${data.subjectName} (${data.subjectCode})`;
            document.getElementById('detailsSubjectCode').textContent = data.subjectCode;
            document.getElementById('detailsSubjectType').textContent = data.subjectType;
            document.getElementById('detailsSubjectUnit').textContent = data.subjectUnit;
            
            const lessonsContainer = document.getElementById('detailsLessonsContainer');
            lessonsContainer.innerHTML = '<h3 class="text-md font-bold text-gray-800 pt-4">Lessons</h3>';
            if (data.lessons && Object.keys(data.lessons).length > 0) {
                for (const week in data.lessons) {
                    const lessonDiv = document.createElement('div');
                    lessonDiv.classList.add('p-3', 'bg-gray-100', 'rounded-lg', 'text-sm', 'text-gray-700');
                    lessonDiv.innerHTML = `<strong>${week}:</strong> ${data.lessons[week]}`;
                    lessonsContainer.appendChild(lessonDiv);
                }
            } else {
                lessonsContainer.innerHTML += '<p class="text-sm text-gray-500">No lessons recorded for this subject.</p>';
            }

            subjectDetailsModal.classList.remove('hidden');
            setTimeout(() => {
                subjectDetailsModal.classList.remove('opacity-0');
                modalDetailsPanel.classList.remove('opacity-0', 'scale-95');
            }, 10);
        };

        const hideDetailsModal = () => {
            subjectDetailsModal.classList.add('opacity-0');
            modalDetailsPanel.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                subjectDetailsModal.classList.add('hidden');
            }, 300);
        };

        closeDetailsModalButton.addEventListener('click', hideDetailsModal);
        subjectDetailsModal.addEventListener('click', (e) => {
            if (e.target.id === 'subjectDetailsModal') {
                hideDetailsModal();
            }
        });

        // --- Drag and Drop Logic ---
        const subjectCards = document.querySelectorAll('.subject-card');
        const dropzones = document.querySelectorAll('.semester-dropzone');
        let draggedItem = null;

        const addDraggableEvents = (item) => {
            item.addEventListener('dragstart', (e) => {
                draggedItem = item;
                e.dataTransfer.setData('text/plain', item.dataset.subjectData);
                setTimeout(() => {
                    item.classList.add('opacity-50', 'bg-gray-200');
                }, 0);
            });

            item.addEventListener('dragend', () => {
                item.classList.remove('opacity-50', 'bg-gray-200');
                draggedItem = null;
            });
        };

        const addDoubleClickEvents = (item) => {
            item.addEventListener('dblclick', () => {
                const subjectData = JSON.parse(item.dataset.subjectData);
                showDetailsModal(subjectData);
            });
        };

        const addDeleteButtonEvents = (item) => {
            const deleteBtn = item.querySelector('.delete-subject-btn');
            if (deleteBtn) {
                deleteBtn.addEventListener('click', (e) => {
                    e.stopPropagation(); // Prevents double-click modal from opening
                    item.remove();
                });
            }
        };

        subjectCards.forEach(card => {
            addDraggableEvents(card);
            addDoubleClickEvents(card);
            addDeleteButtonEvents(card);
        });
        
        dropzones.forEach(dropzone => {
            dropzone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropzone.classList.add('border-blue-500', 'bg-blue-50');
            });

            dropzone.addEventListener('dragleave', () => {
                dropzone.classList.remove('border-blue-500', 'bg-blue-50');
            });

            dropzone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropzone.classList.remove('border-blue-500', 'bg-blue-50');
                if (draggedItem) {
                    const droppedSubjectData = JSON.parse(e.dataTransfer.getData('text/plain'));
                    
                    // Check if the subject already exists in the dropzone to prevent duplicates
                    const existingTags = dropzone.querySelectorAll('.subject-tag');
                    const isDuplicate = Array.from(existingTags).some(tag => {
                        const tagData = JSON.parse(tag.dataset.subjectData);
                        return tagData.subjectCode === droppedSubjectData.subjectCode;
                    });
                    
                    if (!isDuplicate) {
                        const subjectTag = document.createElement('div');
                        subjectTag.classList.add(
                            'subject-tag',
                            'bg-blue-100',
                            'text-blue-800',
                            'text-sm',
                            'font-medium',
                            'px-3',
                            'py-1',
                            'rounded-full',
                            'cursor-grab'
                        );
                        subjectTag.textContent = droppedSubjectData.subjectCode;
                        subjectTag.setAttribute('draggable', 'true');
                        subjectTag.dataset.subjectData = JSON.stringify(droppedSubjectData);

                        // Add drag/drop events to the new tag
                        addDraggableEvents(subjectTag);
                        addDoubleClickEvents(subjectTag);
                        
                        dropzone.querySelector('.flex-wrap').appendChild(subjectTag);
                    }
                }
            });
        });

        // Add a droppable area for removal
        const mainContentArea = document.querySelector('main');
        mainContentArea.addEventListener('dragover', (e) => {
            e.preventDefault();
        });

        mainContentArea.addEventListener('drop', (e) => {
            // Check if the drop is outside of a valid dropzone
            const isDroppedInDropzone = e.target.closest('.semester-dropzone');
            if (draggedItem && draggedItem.classList.contains('subject-tag') && !isDroppedInDropzone) {
                draggedItem.remove();
            }
        });

        // --- Save Button & Success Modal Logic ---
        const saveCurriculumButton = document.getElementById('saveCurriculumButton');
        const successModal = document.getElementById('successModal');
        const closeSuccessModalButton = document.getElementById('closeSuccessModalButton');
        const modalSuccessPanel = document.getElementById('modal-success-panel');

        const showSuccessModal = () => {
            successModal.classList.remove('hidden');
            setTimeout(() => {
                successModal.classList.remove('opacity-0');
                modalSuccessPanel.classList.remove('opacity-0', 'scale-95');
            }, 10);
        };

        const hideSuccessModal = () => {
            successModal.classList.add('opacity-0');
            modalSuccessPanel.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                successModal.classList.add('hidden');
            }, 300);
        };

        closeSuccessModalButton.addEventListener('click', hideSuccessModal);
        successModal.addEventListener('click', (e) => {
            if (e.target.id === 'successModal') {
                hideSuccessModal();
            }
        });

        saveCurriculumButton.addEventListener('click', () => {
            // Here you would gather all the data from the subject tags inside the dropzones.
            // This is where the actual saving logic (e.g., an AJAX call to a Laravel route) would go.

            const curriculumData = [];
            const semesterDropzones = document.querySelectorAll('.semester-dropzone');
            semesterDropzones.forEach(dropzone => {
                const year = dropzone.dataset.year;
                const semester = dropzone.dataset.semester;
                const subjects = [];
                dropzone.querySelectorAll('.subject-tag').forEach(tag => {
                    subjects.push(JSON.parse(tag.dataset.subjectData));
                });

                if (subjects.length > 0) {
                    curriculumData.push({ year, semester, subjects });
                }
            });
            
            // Log the data to the console to see the structure
            console.log("Saving curriculum data:", curriculumData);

            // Simulate a successful save and show the modal
            setTimeout(() => {
                showSuccessModal();
            }, 500); // Simulate a small delay for a network request
        });
    });
</script>
@endsection