<?php

namespace Database\Seeders;

use App\Models\Habitacion;
use Illuminate\Database\Seeder;

class HabitacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $habitaciones = [
            [
                'nombre' => 'Sala de Masajes 1',
                'capacidad' => 1,
                'equipamiento' => 'Camilla de masajes, aceites esenciales, toallas calientes, música relajante',
                'esta_activo' => true,
            ],
            [
                'nombre' => 'Sala de Masajes 2',
                'capacidad' => 1,
                'equipamiento' => 'Camilla de masajes, aceites esenciales, aromaterapia, iluminación regulable',
                'esta_activo' => true,
            ],
            [
                'nombre' => 'Sala de Fisioterapia 1',
                'capacidad' => 1,
                'equipamiento' => 'Camilla terapéutica, electroestimulador, ultrasonido, bandas elásticas, pesas',
                'esta_activo' => true,
            ],
            [
                'nombre' => 'Sala de Fisioterapia 2',
                'capacidad' => 1,
                'equipamiento' => 'Camilla terapéutica, láser terapéutico, tens, crioterapia',
                'esta_activo' => true,
            ],
            [
                'nombre' => 'Sala de Osteopatía',
                'capacidad' => 1,
                'equipamiento' => 'Camilla osteopática ajustable, material de diagnóstico',
                'esta_activo' => true,
            ],
            [
                'nombre' => 'Sala de Acupuntura',
                'capacidad' => 1,
                'equipamiento' => 'Camilla de acupuntura, agujas estériles, lámpara de calor, moxa',
                'esta_activo' => true,
            ],
            [
                'nombre' => 'Sala Multiuso 1',
                'capacidad' => 1,
                'equipamiento' => 'Camilla universal, equipamiento básico de fisioterapia y masajes',
                'esta_activo' => true,
            ],
            [
                'nombre' => 'Sala Multiuso 2',
                'capacidad' => 1,
                'equipamiento' => 'Camilla universal, espejo grande, material de ejercicios',
                'esta_activo' => true,
            ],
        ];

        foreach ($habitaciones as $habitacion) {
            Habitacion::create($habitacion);
        }
    }
}
