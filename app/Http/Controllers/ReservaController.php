<?php

namespace App\Http\Controllers;

use App\Models\Profesional;
use App\Models\Reserva;
use App\Models\Tratamiento;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    /**
     * Show date and time selection for a specific professional and treatment
     */
    public function selectDateTime(Tratamiento $tratamiento, Profesional $profesional)
    {
        if (!$tratamiento->esta_activo) {
            abort(404);
        }

        // Verify professional can perform this treatment
        $pivotData = $profesional->tratamientos()
            ->where('tratamiento_id', $tratamiento->id)
            ->wherePivot('esta_activo', true)
            ->first();

        if (!$pivotData) {
            return redirect()
                ->route('reservas.select-profesional', $tratamiento)
                ->with('error', 'Este profesional no puede realizar este tratamiento.');
        }

        // Get price for this professional-treatment combination
        $precio = $pivotData->pivot->precio_personalizado ?? $tratamiento->precio;
        $duracion = $pivotData->pivot->duracion_personalizada ?? $tratamiento->duracion_minutos;

        // Load professional with user
        $profesional->load('user');

        return view('reservas.select-datetime', compact('tratamiento', 'profesional', 'precio', 'duracion'));
    }

    /**
     * Show la pagina de resumen de cita antes la confirmacion
     */
    public function showConfirmation(Request $request)
    {
        // Validate required parameters
        $request->validate([
            'tratamiento_id' => 'required|exists:tratamientos,id',
            'profesional_id' => 'required|exists:profesionales,id',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required',
            'es_para_otro' => 'nullable|boolean',
            'nombre_paciente' => 'required_if:es_para_otro,1|string|max:255',
            'email_paciente' => 'required_if:es_para_otro,1|email|max:255',
            'telefono_paciente' => 'required_if:es_para_otro,1|string|max:20',
        ]);

        $tratamiento = Tratamiento::findOrFail($request->tratamiento_id);
        $profesional = Profesional::with('user')->findOrFail($request->profesional_id);

        // Verify professional can perform this treatment
        $pivotData = $profesional->tratamientos()
            ->where('tratamiento_id', $tratamiento->id)
            ->wherePivot('esta_activo', true)
            ->first();

        if (!$pivotData) {
            return redirect()
                ->route('tratamientos.index')
                ->with('error', 'Combinación inválida de tratamiento y profesional.');
        }

        // Get price and duration
        $precio = $pivotData->pivot->precio_personalizado ?? $tratamiento->precio;
        $duracion = $pivotData->pivot->duracion_personalizada ?? $tratamiento->duracion_minutos;

        return view('reservas.confirmar', [
            'tratamiento' => $tratamiento,
            'profesional' => $profesional,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'precio' => $precio,
            'duracion' => $duracion,
            'es_para_otro' => $request->boolean('es_para_otro'),
            'nombre_paciente' => $request->nombre_paciente,
            'email_paciente' => $request->email_paciente,
            'telefono_paciente' => $request->telefono_paciente,
        ]);
    }

    /**
     * Store la reservacion en la base de datos
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tratamiento_id' => 'required|exists:tratamientos,id',
            'profesional_id' => 'required|exists:profesionales,id',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required',
            'notas' => 'nullable|string|max:1000',
            'es_para_otro' => 'nullable|boolean',
            'nombre_paciente' => 'required_if:es_para_otro,1|string|max:255',
            'email_paciente' => 'required_if:es_para_otro,1|email|max:255',
            'telefono_paciente' => 'required_if:es_para_otro,1|string|max:20',
        ]);

        $tratamiento = Tratamiento::findOrFail($validated['tratamiento_id']);
        $profesional = Profesional::findOrFail($validated['profesional_id']);

        
        $pivotData = $profesional->tratamientos()
            ->where('tratamiento_id', $tratamiento->id)
            ->wherePivot('esta_activo', true)
            ->first();

        if (!$pivotData) {
            return redirect()
                ->route('tratamientos.index')
                ->with('error', 'Combinación inválida de tratamiento y profesional.');
        }

        // Get price and duration
        $precio = $pivotData->pivot->precio_personalizado ?? $tratamiento->precio;
        $duracion = $pivotData->pivot->duracion_personalizada ?? $tratamiento->duracion_minutos;

        // Parse fecha y hora
        $fecha = \Carbon\Carbon::createFromFormat('Y-m-d', $validated['fecha'])->startOfDay();
        $horaInicio = \Carbon\Carbon::createFromFormat('Y-m-d H:i', $validated['fecha'] . ' ' . $validated['hora']);
        $horaFin = $horaInicio->copy()->addMinutes($duracion);

        // generau cod de conformacion unique
        $codigoConfirmacion = 'CITA-' . strtoupper(Str::random(8));

        // Ensure que esta unique
        while (Reserva::where('codigo_confirmacion', $codigoConfirmacion)->exists()) {
            $codigoConfirmacion = 'CITA-' . strtoupper(Str::random(8));
        }

        // Determine patient data: use provided data if booking for someone else, otherwise use logged-in user's data
        $esParaOtro = $validated['es_para_otro'] ?? false;
        $nombrePaciente = $esParaOtro ? $validated['nombre_paciente'] : auth()->user()->name;
        $emailPaciente = $esParaOtro ? $validated['email_paciente'] : auth()->user()->email;
        $telefonoPaciente = $esParaOtro ? ($validated['telefono_paciente'] ?? null) : null;

        // Create reservation
        $reserva = Reserva::create([
            'user_id' => auth()->id(),
            'profesional_id' => $profesional->id,
            'tratamiento_id' => $tratamiento->id,
            'fecha' => $fecha,
            'hora_inicio' => $horaInicio,
            'hora_fin' => $horaFin,
            'duracion_minutos' => $duracion,
            'monto_total' => $precio,
            'estado' => 'confirmado',
            'codigo_confirmacion' => $codigoConfirmacion,
            'notas' => $validated['notas'] ?? null,
            'es_para_otro' => $esParaOtro,
            'nombre_paciente' => $nombrePaciente,
            'email_paciente' => $emailPaciente,
            'telefono_paciente' => $telefonoPaciente,
            'creado_por' => auth()->id(),
        ]);

        return redirect()->route('reservas.exito', $reserva);
    }

    /**
     * Show pagina de exito de reservacion
     */
    public function success(Reserva $reserva)
    {
        // Use policy for authorization
        $this->authorize('view', $reserva);

        // Load relationships
        $reserva->load(['profesional.user', 'tratamiento']);

        return view('reservas.exito', compact('reserva'));
    }

    /**
     * Get professional availability for a specific date (AJAX endpoint)
     */
    public function getAvailability(Request $request, Profesional $profesional)
    {
        $fecha = $request->input('fecha');
        
        if (!$fecha) {
            return response()->json(['error' => 'Fecha requerida'], 400);
        }

        
        $horasOcupadas = $profesional->getHorasOcupadas($fecha);

        return response()->json([
            'horas_ocupadas' => $horasOcupadas
        ]);
    }
}
