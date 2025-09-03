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

        $curriculum->subjects()->detach();

        foreach ($validated['curriculumData'] as $data) {
            foreach ($data['subjects'] as $subject) {
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

        return response()->json(['message' => 'Curriculum saved successfully!', 'curriculumId' => $curriculum->id]);
    }

    public function getCurriculumWithSubjects($id)
    {
        $curriculum = Curriculum::findOrFail($id);
        $subjects = $curriculum->subjects()->get();

        return response()->json([
            'curriculum' => $curriculum,
            'subjects' => $subjects,
        ]);
    }


    public function storeSubject(Request $request)
    {
        $validated = $request->validate([
            'subjectName' => 'required|string|max:255',
            'subjectCode' => 'required|string|max:255|unique:subjects,subject_code',
            'subjectType' => 'required|string|in:Major,Minor,Elective',
            'subjectUnit' => 'required|integer',
            'lessons' => 'nullable|array',
        ]);

        $subject = Subject::create([
            'subject_name' => $validated['subjectName'],
            'subject_code' => $validated['subjectCode'],
            'subject_type' => $validated['subjectType'],
            'subject_unit' => $validated['subjectUnit'],
            'lessons' => $validated['lessons'],
        ]);

        return response()->json([
            'message' => 'Subject created successfully!',
            'subject' => $subject,
        ], 201);
    }

    public function getAllSubjects()
    {
        return response()->json(Subject::all());
    }

    public function getCurriculums()
    {
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
        $allSubjects = Subject::all();

        return response()->json([
            'curriculum' => $curriculum,
            'allSubjects' => $allSubjects,
        ]);
    }

    public function generateLessonTopics(Request $request)
    {
        $validated = $request->validate([
            'subjectName' => 'required|string|max:255',
        ]);

        $apiKey = env('GOOGLE_API_KEY');
        if (!$apiKey) {
            return response()->json(['error' => 'Google AI API key is not configured.'], 500);
        }

        $prompt = "Generate a 15-week list of topics for the subject '{$validated['subjectName']}' based on the latest industry trends, suitable for Grade 11, Grade 12, and early college-level students. IMPORTANT: The output must be a valid JSON object with keys from 'Week 1' to 'Week 15', and the value for each key should be just the topic title as a string. Do not include any text or markdown formatting before or after the JSON object.";

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
                return response()->json(['error' => 'Failed to generate topics from Google AI.', 'details' => $response->json()], $response->status());
            }

            $responseText = $response->json()['candidates'][0]['content']['parts'][0]['text'];
            $topics = json_decode($responseText, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return response()->json(['error' => 'The AI returned an invalid format for topics. Please try again.'], 500);
            }

            return response()->json($topics);

        } catch (ConnectionException $e) {
            return response()->json(['error' => 'Could not connect to the Google AI service.'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An unexpected error occurred while generating topics.', 'details' => $e->getMessage()], 500);
        }
    }

    public function generateLessonPlan(Request $request)
    {
        $validated = $request->validate([
            'subjectName' => 'required|string|max:255',
            'topic' => 'required|string|max:255',
        ]);

        $apiKey = env('GOOGLE_API_KEY');
        if (!$apiKey) {
            return response()->json(['error' => 'Google AI API key is not configured.'], 500);
        }

        $prompt = "Generate a full and detailed lesson for the topic '{$validated['topic']}' within the subject '{$validated['subjectName']}'. The lesson should be comprehensive enough for a teacher to use directly in a class for Grade 11, Grade 12, and early college-level students, similar in structure and depth to a textbook chapter. The content must be up-to-date with the latest industry trends as of 2025. IMPORTANT: The output must be a valid JSON object with the following five keys:
        1. 'topic': a string with the lesson title.
        2. 'learning_objectives': an array of objects, where each object has two keys: 'objective' (a string for the goal) and 'description' (a detailed string explaining the objective).
        3. 'lesson_plan_table': an array of objects, where each object has 'activity' (e.g., 'Introduction', 'Lecture', 'Activity'), 'description' (what happens), and 'duration_minutes' (integer) keys.
        4. 'detailed_lesson_content': a comprehensive, in-depth lesson written in Markdown, covering the topic thoroughly with detailed explanations, real-world examples, key concepts, and section headers. This is the core teaching material.
        5. 'assessment': a string describing an assessment activity.
        Do not include any text or markdown formatting before or after the JSON object.";

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

            $responseText = $response->json()['candidates'][0]['content']['parts'][0]['text'];
            $lessonPlan = json_decode($responseText, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return response()->json(['error' => 'The AI returned an invalid format for the lesson plan. Please try again.'], 500);
            }

            return response()->json($lessonPlan);

        } catch (ConnectionException $e) {
            return response()->json(['error' => 'Could not connect to the Google AI service.'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An unexpected error occurred while generating the lesson plan.', 'details' => $e->getMessage()], 500);
        }
    }
}