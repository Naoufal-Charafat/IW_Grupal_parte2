<?php

namespace Database\Factories;

use App\Models\Reserva;
use App\Models\User;
use App\Models\Profesional;
use App\Models\Habitacion;
use App\Models\Tratamiento;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ReservaFactory extends Factory
{
    protected $model = Reserva::class;

    public function definition(): array
    {
        $fecha = $this->faker->dateTimeBetween('-2 months', 'now');
        $horaInicio = $this->faker->time('H:i');
        $duracion = $this->faker->randomElement([30, 45, 60]);
        $horaFin = date('H:i', strtotime("$horaInicio +$duracion minutes"));

        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? 1,
            'profesional_id' => Profesional::inRandomOrder()->first()?->id ?? 1,
            'habitacion_id' => Habitacion::inRandomOrder()->first()?->id ?? 1,
            'tratamiento_id' => Tratamiento::inRandomOrder()->first()?->id ?? 1,
            'codigo_confirmacion' => strtoupper(Str::random(10)),
            'es_para_otro' => false,
            'nombre_paciente' => null,
            'email_paciente' => null,
            'telefono_paciente' => null,
            'fecha' => $fecha->format('Y-m-d'),
            'hora_inicio' => $horaInicio,
            'hora_fin' => $horaFin,
            'duracion_minutos' => $duracion,
            'estado' => 'confirmado',
            'estado_pago' => 'pagado',
            'monto_total' => $this->faker->randomFloat(2, 30, 100),
            'expira_en' => null,
            'notas' => $this->faker->optional()->sentence(),
            'recordatorio_enviado' => false,
            'creado_por' => function (array $attributes) {
                return $attributes['user_id'] ?? 1;
            },
        ];
    }
}
