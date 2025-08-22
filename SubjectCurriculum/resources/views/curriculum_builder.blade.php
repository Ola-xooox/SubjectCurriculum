@extends('layouts.app')

@section('content')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-8">
        <div class="container mx-auto">
            {{-- Main Content Section --}}
            <div class="bg-white p-6 rounded-2xl shadow-lg mb-8">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-800">Curriculum Builder</h1>
                    <button id="addCurriculumButton" class="flex items-center space-x-2 px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition-colors shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        <span>Add New Curriculums</span>
                    </button>
                </div>
            </div>

            {{-- Existing Curriculums Section --}}
            <div class="bg-white p-6 rounded-2xl shadow-lg">
                <h2 class="text-xl font-bold text-gray-700 mb-6">Existing Curriculums</h2>
                
                <div id="curriculumsContainer" class="space-y-4">
                    {{-- Existing items will be here --}}
                    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex justify-between items-center hover:shadow-md transition-shadow">
                        <div>
                            <h3 class="text-md font-bold text-gray-900">Bachelor of Science and Information Technology</h3>
                            <p class="text-sm text-gray-500">Curriculum Code: <span class="font-semibold text-gray-700">BSIT</span></p>
                            <p class="text-sm text-gray-500">Academic Year: <span class="font-semibold text-gray-700">2025-2026</span></p>
                        </div>
                        {{-- Delete Button has been removed from here --}}
                    </div>
                </div>
            </div>
            
            {{-- Modal for adding a new curriculum --}}
            <div id="addCurriculumModal" class="fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-75 transition-opacity duration-300 ease-out hidden">
                <div class="flex items-center justify-center min-h-screen p-4">
                    <div class="relative bg-white w-full max-w-xl rounded-2xl shadow-2xl p-6 md:p-8 transform scale-95 opacity-0 transition-all duration-300 ease-out" id="modal-panel">
                        
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-extrabold text-gray-800">Create New Curriculum</h2>
                            <button id="closeModalButton" class="text-gray-400 hover:text-gray-600 focus:outline-none transition-colors duration-200" aria-label="Close modal">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <form id="curriculumForm" class="space-y-6">
                            <div>
                                <label for="curriculumName" class="block text-sm font-semibold text-gray-700 mb-1">Curriculum Name</label>
                                <input type="text" id="curriculumName" name="curriculumName" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"  required>
                            </div>
                            <div>
                                <label for="curriculumCode" class="block text-sm font-semibold text-gray-700 mb-1">Curriculum Code</label>
                                <input type="text" id="curriculumCode" name="curriculumCode" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"  required>
                            </div>
                            <div>
                                <label for="academicYear" class="block text-sm font-semibold text-gray-700 mb-1">Academic Year</label>
                                <input type="text" id="academicYear" name="academicYear" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"  required>
                            </div>
                            <div>
                                <label for="yearLevel" class="block text-sm font-semibold text-gray-700 mb-1">Year Level</label>
                                <select id="yearLevel" name="yearLevel" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required>
                                    <option value="" disabled selected>Select Year Level</option>
                                    <option value="2nd Year">2nd Year</option>
                                    <option value="4th Year">4th Year</option>
                                </select>
                            </div>
                            <div class="pt-4 flex justify-end gap-3">
                                <button type="button" id="cancelModalButton" class="px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors">
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
            
        </div>
    </main>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Get modal elements
            const addCurriculumButton = document.getElementById('addCurriculumButton');
            const addCurriculumModal = document.getElementById('addCurriculumModal');
            const closeModalButton = document.getElementById('closeModalButton');
            const cancelModalButton = document.getElementById('cancelModalButton');
            const modalPanel = document.getElementById('modal-panel');
            const curriculumForm = document.getElementById('curriculumForm');
            const curriculumsContainer = document.getElementById('curriculumsContainer');

            // Function to show the modal with animation
            const showModal = () => {
                addCurriculumModal.classList.remove('hidden');
                setTimeout(() => {
                    addCurriculumModal.classList.remove('opacity-0');
                    modalPanel.classList.remove('opacity-0', 'scale-95');
                }, 10);
            };

            // Function to hide the modal with animation
            const hideModal = () => {
                addCurriculumModal.classList.add('opacity-0');
                modalPanel.classList.add('opacity-0', 'scale-95');
                setTimeout(() => {
                    addCurriculumModal.classList.add('hidden');
                }, 300);
            };

            // Event listeners to show/hide the modal
            addCurriculumButton.addEventListener('click', showModal);
            closeModalButton.addEventListener('click', hideModal);
            cancelModalButton.addEventListener('click', hideModal);

            // Hide modal when clicking outside of it
            addCurriculumModal.addEventListener('click', (e) => {
                if (e.target.id === 'addCurriculumModal') {
                    hideModal();
                }
            });

            // Form submission logic
            curriculumForm.addEventListener('submit', (e) => {
                e.preventDefault();

                // Get form data
                const curriculumName = document.getElementById('curriculumName').value;
                const curriculumCode = document.getElementById('curriculumCode').value;
                const academicYear = document.getElementById('academicYear').value;
                const yearLevel = document.getElementById('yearLevel').value; // Still captured but not used in the card title

                // Create a new curriculum card element
                const newCurriculumCard = document.createElement('div');
                newCurriculumCard.classList.add(
                    'bg-white',
                    'p-4',
                    'rounded-xl',
                    'border',
                    'border-gray-200',
                    'shadow-sm',
                    'flex',
                    'justify-between',
                    'items-center',
                    'hover:shadow-md',
                    'transition-shadow'
                );

                // MODIFIED: Updated innerHTML to hide the year level from the title
                newCurriculumCard.innerHTML = `
                    <div>
                        <h3 class="text-md font-bold text-gray-900">${curriculumName}</h3>
                        <p class="text-sm text-gray-500">Curriculum Code: <span class="font-semibold text-gray-700">${curriculumCode}</span></p>
                        <p class="text-sm text-gray-500">Academic Year: <span class="font-semibold text-gray-700">${academicYear}</span></p>
                    </div>
                `;

                // Add the new card to the container
                curriculumsContainer.appendChild(newCurriculumCard);

                // Hide the modal and reset the form
                hideModal();
                curriculumForm.reset();
            });
        });
    </script>
@endsection