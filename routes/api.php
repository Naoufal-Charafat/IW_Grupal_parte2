<?php

use App\Http\Controllers\PaymentControllerApiRest;
use App\Http\Controllers\TratamientoControllerApiRest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// 1. LOGIN ROUTE (Public)
Route::post('/login', [TratamientoControllerApiRest::class, 'login'])->name('login-api');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/services', [TratamientoControllerApiRest::class, 'index']);
});

