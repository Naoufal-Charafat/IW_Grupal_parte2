<?php

use App\Http\Controllers\PaymentControllerApiRest;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\TratamientoController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

// Rutas de contacto (públicas)
Route::get('/contacto', [ContactoController::class, 'index'])->name('contacto.index');
Route::post('/contacto', [ContactoController::class, 'store'])->name('contacto.store');

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
    
    Route::get('/reservas/confirmation/{reserva}', [ReservaController::class, 'confirmation'])
        ->name('reservas.exito');
    
    // API endpoint for checking professional availability
    Route::get('/api/profesional/{profesional}/disponibilidad', [ReservaController::class, 'getAvailability'])
        ->name('api.profesional.disponibilidad');

    Route::get('/payments', [PaymentControllerApiRest::class, 'initiate'])->name('payment.initiate');
    Route::get('/payments/callback', [PaymentControllerApiRest::class, 'callback'])->name('payment.callback');
});

require __DIR__ . '/auth.php';
