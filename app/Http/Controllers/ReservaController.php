<?php

namespace App\Http\Controllers;

use App\Models\Tratamiento;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    /**
     * muestra la lista de professionals del tratamiento especifico.
     */
    public function selectProfesional(Tratamiento $tratamiento)
    {
        if (!$tratamiento->esta_activo) {
            abort(404);
        }

        // Load professionales con sus users
        $profesionales = $tratamiento->profesionales()
            ->wherePivot('esta_activo', true)
            ->with('user')
            ->get();

        //Si no hay ningun professional disponible, hace redirect con un mensaje
        if ($profesionales->isEmpty()) {
            return redirect()
                ->route('tratamientos.show', $tratamiento)
                ->with('error', 'No hay profesionales disponibles para este tratamiento en este momento.');
        }

        return view('reservas.select-profesional', compact('tratamiento', 'profesionales'));
    }
}
