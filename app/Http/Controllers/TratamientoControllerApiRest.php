<?php

namespace App\Http\Controllers;

use App\Models\Tratamiento;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

class TratamientoControllerApiRest extends Controller
{
    use ApiResponses; // Usamos el trait para respuestas JSON estandarizadas

    /**
     * Listado de tratamientos activos (API)
     * Soporta filtros por nombre, precio y duración.
     */
    public function index(Request $request)
    {
        try {
            $validated = $request->validate([
                //'uid'   => 'required|string', // Obligatorio: ID del hotel/cliente
                'from'  => 'nullable|date_format:Y-m-d',
                'till'  => 'nullable|date_format:Y-m-d|after_or_equal:from',
                'name'  => 'nullable|string',
                'phone' => 'nullable|string',
            ]);
        } catch (ValidationException $e) {
            return $this->validationError($e->errors());
        }

        $fromDate = Carbon::now();
        if ($request->has('from')) {
            $requestedFrom = Carbon::parse($request->input('from'));
            // Comparamos startOfDay() para ignorar la hora y solo ver la fecha
            if ($requestedFrom->startOfDay()->greaterThanOrEqualTo(Carbon::now()->startOfDay())) {
                $fromDate = $requestedFrom;
            }
        }
        $tillDate = $fromDate->copy()->addMonth();
        if ($request->has('till')) {
            $requestedTill = Carbon::parse($request->input('till'));
            if ($requestedTill->startOfDay()->greaterThanOrEqualTo($fromDate->startOfDay())) {
                $tillDate = $requestedTill;
            }
        }

        // Solo tratamientos activos
        $query = Tratamiento::where('esta_activo', true);
        $tratamientos = $query->orderBy('nombre')->get();

        return $this->success($tratamientos, 'Listado de tratamientos obtenido correctamente');
    }
}