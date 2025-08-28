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
                        <option value="All Types">All Types</option>
                        <option value="Major">Major</option>
                        <option value="Minor">Minor</option>
                        <option value="Elective">Elective</option>
                    </select>
                </div>

                {{-- Subject List --}}
                <div id="availableSubjects" class="flex-1 overflow-y-auto pr-2 -mr-2 space-y-2">
                    <p class="text-gray-500 text-center mt-4">Select a curriculum to view subjects.</p>
                </div>
            </div>

            <div class="lg:col-span-2 bg-gray-50 border border-gray-200 rounded-xl p-6 flex flex-col">
                <div class="pb-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Curriculum Overview</h2>
                    <select id="curriculumSelector" class="border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        <option value="">Select a Curriculum</option>
                        {{-- Options will be populated by JavaScript --}}
                    </select>
                </div>

                <div id="curriculumOverview" class="mt-4 space-y-6 flex-1">
                    {{-- Dynamically generated content will be placed here --}}
                    <p class="text-gray-500 text-center mt-4">Select a curriculum from the dropdown to start mapping subjects.</p>
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

    {{-- Modal for adding a new subject --}}
    <div id="addSubjectModal" class="fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-75 transition-opacity duration-300 ease-out hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="relative bg-white w-full max-w-6xl rounded-2xl shadow-2xl p-6 md:p-8 transform scale-95 opacity-0 transition-all duration-300 ease-out" id="modal-subject-panel">
                
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
                        <div class="flex justify-between items-center">
                            <h3 class="text-sm font-semibold text-gray-700">Weekly Topics</h3>
                            <button type="button" id="generateTopicsButton" class="px-4 py-2 text-sm font-semibold text-white bg-purple-600 hover:bg-purple-700 rounded-lg transition-colors">
                                AI Topic Generator
                            </button>
                        </div>
                         <div id="topicSpinner" class="hidden text-center py-4">
                            <div role="status">
                                <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                            <p class="text-sm text-gray-500 mt-2">Generating weekly topics, please wait...</p>
                        </div>
                        @for ($i = 1; $i <= 15; $i++)
                        <div>
                            <button type="button" class="week-toggle-btn w-full flex justify-between items-center p-3 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors" data-week="{{ $i }}">
                                <span class="font-medium text-gray-700">Week {{ $i }}</span>
                                <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div class="week-content hidden mt-2 p-3 border border-gray-200 rounded-lg">
                                <textarea id="week-{{ $i }}-lessons" name="week-{{ $i }}-lessons" class="w-full h-24 p-3 border border-gray-300 rounded-lg resize-y focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors font-mono text-sm" style="min-height: 5rem;" placeholder="Topic for Week {{ $i }}..."></textarea>
                                <div class="flex justify-end mt-2">
                                    <button type="button" class="generate-lesson-btn px-3 py-1.5 text-xs font-semibold text-white bg-green-600 hover:bg-green-700 rounded-md transition-colors" data-week="{{ $i }}">
                                        Generate Detailed Lesson
                                    </button>
                                </div>
                                <div id="lesson-spinner-{{ $i }}" class="hidden text-center py-2">
                                    <p class="text-xs text-gray-500">Generating detailed lesson...</p>
                                </div>
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
            <div class="relative bg-white w-full max-w-4xl rounded-2xl shadow-2xl p-6 md:p-8 transform scale-95 opacity-0 transition-all duration-300 ease-out" id="modal-details-panel">
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
</main>

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
        const generateTopicsButton = document.getElementById('generateTopicsButton');
        const topicSpinner = document.getElementById('topicSpinner');

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
                document.querySelectorAll('.week-content').forEach(input => {
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
                const contentDiv = parent.querySelector('.week-content');
                const svg = button.querySelector('svg');
                
                contentDiv.classList.toggle('hidden');
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

            const newSubjectCard = createSubjectCard({
                subject_code: subjectCode,
                subject_name: subjectName,
                subject_type: subjectType,
                subject_unit: subjectUnit,
                lessons: lessons
            });
            availableSubjectsContainer.appendChild(newSubjectCard);

            hideSubjectModal();
        });

        generateTopicsButton.addEventListener('click', () => {
            const subjectName = document.getElementById('subjectName').value;
            if (!subjectName) {
                alert('Please enter a Subject Name to generate topics.');
                return;
            }

            topicSpinner.classList.remove('hidden');

            fetch('/api/generate-lesson-topics', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ subjectName })
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(errorData => { throw errorData; });
                }
                return response.json();
            })
            .then(data => {
                // data is expected to be an object like {"Week 1": "Topic 1", "Week 2": "Topic 2", ...}
                for (let i = 1; i <= 15; i++) {
                    const weekKey = `Week ${i}`;
                    const weekTextarea = document.getElementById(`week-${i}-lessons`);
                    if (data[weekKey]) {
                        weekTextarea.value = data[weekKey];
                    }
                }
            })
            .catch(error => {
                console.error('Error generating topics:', error);
                let errorMessage = 'An error occurred while generating topics. Check the browser console for more details.';
                if (error && error.message) {
                    errorMessage = `Error: ${error.message}`;
                }
                alert(errorMessage);
            })
            .finally(() => {
                topicSpinner.classList.add('hidden');
            });
        });

        document.querySelectorAll('.generate-lesson-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                const week = e.target.dataset.week;
                const weekTextarea = document.getElementById(`week-${week}-lessons`);
                const topic = weekTextarea.value;
                const subjectName = document.getElementById('subjectName').value;

                if (!topic) {
                    alert(`Please enter a topic for Week ${week} or generate topics first.`);
                    return;
                }
                 if (!subjectName) {
                    alert('Please ensure the Subject Name is filled out.');
                    return;
                }

                const lessonSpinner = document.getElementById(`lesson-spinner-${week}`);
                lessonSpinner.classList.remove('hidden');

                fetch('/api/generate-lesson-plan', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ subjectName, topic })
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(errorData => { throw errorData; });
                    }
                    return response.json();
                })
                .then(data => {
                    // Correctly parse the new detailed structure
                    const objectives = data.learning_objectives.map(obj => `- ${obj.objective}: ${obj.description}`).join('\n');
                    
                    let tableContent = 'Lesson Plan:\n';
                    tableContent += '--------------------------------------------------\n';
                    
                    if (data.lesson_plan_table && Array.isArray(data.lesson_plan_table)) {
                        data.lesson_plan_table.forEach(row => {
                            tableContent += `Activity: ${row.activity || 'N/A'}\n`;
                            tableContent += `Description: ${row.description || 'N/A'}\n`;
                            tableContent += `Duration (mins): ${row.duration_minutes || 'N/A'}\n`;
                            tableContent += '--------------------------------------------------\n';
                        });
                    }

                    const lessonContent = data.detailed_lesson_content || 'No detailed lesson content was generated.';

                    weekTextarea.value = `Topic: ${data.topic}\n\n` +
                                       `Learning Objectives:\n${objectives}\n\n` +
                                       `${tableContent}\n` +
                                       `Detailed Lesson:\n${lessonContent}\n\n` +
                                       `Assessment:\n${data.assessment}`;
                })
                .catch(error => {
                    console.error('Error generating detailed lesson:', error);
                    let errorMessage = 'An error occurred while generating the detailed lesson. Check the browser console for more details.';
                    if (error && error.message) {
                        errorMessage = `Error: ${error.message}`;
                    }
                    alert(errorMessage);
                })
                .finally(() => {
                    lessonSpinner.classList.add('hidden');
                });
            });
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
                const subjectName = subjectData.subject_name.toLowerCase();
                const subjectCode = subjectData.subject_code.toLowerCase();
                const subjectType = subjectData.subject_type;

                const searchMatch = subjectName.includes(searchTerm) || subjectCode.includes(searchTerm);
                const typeMatch = (selectedType === 'All Types' || subjectType === selectedType);

                if (searchMatch && typeMatch) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        };

        searchInput.addEventListener('input', filterSubjects);
        typeFilter.addEventListener('change', filterSubjects);

        // --- Double-click Modal Logic ---
        const subjectDetailsModal = document.getElementById('subjectDetailsModal');
        const closeDetailsModalButton = document.getElementById('closeDetailsModalButton');
        const modalDetailsPanel = document.getElementById('modal-details-panel');

        const showDetailsModal = (data) => {
            document.getElementById('detailsSubjectName').textContent = `${data.subject_name} (${data.subject_code})`;
            document.getElementById('detailsSubjectCode').textContent = data.subject_code;
            document.getElementById('detailsSubjectType').textContent = data.subject_type;
            document.getElementById('detailsSubjectUnit').textContent = data.subject_unit;
            
            const lessonsContainer = document.getElementById('detailsLessonsContainer');
            lessonsContainer.innerHTML = '<h3 class="text-md font-bold text-gray-800 pt-4">Lessons</h3>';
            if (data.lessons && Object.keys(data.lessons).length > 0) {
                for (const week in data.lessons) {
                    const lessonDiv = document.createElement('div');
                    lessonDiv.classList.add('p-3', 'bg-gray-100', 'rounded-lg', 'text-sm', 'text-gray-700', 'whitespace-pre-wrap');
                    lessonDiv.innerHTML = `<strong>${week}:</strong>\n${data.lessons[week]}`;
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
        
        const createSubjectCard = (subject) => {
            const newSubjectCard = document.createElement('div');
            newSubjectCard.id = `subject-${subject.subject_code.toLowerCase()}`;
            newSubjectCard.classList.add(
                'subject-card', 'flex', 'items-center', 'justify-between', 'p-3',
                'bg-white', 'hover:bg-blue-50', 'border', 'border-gray-200',
                'rounded-lg', 'cursor-grab', 'transition'
            );
            newSubjectCard.setAttribute('draggable', 'true');
            newSubjectCard.dataset.subjectData = JSON.stringify(subject);

            newSubjectCard.innerHTML = `
                <div>
                    <p class="font-semibold text-gray-700">${subject.subject_code}</p>
                    <p class="text-xs text-gray-500">${subject.subject_name}</p>
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
            addDraggableEvents(newSubjectCard);
            addDoubleClickEvents(newSubjectCard);
            addDeleteButtonEvents(newSubjectCard);

            return newSubjectCard;
        };

        const addDeleteButtonEvents = (item) => {
            const deleteBtn = item.querySelector('.delete-subject-btn');
            if (deleteBtn) {
                deleteBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    item.remove();
                });
            }
        };

        const initDragAndDrop = () => {
            const dropzones = document.querySelectorAll('.semester-dropzone');
            
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
                        
                        const existingTags = dropzone.querySelectorAll('.subject-tag');
                        const isDuplicate = Array.from(existingTags).some(tag => {
                            const tagData = JSON.parse(tag.dataset.subjectData);
                            return tagData.subject_code === droppedSubjectData.subject_code;
                        });
                        
                        if (!isDuplicate) {
                            const subjectTag = document.createElement('div');
                            subjectTag.classList.add(
                                'subject-tag', 'bg-blue-100', 'text-blue-800', 'text-sm',
                                'font-medium', 'px-3', 'py-1', 'rounded-full', 'cursor-grab'
                            );
                            subjectTag.textContent = droppedSubjectData.subject_code;
                            subjectTag.setAttribute('draggable', 'true');
                            subjectTag.dataset.subjectData = JSON.stringify(droppedSubjectData);

                            addDraggableEvents(subjectTag);
                            addDoubleClickEvents(subjectTag);
                            
                            dropzone.querySelector('.flex-wrap').appendChild(subjectTag);
                        }
                    }
                });
            });
        };

        // Add a droppable area for removal
        const mainContentArea = document.querySelector('main');
        mainContentArea.addEventListener('dragover', (e) => {
            e.preventDefault();
        });

        mainContentArea.addEventListener('drop', (e) => {
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
            const curriculumId = curriculumSelector.value;
            if (!curriculumId) {
                alert('Please select a curriculum to save.');
                return;
            }

            const curriculumData = [];
            const semesterDropzones = document.querySelectorAll('#curriculumOverview .semester-dropzone');
            semesterDropzones.forEach(dropzone => {
                const year = parseInt(dropzone.dataset.year, 10);
                const semester = parseInt(dropzone.dataset.semester, 10);
                const subjects = [];
                dropzone.querySelectorAll('.subject-tag').forEach(tag => {
                    const subjectData = JSON.parse(tag.dataset.subjectData);
                    // Standardize the data to match the expected backend payload
                    subjects.push({
                        subjectCode: subjectData.subject_code,
                        subjectName: subjectData.subject_name,
                        subjectType: subjectData.subject_type,
                        subjectUnit: subjectData.subject_unit,
                        lessons: subjectData.lessons || {},
                    });
                });
                if (subjects.length > 0) {
                    curriculumData.push({ year, semester, subjects });
                }
            });
            
            fetch('/api/curriculums/save', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ curriculumId, curriculumData })
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(errorData => {
                        throw new Error(errorData.message || 'Failed to save curriculum.');
                    });
                }
                return response.json();
            })
            .then(data => {
                console.log(data.message);
                showSuccessModal();
            })
            .catch(error => {
                console.error('Error saving curriculum:', error);
                // A more user-friendly error message could be displayed here
                alert('An error occurred while saving. Please try again.');
            });
        });

        // --- Core Application Logic ---
        const curriculumSelector = document.getElementById('curriculumSelector');
        const curriculumOverview = document.getElementById('curriculumOverview');

        function fetchCurriculums() {
            fetch('/api/curriculums')
                .then(response => response.json())
                .then(curriculums => {
                    curriculumSelector.innerHTML = '<option value="">Select a Curriculum</option>';
                    curriculums.forEach(curriculum => {
                        const option = document.createElement('option');
                        option.value = curriculum.id;
                        option.textContent = curriculum.name; // Use the formatted name from the backend
                        curriculumSelector.appendChild(option);
                    });
                    
                    const urlParams = new URLSearchParams(window.location.search);
                    const newCurriculumId = urlParams.get('curriculumId');
                    if (newCurriculumId) {
                        curriculumSelector.value = newCurriculumId;
                        fetchCurriculumData(newCurriculumId);
                    }
                })
                .catch(error => {
                    console.error('Error fetching curriculums:', error);
                    // Handle error gracefully on the UI
                });
        }
        
        curriculumSelector.addEventListener('change', (e) => {
            const curriculumId = e.target.value;
            if (curriculumId) {
                fetchCurriculumData(curriculumId);
            } else {
                curriculumOverview.innerHTML = '<p class="text-gray-500 text-center mt-4">Select a curriculum from the dropdown to start mapping subjects.</p>';
                availableSubjectsContainer.innerHTML = '<p class="text-gray-500 text-center mt-4">Select a curriculum to view subjects.</p>';
            }
        });

        function fetchCurriculumData(id) {
            fetch(`/api/curriculums/${id}`)
                .then(response => response.json())
                .then(data => {
                    renderCurriculumOverview(data.curriculum.year_level);
                    renderAvailableSubjects(data.allSubjects);
                    populateMappedSubjects(data.curriculum.subjects);
                })
                .catch(error => {
                    console.error('Error fetching curriculum data:', error);
                    // Handle error gracefully on the UI
                });
        }

        function renderCurriculumOverview(yearLevel) {
            let html = '';
            const maxYear = parseInt(yearLevel, 10);
            for (let i = 1; i <= maxYear; i++) {
                const yearTitle = i === 1 ? '1st Year' : (i === 2 ? '2nd Year' : (i === 3 ? '3rd Year' : '4th Year'));
                html += `
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-3">${yearTitle}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="semester-dropzone bg-white border border-gray-200 rounded-lg p-4 min-h-[100px] hover:border-blue-500 transition-colors" data-year="${i}" data-semester="1">
                                <h4 class="font-semibold text-gray-600 border-b border-gray-200 pb-2 mb-3">First Semester</h4>
                                <div class="flex flex-wrap gap-2"></div>
                            </div>
                            <div class="semester-dropzone bg-white border border-gray-200 rounded-lg p-4 min-h-[100px] hover:border-blue-500 transition-colors" data-year="${i}" data-semester="2">
                                <h4 class="font-semibold text-gray-600 border-b border-gray-200 pb-2 mb-3">Second Semester</h4>
                                <div class="flex flex-wrap gap-2"></div>
                            </div>
                        </div>
                    </div>
                `;
            }
            curriculumOverview.innerHTML = html;
            initDragAndDrop();
        }

        function renderAvailableSubjects(subjects) {
            availableSubjectsContainer.innerHTML = '';
            if (subjects.length === 0) {
                availableSubjectsContainer.innerHTML = '<p class="text-gray-500 text-center mt-4">No subjects found. Use the "Add New Subject" button to create some.</p>';
            } else {
                subjects.forEach(subject => {
                    const newSubjectCard = createSubjectCard(subject);
                    availableSubjectsContainer.appendChild(newSubjectCard);
                });
            }
        }

        function populateMappedSubjects(subjects) {
            subjects.forEach(subject => {
                const dropzone = document.querySelector(`#curriculumOverview .semester-dropzone[data-year="${subject.pivot.year}"][data-semester="${subject.pivot.semester}"] .flex-wrap`);
                if (dropzone) {
                    const subjectTag = document.createElement('div');
                    subjectTag.classList.add(
                        'subject-tag', 'bg-blue-100', 'text-blue-800', 'text-sm',
                        'font-medium', 'px-3', 'py-1', 'rounded-full', 'cursor-grab'
                    );
                    subjectTag.textContent = subject.subject_code;
                    subjectTag.setAttribute('draggable', 'true');
                    subjectTag.dataset.subjectData = JSON.stringify(subject);
                    
                    addDraggableEvents(subjectTag);
                    addDoubleClickEvents(subjectTag);
                    dropzone.appendChild(subjectTag);
                }
            });
        }
        
        // Initial call to load curriculums on page load
        fetchCurriculums();
    });
</script>
@endsection
