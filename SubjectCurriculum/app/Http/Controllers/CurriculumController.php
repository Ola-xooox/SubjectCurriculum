<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;

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

    /**
     * Generate a lesson plan using Google AI Studio (Gemini API).
     */
    public function generateLessonPlan(Request $request)
    {
        $validated = $request->validate([
            'subjectName' => 'required|string|max:255',
            'subjectCode' => 'required|string|max:255',
            'subjectType' => 'required|string|max:255',
            'subjectUnit' => 'required|integer',
        ]);

        $apiKey = env('GOOGLE_API_KEY');
        if (!$apiKey) {
            return response()->json(['error' => 'Google AI API key is not configured.'], 500);
        }

        $prompt = "Generate a comprehensive 15-week lesson plan for the subject '{$validated['subjectName']}' ({$validated['subjectCode']}). The subject is a '{$validated['subjectType']}' type with {$validated['subjectUnit']} units. For each week, provide a topic, a list of learning objectives, detailed lesson content relevant to current trends, and a simple assessment activity. IMPORTANT: The output must be a valid JSON object with keys from 'Week 1' to 'Week 15'. Each weekly value must be an object with four keys: 'topic' (string), 'learning_objectives' (an array of strings), 'lesson_content' (a detailed string), and 'assessment' (a string). Do not include any text or markdown formatting before or after the JSON object.";

        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key={$apiKey}";

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'responseMimeType' => 'application/json',
                ]
            ]);

            if ($response->failed()) {
                return response()->json(['error' => 'Failed to generate lesson plan from Google AI.', 'details' => $response->json()], $response->status());
            }

            // The Gemini API response for JSON is nested differently
            $responseText = $response->json()['candidates'][0]['content']['parts'][0]['text'];
            $lessonPlan = json_decode($responseText, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return response()->json(['error' => 'The AI returned an invalid format. Please try again.'], 500);
            }

            return response()->json($lessonPlan);

        } catch (ConnectionException $e) {
            return response()->json(['error' => 'Could not connect to the Google AI service. Please check your network connection.'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An unexpected error occurred.', 'details' => $e->getMessage()], 500);
        }
    }
}
