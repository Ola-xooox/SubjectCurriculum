<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurriculumController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'curriculumName' => 'required|string|max:255',
            'curriculumCode' => 'required|string|max:255|unique:curriculums,curriculum_code',
            'academicYear' => 'required|string|max:255',
            'yearLevel' => 'required|in:2nd Year,4th Year',
        ]);

        $curriculum = Curriculum::create([
            'curriculum_name' => $validated['curriculumName'],
            'curriculum_code' => $validated['curriculumCode'],
            'academic_year' => $validated['academicYear'],
            'year_level' => (int) filter_var($validated['yearLevel'], FILTER_SANITIZE_NUMBER_INT),
        ]);

        return redirect()->route('subject_mapping', ['curriculumId' => $curriculum->id]);
    }

    public function saveSubjects(Request $request)
    {
        $validated = $request->validate([
            'curriculumId' => 'required|exists:curriculums,id',
            'curriculumData' => 'required|array',
        ]);

        $curriculum = Curriculum::findOrFail($validated['curriculumId']);

        // Clear existing subjects to prevent duplicates on resaving
        $curriculum->subjects()->detach();

        foreach ($validated['curriculumData'] as $data) {
            foreach ($data['subjects'] as $subject) {
                // Find or create the subject. This handles new subjects from the 'Add New Subject' form
                $dbSubject = Subject::firstOrCreate(
                    ['subject_code' => $subject['subjectCode']],
                    [
                        'subject_name' => $subject['subjectName'],
                        'subject_type' => $subject['subjectType'],
                        'subject_unit' => $subject['subjectUnit'],
                        'lessons' => json_encode($subject['lessons']),
                    ]
                );

                $curriculum->subjects()->attach($dbSubject->id, [
                    'year' => $data['year'],
                    'semester' => $data['semester'],
                ]);
            }
        }
        
        return response()->json(['message' => 'Curriculum saved successfully!']);
    }

    public function getCurriculums()
    {
        // Fetch all curriculums and format them as an array of objects.
        return response()->json(Curriculum::all()->map(function ($curriculum) {
            return [
                'id' => $curriculum->id,
                'name' => "{$curriculum->curriculum_name} - {$curriculum->curriculum_code} ({$curriculum->academic_year})",
                'curriculum_name' => $curriculum->curriculum_name,
                'curriculum_code' => $curriculum->curriculum_code,
                'academic_year' => $curriculum->academic_year,
                'year_level' => $curriculum->year_level
            ];
        }));
    }

    public function getCurriculumData($id)
    {
        $curriculum = Curriculum::with('subjects')->findOrFail($id);
        $allSubjects = Subject::all(); // Get all subjects for the available list

        return response()->json([
            'curriculum' => $curriculum,
            'allSubjects' => $allSubjects,
        ]);
    }
}
