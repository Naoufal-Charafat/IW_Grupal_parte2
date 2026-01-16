<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Profesional;
use App\Models\Reserva;
use App\Models\Tratamiento;
use App\Models\User;
use App\Traits\ApiResponses;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class TratamientoControllerApiRest extends Controller
{
    use ApiResponses;

    // Usamos el trait para respuestas JSON estandarizadas

    /**
     * Listado de tratamientos activos (API)
     * Soporta filtros por fecha
     */
    /**
     * Obtiene el listado de tratamientos activos junto con su disponibilidad horaria.
     * * Esta función calcula los slots disponibles cruzando los horarios de todos
     * los profesionales asignados a cada tratamiento.
     * * NOTA: Se ha limitado el rango de búsqueda a un máximo de 1 mes por
     * motivos de rendimiento, ya que el cálculo de slots es intensivo.
     *
     * @param Request $request Puede incluir 'from' (fecha inicio) y 'till' (fecha fin).
     * @return \Illuminate\Http\JsonResponse Lista de servicios con fechas y horas disponibles.
     */
    public function index(Request $request)
    {
        // 1. Validación de parámetros de entrada
        try {
            $request->validate([
                'uid' => 'nullable|string',
                'from' => 'nullable|date_format:Y-m-d',
                'till' => 'nullable|date_format:Y-m-d|after_or_equal:from',
            ]);
        } catch (ValidationException $e) {
            return $this->validationError($e->errors());
        }

        // 2. Definición inteligente del rango de fechas
        // Por defecto empezamos hoy, salvo que el usuario pida una fecha futura válida.
        $fromDate = Carbon::now();
        if ($request->has('from')) {
            $requestedFrom = Carbon::parse($request->input('from'));
            // Me aseguro de no buscar disponibilidad en el pasado
            if ($requestedFrom->startOfDay()->greaterThanOrEqualTo(Carbon::now()->startOfDay())) {
                $fromDate = $requestedFrom;
            }
        }

        // 3. Lógica de "Tope Máximo" (Hard Limit) de 1 mes
        // Calculo la fecha límite permitida para evitar sobrecarga en el servidor.
        $maxAllowedDate = $fromDate->copy()->addMonth();
        $tillDate = $maxAllowedDate->copy();

        if ($request->has('till')) {
            $requestedTill = Carbon::parse($request->input('till'));

            // Si la fecha solicitada es válida y está dentro del mes permitido, la uso.
            if ($requestedTill->startOfDay()->greaterThanOrEqualTo($fromDate->startOfDay()) &&
                $requestedTill->startOfDay()->lessThanOrEqualTo($maxAllowedDate->startOfDay())) {
                $tillDate = $requestedTill;
            } // Si piden más de un mes, corto forzosamente en el límite máximo.
            elseif ($requestedTill->startOfDay()->greaterThan($maxAllowedDate->startOfDay())) {
                $tillDate = $maxAllowedDate;
            }
        }

        // Creo el iterador de días para el bucle principal
        $period = CarbonPeriod::create($fromDate->startOfDay(), $tillDate->endOfDay());

        // 4. Recuperación de Tratamientos
        // Uso Eager Loading ('with profesionales')
        // para tener ya listos los datos de quién realiza cada servicio.
        $tratamientos = Tratamiento::with('profesionales')
            ->where('esta_activo', true)
            ->orderBy('nombre')
            ->get();

        // 5. Configuración de la Jornada
        $startHour = 9;       // Hora de apertura
        $endHour = 19;        // Hora de cierre
        $intervalMinutes = 30; // Duración de cada slot

        // 6. Construcción de la respuesta (Mapeo de servicios)
        $services = $tratamientos->map(function (Tratamiento $tratamiento) use ($request, $period, $startHour, $endHour, $intervalMinutes) {

            $availabilityList = []; // Aquí acumularemos los objetos {date, slots}

            // Iteramos día por día dentro del rango establecido
            foreach ($period as $dateObj) {
                $dateString = $dateObj->format('Y-m-d');
                $daySlots = [];

                $professionals = $tratamiento->profesionales;

                // Si no hay profesionales asignados, saltamos este día (no hay disponibilidad posible)
                if ($professionals->isEmpty()) {
                    continue;
                }

                // Optimización: Traigo las horas ocupadas de cada profesional UNA vez por día
                // en lugar de consultarlo en cada vuelta del bucle de horas.
                $allOccupiedPeriods = [];
                foreach ($professionals as $pro) {
                    $allOccupiedPeriods[$pro->id] = $pro->getHorasOcupadas($dateString);
                }

                // Generación de slots horarios (ej: 09:00, 09:30, 10:00...)
                $current = Carbon::createFromFormat('Y-m-d H:i', "$dateString $startHour:00");
                $end = Carbon::createFromFormat('Y-m-d H:i', "$dateString $endHour:00");

                while ($current->lessThan($end)) {
                    $slotStartTimestamp = $current->timestamp;
                    $slotTimeString = $current->format('H:i');
                    $isSlotAvailable = false;

                    // Lógica OR: Si AL MENOS UN profesional está libre en este slot,
                    // el tratamiento está disponible para reservar.
                    foreach ($professionals as $pro) {
                        $isProOccupied = false;
                        // Usamos el operador null coalesce (??) por seguridad
                        $proOccupiedTimes = $allOccupiedPeriods[$pro->id] ?? [];

                        // Verificamos si este slot choca con alguna cita existente del profesional
                        foreach ($proOccupiedTimes as $occupied) {
                            $occStart = Carbon::createFromFormat('Y-m-d H:i', "$dateString {$occupied['inicio']}")->timestamp;
                            $occEnd = Carbon::createFromFormat('Y-m-d H:i', "$dateString {$occupied['fin']}")->timestamp;

                            if ($slotStartTimestamp >= $occStart && $slotStartTimestamp < $occEnd) {
                                $isProOccupied = true;
                                break; // Este profesional está ocupado, miramos el siguiente periodo
                            }
                        }

                        // ¡Encontramos un profesional libre
                        if (!$isProOccupied) {
                            $isSlotAvailable = true;
                            break;
                        }
                    }

                    if ($isSlotAvailable) {
                        $daySlots[] = $slotTimeString;
                    }

                    $current->addMinutes($intervalMinutes);
                }

                // Solo añadimos el objeto de fecha si realmente hubo slots libres ese día
                if (!empty($daySlots)) {
                    $availabilityList[] = [
                        'date' => $dateString,
                        'slots' => $daySlots
                    ];
                }
            }

            $uid = $request->input('uid');
            $url = url(
                "/tratamientos/" . $tratamiento->id,
                ($uid && Hotel::where('id', $uid)->exists()) ? ['uid' => $uid] : []
            );

            // Estructura final del objeto Tratamiento para el Frontend
            return [
                'id' => $tratamiento->id,
                'name' => $tratamiento->nombre,
                'description' => $tratamiento->descripcion,
                'price' => (float)$tratamiento->precio,
                'url' => $url,
                'duration' => $tratamiento->duracion_minutos . 'min',
                'availability' => $availabilityList // Array de objetos {date, slots}
            ];
        });

        return $this->success($services, null, 200, 'services');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials.'],
            ]);
        }

        $hotel = Hotel::where('user_id', $user->id)->first();
        if ($hotel) {
            return response()->json([
                'uid' => $hotel->id,
                'token' => $user->createToken('api-token')->plainTextToken
            ]);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Acceso denegado: No eres un hotel.'
        ], 403);
    }
}