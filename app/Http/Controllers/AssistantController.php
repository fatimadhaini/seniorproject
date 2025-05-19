<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class AssistantController extends Controller
{
    public function answer(Request $request)
    {
        $question = $request->input('question');
        $searchTerm = urlencode($question);

        // Use Wikipedia REST API
        $response = Http::get("https://en.wikipedia.org/api/rest_v1/page/summary/{$searchTerm}");

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['extract'])) {
                return response()->json([
                    'answer' => $data['extract']
                ]);
            } else {
                return response()->json([
                    'answer' => "Sorry, I couldn’t find information about that topic on Wikipedia."
                ]);
            }
        }

        return response()->json([
            'answer' => 'Sorry, something went wrong while connecting to Wikipedia.'
        ], 500);
    }
}
