<?php

namespace App\Http\Controllers;

use App\Models\Tratamiento;
use Illuminate\Http\Request;

class TratamientoController extends Controller
{
    /**
     * Display a listing of active treatments for public view.
     */
    public function index(Request $request)
    {
        // Query base: solo tratamientos activos
        $query = Tratamiento::where('esta_activo', true);

        // Búsqueda por nombre
        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        // Filtro por precio mínimo
        if ($request->filled('precio_min')) {
            $query->where('precio', '>=', $request->precio_min);
        }

        // Filtro por precio máximo
        if ($request->filled('precio_max')) {
            $query->where('precio', '<=', $request->precio_max);
        }

        // Filtro por duración mínima
        if ($request->filled('duracion_min')) {
            $query->where('duracion_minutos', '>=', $request->duracion_min);
        }

        // Filtro por duración máxima
        if ($request->filled('duracion_max')) {
            $query->where('duracion_minutos', '<=', $request->duracion_max);
        }

        // Obtener tratamientos ordenados por nombre
        $tratamientos = $query->orderBy('nombre')->get();

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
