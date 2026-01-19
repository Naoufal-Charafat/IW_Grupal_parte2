<?php

namespace Database\Seeders;

use App\Models\Reserva;
use App\Models\User;
use App\Models\Profesional;
use App\Models\Habitacion;
use App\Models\Tratamiento;
use App\Models\Hotel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verificar si ya existen reservas
        if (Reserva::count() > 0) {
            echo "Ya existen reservas en la base de datos\n";
            return;
        }

        // Obtener datos necesarios
        $clientes = User::whereHas('roles', function ($query) {
            $query->where('name', 'cliente');
        })->get();

        $profesionales = Profesional::all();
        $habitaciones = Habitacion::all();
        $tratamientos = Tratamiento::all();
        $hotel = Hotel::first();
        $admin = User::whereHas('roles', function ($query) {
            $query->where('name', 'super_admin');
        })->first();

        // Verificar que existan datos necesarios
        if ($clientes->isEmpty() || $profesionales->isEmpty() || $habitaciones->isEmpty() || $tratamientos->isEmpty()) {
            echo "No hay suficientes datos para crear reservas. Asegúrate de ejecutar primero los seeders de Users, Profesionales, Habitaciones y Tratamientos.\n";
            return;
        }

        // Definir los estados de las reservas
        $estados = ['borrador', 'bloqueado', 'confirmado', 'completado', 'cancelado', 'no_asistio'];
        $estadosPago = ['no_pagado', 'pendiente', 'pagado', 'reembolsado', 'fallido'];

        // Crear 10 reservas con diferentes estados
        $reservasData = [
            [
                'estado' => 'confirmado',
                'estado_pago' => 'pagado',
                'fecha' => Carbon::now()->addDays(3),
                'hora' => '09:00',
                'es_para_otro' => false,
                'recordatorio_enviado' => false,
            ],
            [
                'estado' => 'confirmado',
                'estado_pago' => 'pendiente',
                'fecha' => Carbon::now()->addDays(5),
                'hora' => '10:30',
                'es_para_otro' => false,
                'recordatorio_enviado' => false,
            ],
            [
                'estado' => 'bloqueado',
                'estado_pago' => 'no_pagado',
                'fecha' => Carbon::now()->addDays(1),
                'hora' => '11:00',
                'es_para_otro' => true,
                'recordatorio_enviado' => false,
            ],
            [
                'estado' => 'completado',
                'estado_pago' => 'pagado',
                'fecha' => Carbon::now()->subDays(2),
                'hora' => '14:00',
                'es_para_otro' => false,
                'recordatorio_enviado' => true,
            ],
            [
                'estado' => 'cancelado',
                'estado_pago' => 'reembolsado',
                'fecha' => Carbon::now()->addDays(7),
                'hora' => '15:30',
                'es_para_otro' => false,
                'recordatorio_enviado' => false,
            ],
            [
                'estado' => 'no_asistio',
                'estado_pago' => 'pagado',
                'fecha' => Carbon::now()->subDays(1),
                'hora' => '16:00',
                'es_para_otro' => false,
                'recordatorio_enviado' => true,
            ],
            [
                'estado' => 'borrador',
                'estado_pago' => 'no_pagado',
                'fecha' => Carbon::now()->addDays(10),
                'hora' => '12:00',
                'es_para_otro' => true,
                'recordatorio_enviado' => false,
            ],
            [
                'estado' => 'confirmado',
                'estado_pago' => 'pagado',
                'fecha' => Carbon::now()->addDays(4),
                'hora' => '13:00',
                'es_para_otro' => false,
                'recordatorio_enviado' => false,
            ],
            [
                'estado' => 'completado',
                'estado_pago' => 'pagado',
                'fecha' => Carbon::now()->subDays(5),
                'hora' => '17:00',
                'es_para_otro' => true,
                'recordatorio_enviado' => true,
            ],
            [
                'estado' => 'cancelado',
                'estado_pago' => 'fallido',
                'fecha' => Carbon::now()->addDays(2),
                'hora' => '18:00',
                'es_para_otro' => false,
                'recordatorio_enviado' => false,
            ],
        ];

        foreach ($reservasData as $index => $reservaData) {
            // Seleccionar datos aleatorios
            $cliente = $clientes->random();
            $profesional = $profesionales->random();
            $habitacion = $habitaciones->random();
            $tratamiento = $tratamientos->random();

            // Calcular hora fin basada en la duración del tratamiento
            $horaInicio = Carbon::parse($reservaData['fecha']->format('Y-m-d') . ' ' . $reservaData['hora']);
            $horaFin = $horaInicio->copy()->addMinutes($tratamiento->duracion_minutos);

            // Datos del paciente
            $nombrePaciente = $reservaData['es_para_otro']
                ? 'Paciente ' . fake()->firstName() . ' ' . fake()->lastName()
                : $cliente->name;

            $emailPaciente = $reservaData['es_para_otro']
                ? fake()->unique()->safeEmail()
                : $cliente->email;

            $telefonoPaciente = $reservaData['es_para_otro']
                ? '+34 ' . fake()->numerify('6## ### ###')
                : ($cliente->telefono ?? '+34 600 000 000');

            // Crear la reserva
            Reserva::create([
                'codigo_confirmacion' => strtoupper(Str::random(8)),
                'user_id' => $cliente->id,
                'es_para_otro' => $reservaData['es_para_otro'],
                'nombre_paciente' => $nombrePaciente,
                'email_paciente' => $emailPaciente,
                'telefono_paciente' => $telefonoPaciente,
                'profesional_id' => $profesional->id,
                'habitacion_id' => $habitacion->id,
                'tratamiento_id' => $tratamiento->id,
                'duracion_minutos' => $tratamiento->duracion_minutos,
                'hotel_id' => $index % 3 == 0 && $hotel ? $hotel->id : null, // Algunas reservas con hotel
                'fecha' => $reservaData['fecha']->format('Y-m-d'),
                'hora_inicio' => $horaInicio->format('H:i:s'),
                'hora_fin' => $horaFin->format('H:i:s'),
                'estado' => $reservaData['estado'],
                'estado_pago' => $reservaData['estado_pago'],
                'monto_total' => $tratamiento->precio,
                'expira_en' => $reservaData['estado'] == 'bloqueado'
                    ? Carbon::now()->addMinutes(30)
                    : null,
                'notas' => $index % 2 == 0
                    ? 'Reserva de prueba ' . ($index + 1) . '. ' . fake()->sentence()
                    : null,
                'recordatorio_enviado' => $reservaData['recordatorio_enviado'],
                'creado_por' => $admin ? $admin->id : $cliente->id,
                'payment_token' => in_array($reservaData['estado_pago'], ['pagado', 'pendiente'])
                    ? Str::random(32)
                    : null,
            ]);

            echo "Reserva creada: Estado '{$reservaData['estado']}' - Estado Pago '{$reservaData['estado_pago']}'\n";
        }

        echo "\n10 reservas de prueba creadas exitosamente con diferentes estados.\n";
    }
}
