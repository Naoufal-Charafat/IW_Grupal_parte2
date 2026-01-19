<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BloqueHorario;
use Carbon\Carbon;

class BloqueHorarioSeeder extends Seeder
{
    public function run(): void
    {
        // Profesional 1: bloque de 4 horas (por ejemplo, de 09:00 a 13:00)
        BloqueHorario::create([
            'profesional_id' => 1,
            'fecha' => Carbon::today()->toDateString(),
            'hora_inicio' => '09:00',
            'hora_fin' => '13:00',
            'motivo' => 'Bloque de 4 horas por motivo especial',
        ]);

            // Profesional 2: bloque todo el día (por enfermedad) para mañana
            BloqueHorario::create([
                'profesional_id' => 2,
                'fecha' => Carbon::tomorrow()->toDateString(),
                'hora_inicio' => '09:00',
                'hora_fin' => '20:00',
                'motivo' => 'Bloqueo de todo el día por enfermedad',
            ]);
    }
}
