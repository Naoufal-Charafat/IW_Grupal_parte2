<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HorarioClinicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('horario_clinica')->insert([
            // Domingo (0) - Cerrado
            [
                'dia' => 0,
                'hora_apertura' => '00:00:00',
                'hora_cierre' => '00:00:00',
                'es_dia_laboral' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Lunes (1) - 9:00 a 18:00
            [
                'dia' => 1,
                'hora_apertura' => '09:00:00',
                'hora_cierre' => '18:00:00',
                'es_dia_laboral' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Martes (2) - 9:00 a 18:00
            [
                'dia' => 2,
                'hora_apertura' => '09:00:00',
                'hora_cierre' => '18:00:00',
                'es_dia_laboral' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Miércoles (3) - 9:00 a 18:00
            [
                'dia' => 3,
                'hora_apertura' => '09:00:00',
                'hora_cierre' => '18:00:00',
                'es_dia_laboral' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Jueves (4) - 9:00 a 18:00
            [
                'dia' => 4,
                'hora_apertura' => '09:00:00',
                'hora_cierre' => '18:00:00',
                'es_dia_laboral' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Viernes (5) - 9:00 a 18:00
            [
                'dia' => 5,
                'hora_apertura' => '09:00:00',
                'hora_cierre' => '18:00:00',
                'es_dia_laboral' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Sábado (6) - 9:00 a 13:30
            [
                'dia' => 6,
                'hora_apertura' => '09:00:00',
                'hora_cierre' => '13:30:00',
                'es_dia_laboral' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
