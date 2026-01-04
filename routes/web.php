<?php

use App\Models\Tratamiento;
use App\Models\Profesional;
use App\Models\User;
use App\Http\Controllers\TratamientoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // 1. Tratamientos destacados desde BD
    $tratamientosDestacados = Tratamiento::where('esta_activo', true)
                                          ->orderBy('created_at', 'desc')
                                          ->take(3)
                                          ->get();
    
    // 2. Profesionales desde BD con sus usuarios
    $profesionales = Profesional::with('user')
                                 ->take(3)
                                 ->get();
    
    // 3. Pasar todo a la vista
    return view('welcome', [
        'tratamientosDestacados' => $tratamientosDestacados,
        'profesionales' => $profesionales
    ]);
})->name('home');

// Rutas públicas de tratamientos
Route::get('/tratamientos', [TratamientoController::class, 'index'])->name('tratamientos.index');
Route::get('/tratamientos/{tratamiento}', [TratamientoController::class, 'show'])->name('tratamientos.show');

require __DIR__ . '/auth.php';