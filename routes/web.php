<?php

use App\Http\Controllers\ReservaController;
use App\Http\Controllers\TratamientoController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

// Public routes for treatments
Route::get('/tratamientos', [TratamientoController::class, 'index'])->name('tratamientos.index');
Route::get('/tratamientos/{tratamiento}', [TratamientoController::class, 'show'])->name('tratamientos.show');

// Reservation routes - requires authentication
Route::middleware('auth')->group(function () {
    Route::get('/reservas/tratamiento/{tratamiento}/profesionales', [ReservaController::class, 'selectProfesional'])
        ->name('reservas.select-profesional');
    
    Route::get('/reservas/tratamiento/{tratamiento}/profesional/{profesional}/fecha-hora', [ReservaController::class, 'selectDateTime'])
        ->name('reservas.select-datetime');
});

require __DIR__ . '/auth.php';
