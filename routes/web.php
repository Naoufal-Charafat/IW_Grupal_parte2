<?php

use App\Models\Tratamiento;
use App\Models\Profesional;
use App\Models\User;
use App\Http\Controllers\TratamientoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Tratamientos destacados desde BD
    $tratamientosDestacados = Tratamiento::where('esta_activo', true)
                                          ->orderBy('created_at', 'desc')
                                          ->take(3)
                                          ->get();
    
    $profesionales = Profesional::with('user')
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