<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AiController extends Controller
{
    /**
     * Generates a 15-week topic list for a subject using the OpenAI/GitHub model.
     */
    public function generateLessonTopics(Request $request)
    {
        $validated = $request->validate([
            'subjectName' => 'required|string|max:255',
        ]);

        $apiKey = env('OPENAI_API_KEY');

        if (!$apiKey) {
            return response()->json(['error' => 'OpenAI API key is not configured.'], 500);
        }

        $prompt = "Generate a 15-week list of topics for the subject '{$validated['subjectName']}' suitable for early college-level students. IMPORTANT: The output must be a valid JSON object with keys from 'Week 1' to 'Week 15', and the value for each key should be the topic title as a string. Do not include any text or markdown formatting before or after the JSON object.";

        try {
            // Setting a 120-second timeout for this request
            $response = Http::timeout(120)->withToken($apiKey)->post('https://models.github.ai/inference/chat/completions', [
                'model' => 'gpt-4o',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful assistant that generates JSON.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
            ]);

            if ($response->failed()) {
                return response()->json(['error' => 'Failed to generate topics from the AI.', 'details' => $response->json()], $response->status());
            }

            $responseText = $response->json()['choices'][0]['message']['content'];
            $topics = json_decode($responseText, true);

            return response()->json($topics);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An unexpected error occurred while generating topics.', 'details' => $e->getMessage()], 500);
        }
    }

    /**
     * Generates a detailed lesson plan for a specific topic using the OpenAI/GitHub model.
     */
    public function generateLessonPlan(Request $request)
    {
        $validated = $request->validate([
            'subjectName' => 'required|string|max:255',
            'topic' => 'required|string|max:255',
            'subjectUnit' => 'required|numeric',
        ]);

        $apiKey = env('OPENAI_API_KEY');

        if (!$apiKey) {
            return response()->json(['error' => 'OpenAI API key is not configured.'], 500);
        }

        $duration = $validated['subjectUnit'] * 1; 

        $prompt = "Generate a detailed lesson plan for the topic '{$validated['topic']}' in the subject '{$validated['subjectName']}' for early college-level students. The lesson plan should cover a total of {$duration} hours. The response must be a single block of plain text. Do not include any markdown characters like *, #, or ` at the beginning of lines.

Lesson Plan:
Total Duration: {$duration} hours

Learning Objectives:
- [List specific, measurable objectives, e.g., 'Identify key concepts', 'Apply principles to practical problems']
- ...

Detailed Lesson Content:
- Provide a comprehensive, in-depth explanation of the topic.
- Use clear headings and paragraphs to structure the content.
- Ensure the text is rich with information and easy to follow.

Activities:
- [List activities with estimated time, e.g., 'Introduction (30 mins)', 'Group Discussion (45 mins)', 'Practical Exercise (1 hour)']
- ...

Assessment:
- [Describe the assessment method, e.g., 'A short quiz at the end of the session', 'A hands-on project to be submitted next week']
- ...

Ensure that the output is in plain text and strictly follows the structure above without any extra characters.";

        try {
            // ✨ KEY CHANGE HERE: Increased timeout to 120 seconds ✨
            $response = Http::timeout(120)->withToken($apiKey)->post('https://models.github.ai/inference/chat/completions', [
                'model' => 'gpt-4o',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful assistant that generates plain text lesson plans.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
            ]);

            if ($response->failed()) {
                return response()->json(['error' => 'Failed to generate lesson plan from the AI.', 'details' => $response->json()], $response->status());
            }

            $responseText = $response->json()['choices'][0]['message']['content'];
            
            return response()->json(['lessonPlan' => $responseText]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An unexpected error occurred while generating the lesson plan.', 'details' => $e->getMessage()], 500);
        }
    }
}