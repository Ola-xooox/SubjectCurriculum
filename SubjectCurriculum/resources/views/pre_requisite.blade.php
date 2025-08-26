@extends('layouts.app')

@section('content')
<main class="flex-1 overflow-y-auto bg-gray-100 p-8">
    <div class="bg-white p-8 rounded-3xl shadow-lg">
        <!-- Header section with title and button -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 pb-4">
            <h2 class="text-2xl font-bold text-gray-800">Prerequisites Configuration</h2>
            <button id="setPrerequisitesButton" class="mt-4 sm:mt-0 bg-blue-600 text-white px-6 py-2.5 rounded-3xl text-sm font-medium hover:bg-blue-700 transition duration-300 flex items-center justify-center space-x-2 shadow-md">
                <!-- Plus SVG icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                <span>Set Prerequisites</span>
            </button>
        </div>

        <!-- Dropdown menu section -->
        <div class="mb-8">
            <div class="relative w-full">
                <select id="mainCurriculumDropdown" class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded-2xl leading-tight focus:outline-none focus:bg-white focus:border-blue-500 text-base shadow-sm">
                    <option selected>Bachelor of Science and Information Technology</option>
                    <option>Bachelor of Arts in English Language</option>
                    <option>Bachelor of Science in Computer Science</option>
                    <option>Bachelor of Science in Electrical Engineering</option>
                </select>
                <!-- Custom dropdown arrow -->
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
        </div>
        
        <!-- Prerequisite Chain section -->
        <div class="space-y-6">
            <h3 class="text-xl font-bold text-gray-800">Prerequisite Chain</h3>
            <!-- Container for the dynamically generated prerequisite chain -->
            <div id="prerequisiteChainContainer" class="space-y-6">
                <!-- Initial placeholder content -->
                <div class="bg-white p-6 rounded-3xl border border-gray-200 shadow-md">
                    <p class="text-center text-gray-500">
                        Select a curriculum and subjects to see the prerequisite chain here.
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal HTML -->
<div id="prerequisitesModal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden transition-opacity duration-300 opacity-0">
    <div id="modal-panel" class="bg-white p-8 rounded-3xl shadow-xl transform transition-all duration-300 sm:w-1/2 scale-95 opacity-0">
        <div class="flex items-center justify-between pb-4 border-b">
            <div>
                <h3 class="text-2xl font-bold text-gray-800">Prerequisites</h3>
                <p class="text-sm text-gray-500">Set a Prerequisites Configuration</p>
            </div>
            <!-- Close button for modal -->
            <button id="closeModalButton" class="text-gray-400 hover:text-gray-600 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="mt-4 space-y-6">
            <div>
                <label for="curriculum" class="block text-gray-700 font-semibold mb-2">Select Curriculum</label>
                <div class="relative">
                    <select id="modalCurriculumDropdown" class="block w-full appearance-none bg-white border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded-2xl leading-tight focus:outline-none focus:bg-white focus:border-blue-500 text-base shadow-sm">
                        <option value="BSIT" selected>Bachelor of Science and Information Technology</option>
                        <option value="BAEL">Bachelor of Arts in English Language</option>
                        <option value="BSCS">Bachelor of Science in Computer Science</option>
                        <option value="BSEE">Bachelor of Science in Electrical Engineering</option>
                    </select>
                    <!-- Correct dropdown arrow for select input -->
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
            </div>
            <div>
                <label for="subjects-input" class="block text-gray-700 font-semibold mb-2">Select Subjects</label>
                <div id="subjects-input-container" class="relative">
                    <input type="text" id="subjects-input" readonly placeholder="Select Subjects" class="block w-full bg-white border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded-2xl leading-tight focus:outline-none focus:ring focus:border-blue-500 shadow-sm cursor-pointer">
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
                <!-- Checklist container now matches the width of the input field -->
                <div id="subjects-checklist" class="hidden absolute z-10 w-full mt-2 bg-white rounded-md shadow-lg border border-gray-300 max-h-48 overflow-y-auto">
                    <div class="p-4 space-y-2">
                        <!-- Subjects will be populated here by JavaScript -->
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-6 flex justify-end space-x-4">
            <button id="cancelModalButton" class="bg-gray-300 text-gray-800 px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-400 transition duration-300 shadow-md">
                CANCEL
            </button>
            <button id="saveModalButton" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-blue-700 transition duration-300 shadow-md">
                SAVE
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // --- Modal Logic for Prerequisites Configuration ---
        const prerequisitesModal = document.getElementById('prerequisitesModal');
        const setPrerequisitesButton = document.getElementById('setPrerequisitesButton');
        const closeModalButton = document.getElementById('closeModalButton');
        const cancelModalButton = document.getElementById('cancelModalButton');
        const saveModalButton = document.getElementById('saveModalButton');
        const modalPanel = document.getElementById('modal-panel');
        const subjectsInput = document.getElementById('subjects-input');
        const subjectsChecklist = document.getElementById('subjects-checklist');
        
        const mainCurriculumDropdown = document.getElementById('mainCurriculumDropdown');
        const modalCurriculumDropdown = document.getElementById('modalCurriculumDropdown');
        const prerequisiteChainContainer = document.getElementById('prerequisiteChainContainer');

        // Sample subjects data grouped by curriculum for dynamic loading
        const subjects = {
            'BSIT': [
                '1st year - 1st Sem - Computer Programming 1 - COMPROG1',
                '1st year - 2nd Sem - Computer Programming 2 - COMPROG2',
                '1st year - 2nd Sem - Data Structures & Algorithms - DSA',
                '2nd year - 1st Sem - Information Management - INFOMGT',
                '2nd year - 1st Sem - Object-Oriented Programming - OOPROG',
                '2nd year - 1st Sem - Platform Technologies - PLATTECH',
                '2nd year - 2nd Sem - Web Systems & Technologies - WEBTECH'
            ],
            'PE': [
                '1st year - 1st Sem - Physical Education 1 - PE 1',
                '1st year - 2nd Sem - Physical Education 2 - PE 2',
                '2nd year - 1st Sem - Physical Education 3 - PE 3'
            ],
            'BAEL': [
                'BAEL Subject A',
                'BAEL Subject B',
                'BAEL Subject C'
            ],
            'BSCS': [
                'BSCS Subject A',
                'BSCS Subject B',
                'BSCS Subject C'
            ],
            'BSEE': [
                'BSEE Subject A',
                'BSEE Subject B',
                'BSEE Subject C'
            ]
        };

        let selectedSubjects = [];
        let prerequisiteData = {};

        // Function to update the subjects checklist in the modal
        const updateChecklist = (curriculum) => {
            const subjectsChecklistContainer = subjectsChecklist.querySelector('div');
            subjectsChecklistContainer.innerHTML = '';
            
            // Get subjects for the selected curriculum
            const curriculumSubjects = subjects[curriculum] || [];
            
            curriculumSubjects.forEach(subject => {
                const isChecked = selectedSubjects.includes(subject);
                const checkbox = document.createElement('div');
                checkbox.classList.add('flex', 'items-center', 'space-x-2');
                checkbox.innerHTML = `
                    <input type="checkbox" id="${subject}" name="subject" value="${subject}" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" ${isChecked ? 'checked' : ''}>
                    <label for="${subject}" class="text-sm font-medium text-gray-700">${subject}</label>
                `;
                subjectsChecklistContainer.appendChild(checkbox);
            });
        };

        // Function to update the text in the subjects input field
        const updateSubjectsInputText = () => {
            if (selectedSubjects.length > 0) {
                subjectsInput.value = selectedSubjects.join(', ');
            } else {
                subjectsInput.value = '';
            }
        };

        // Event listener for checkbox changes
        subjectsChecklist.addEventListener('change', (event) => {
            if (event.target.type === 'checkbox') {
                const subject = event.target.value;
                if (event.target.checked) {
                    if (!selectedSubjects.includes(subject)) {
                        selectedSubjects.push(subject);
                    }
                } else {
                    const index = selectedSubjects.indexOf(subject);
                    if (index > -1) {
                        selectedSubjects.splice(index, 1);
                    }
                }
                updateSubjectsInputText();
            }
        });

        // Function to generate a single prerequisite chain block
        const generateChainBlock = (subjects) => {
            let html = `
                <div class="bg-white p-6 rounded-3xl border border-gray-200 shadow-md">
                    <ul class="list-none space-y-3 text-gray-700">
            `;
            const indentations = ['pl-0', 'pl-6', 'pl-12', 'pl-18', 'pl-24', 'pl-30', 'pl-36'];
            
            subjects.forEach((subject, index) => {
                const indent = indentations[index] || indentations[indentations.length - 1];
                html += `
                    <li class="font-medium text-gray-800 flex items-start ${indent}">
                        <span class="mr-2 text-blue-600 font-bold">&#8594;</span>
                        <span class="flex-1">
                            <span class="font-semibold text-blue-600">${subject}</span>
                        </span>
                    </li>
                `;
            });
            html += '</ul></div>';
            return html;
        };

        // Function to render all prerequisite chains for the main page
        const renderAllChains = (data) => {
            prerequisiteChainContainer.innerHTML = ''; // Clear existing chains

            if (Object.keys(data).length === 0) {
                 prerequisiteChainContainer.innerHTML = `
                    <div class="bg-white p-6 rounded-3xl border border-gray-200 shadow-md">
                        <p class="text-center text-gray-500">
                            Select a curriculum and subjects to see the prerequisite chain here.
                        </p>
                    </div>`;
            } else {
                // Loop through each curriculum and its saved subject chains
                for (const curriculumId in data) {
                    if (data.hasOwnProperty(curriculumId)) {
                        const curriculumName = modalCurriculumDropdown.options.namedItem(curriculumId)?.text || curriculumId;
                        const savedChains = data[curriculumId];
                        
                        savedChains.forEach(subjectsArray => {
                            prerequisiteChainContainer.innerHTML += generateChainBlock(subjectsArray);
                        });
                    }
                }
            }
        };

        // Function to open the modal with a smooth transition
        const openModal = () => {
            prerequisitesModal.classList.remove('hidden');
            selectedSubjects = []; // Clear selected subjects on modal open
            updateChecklist(modalCurriculumDropdown.value); // Populate checklist based on current dropdown
            updateSubjectsInputText();
            setTimeout(() => {
                prerequisitesModal.classList.add('opacity-100');
                modalPanel.classList.remove('scale-95', 'opacity-0');
                modalPanel.classList.add('scale-100', 'opacity-100');
            }, 10);
        };

        // Function to close the modal with a smooth transition
        const closeModal = () => {
            prerequisitesModal.classList.remove('opacity-100');
            modalPanel.classList.remove('scale-100', 'opacity-100');
            modalPanel.classList.add('scale-95', 'opacity-0');
            subjectsChecklist.classList.add('hidden'); // Hide checklist on close
            setTimeout(() => {
                prerequisitesModal.classList.add('hidden');
            }, 300); // Wait for the transition to finish
        };

        // Toggle the subjects checklist visibility
        subjectsInput.addEventListener('click', (event) => {
            event.stopPropagation(); // Prevent modal from closing when clicking the input
            subjectsChecklist.classList.toggle('hidden');
        });

        // Close checklist when clicking outside
        document.addEventListener('click', (event) => {
            if (!subjectsChecklist.contains(event.target) && !subjectsInput.contains(event.target)) {
                subjectsChecklist.classList.add('hidden');
            }
        });
        
        // Event listener for modal curriculum dropdown change
        modalCurriculumDropdown.addEventListener('change', (event) => {
            const selectedValue = event.target.value;
            selectedSubjects = []; // Reset selected subjects
            updateChecklist(selectedValue);
            updateSubjectsInputText();
        });


        if (setPrerequisitesButton) {
            setPrerequisitesButton.addEventListener('click', openModal);
        }
        if (closeModalButton) {
            closeModalButton.addEventListener('click', closeModal);
        }
        if (cancelModalButton) {
            cancelModalButton.addEventListener('click', closeModal);
        }
        if (saveModalButton) {
            saveModalButton.addEventListener('click', () => {
                const selectedCurriculumId = modalCurriculumDropdown.value;

                // Add the selected subjects as a new chain to our data structure
                if (!prerequisiteData[selectedCurriculumId]) {
                    prerequisiteData[selectedCurriculumId] = [];
                }
                prerequisiteData[selectedCurriculumId].push([...selectedSubjects]);
                
                // Update main content with all saved chains
                renderAllChains(prerequisiteData);

                // Set the main dropdown to the selected curriculum
                mainCurriculumDropdown.value = modalCurriculumDropdown.options.namedItem(selectedCurriculumId)?.text;
                
                closeModal();
            });
        }
        
        // Initial render on page load
        renderAllChains(prerequisiteData);


        if (prerequisitesModal) {
            prerequisitesModal.addEventListener('click', (event) => {
                if (event.target === prerequisitesModal) {
                    closeModal();
                }
            });
        }
    });
</script>
@endsection
