<?php

use App\Models\FaceDescriptor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SignController;
use Illuminate\Support\Facades\Auth;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/face-login-check', function (Request $request) {
    $inputDescriptor = collect($request->descriptor);

    foreach (FaceDescriptor::all() as $face) {
        $stored = collect(json_decode($face->descriptor));
        $distance = sqrt($stored->zip($inputDescriptor)->map(fn($pair) => pow($pair[0] - $pair[1], 2))->sum());

        if ($distance < 0.5) {
            Auth::loginUsingId($face->user_id);
            $user = Auth::user();
// dd($user->role);
            return response()->json([
                'success' => true,
                'role' => strtolower($user->role->name),
            ]);
        }
    }

    return response()->json(['success' => false]);
});
Route::post('/assistant/question', [App\Http\Controllers\AssistantController::class, 'answer']);
