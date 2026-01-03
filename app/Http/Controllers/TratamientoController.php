<?php

namespace App\Http\Controllers;

use App\Models\Tratamiento;
use Illuminate\Http\Request;

class TratamientoController extends Controller
{
    /**
     * Display a listing of active treatments for public view.
     */
    public function index()
    {
        // Get todos los tratamientos activos 
        $tratamientos = Tratamiento::where('esta_activo', true)
            ->orderBy('nombre')
            ->get();

        return view('tratamientos.index', compact('tratamientos'));
    }


    // detalle del tratamiento
    public function show(Tratamiento $tratamiento)
    {
        // Only show if the treatment is active
        if (!$tratamiento->esta_activo) {
            abort(404);
        }

        // Load professionals who offer this treatment
        $tratamiento->load('profesionales.user');

        return view('tratamientos.show', compact('tratamiento'));
    }
}
