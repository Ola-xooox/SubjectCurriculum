@extends('layouts.app')

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-8">
    {{-- Removed max-width class to make the container wider --}}
    <div class="container mx-auto">
        {{-- Main Content Section --}}
        <div class="bg-white p-12 rounded-xl shadow-sm border border-gray-200">
            <form action="{{ route('ched.validator.validate') }}" method="POST">
                @csrf

                {{-- Page Title Section (Moved Inside) --}}
                <div class="mb-12 text-left border-b pb-8 border-gray-200">
                    <h1 class="text-4xl font-bold text-gray-800">Compliance Validator</h1>
                    <p class="text-lg text-gray-500 mt-2">
                        Cross-reference your curriculum with CHED standards efficiently.
                    </p>
                </div>

                <div class="space-y-12">
                    {{-- Step 1: Select Curriculum --}}
                    <div class="relative pl-10">
                        {{-- Stepper Line & Dot --}}
                        <div class="absolute left-0 top-1.5 h-full border-l-2 border-gray-200" aria-hidden="true"></div>
                        <div class="absolute left-[-9px] top-1.5 w-5 h-5 bg-blue-800 rounded-full border-4 border-white" aria-hidden="true"></div>

                        <label for="curriculum_id" class="block text-xl font-semibold text-gray-800">
                            1. Select Curriculum
                        </label>
                        <p class="text-base text-gray-500 mt-1 mb-4">Choose the curriculum program to be validated.</p>
                        <select name="curriculum_id" id="curriculum_id" class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                            <option disabled selected>-- Choose a curriculum --</option>
                            @foreach($curriculums as $curriculum)
                                <option value="{{ $curriculum->id }}">
                                    {{ $curriculum->curriculum_name }} ({{ $curriculum->curriculum_year }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Step 2: Select CMO --}}
                    <div class="relative pl-10">
                        {{-- Stepper Dot --}}
                        <div class="absolute left-[-9px] top-1.5 w-5 h-5 bg-blue-800 rounded-full border-4 border-white" aria-hidden="true"></div>

                        <label for="cmo_id" class="block text-xl font-semibold text-gray-800">
                            2. Select CHED Memorandum Order
                        </label>
                        <p class="text-base text-gray-500 mt-1 mb-4">Choose the CMO to validate the curriculum against.</p>
                        <select name="cmo_id" id="cmo_id" class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                            <option disabled selected>-- Choose a CMO --</option>
                            @foreach($cmos as $cmo)
                                <option value="{{ $cmo->id }}">
                                    {{ $cmo->cmo_number }} - {{ $cmo->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Submit Button Area --}}
                    <div class="pt-8 flex justify-end">
                        <button type="submit" class="inline-flex items-center px-7 py-3 bg-blue-800 text-white font-semibold text-base rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                            {{-- Outline Icon --}}
                            <svg class="w-5 h-5 mr-2.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Run Validation
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection