<?php

use App\Http\Controllers\TratamientoControllerApiRest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// 1. LOGIN ROUTE (Public)
Route::post('/login', function (Request $request) {
    // Validate input
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Find user
    $user = User::where('email', $request->email)->first();

    // Check password
    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['Invalid credentials.'],
        ]);
    }
    // Generate Token
    return response()->json([
        'token' => $user->createToken('api-token')->plainTextToken
    ]);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/services', [TratamientoControllerApiRest::class, 'index']);
});