<?php

use App\Http\Controllers\TratamientoController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

// Public routes for treatments
Route::get('/tratamientos', [TratamientoController::class, 'index'])->name('tratamientos.index');
Route::get('/tratamientos/{tratamiento}', [TratamientoController::class, 'show'])->name('tratamientos.show');

require __DIR__ . '/auth.php';
