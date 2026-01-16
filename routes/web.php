<?php

use App\Http\Controllers\ReservaController;
use App\Http\Controllers\TratamientoController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

// Public rutas para los tratamientos
Route::get('/tratamientos', [TratamientoController::class, 'index'])->name('tratamientos.index');
Route::get('/tratamientos/{tratamiento}', [TratamientoController::class, 'show'])->name('tratamientos.show');

// rutas de reservaciones - necesita que el usuario sea autentificado
Route::middleware('auth')->group(function () {
    Route::get('/reservas/tratamiento/{tratamiento}/profesionales', [ReservaController::class, 'selectProfesional'])
        ->name('reservas.select-profesional');
    
    Route::get('/reservas/tratamiento/{tratamiento}/profesional/{profesional}/fecha-hora', [ReservaController::class, 'selectDateTime'])
        ->name('reservas.select-datetime');
    
    Route::get('/reservas/confirmar', [ReservaController::class, 'showConfirmation'])
        ->name('reservas.confirmar');
    
    Route::post('/reservas/guardar', [ReservaController::class, 'store'])
        ->name('reservas.store');
    
    Route::get('/reservas/exito/{reserva}', [ReservaController::class, 'success'])
        ->name('reservas.exito');
    
    // API endpoint for checking professional availability
    Route::get('/api/profesional/{profesional}/disponibilidad', [ReservaController::class, 'getAvailability'])
        ->name('api.profesional.disponibilidad');
});

require __DIR__ . '/auth.php';
