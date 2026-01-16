<?php

namespace Database\Seeders;

use App\Models\Habitacion;
use App\Models\Tratamiento;
use Illuminate\Database\Seeder;

class HabitacionTratamientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get habitaciones
        $salaMasajes1 = Habitacion::where('nombre', 'Sala de Masajes 1')->first();
        $salaMasajes2 = Habitacion::where('nombre', 'Sala de Masajes 2')->first();
        $salaFisio1 = Habitacion::where('nombre', 'Sala de Fisioterapia 1')->first();
        $salaFisio2 = Habitacion::where('nombre', 'Sala de Fisioterapia 2')->first();
        $salaOsteopatia = Habitacion::where('nombre', 'Sala de Osteopatía')->first();
        $salaAcupuntura = Habitacion::where('nombre', 'Sala de Acupuntura')->first();
        $salaMultiuso1 = Habitacion::where('nombre', 'Sala Multiuso 1')->first();
        $salaMultiuso2 = Habitacion::where('nombre', 'Sala Multiuso 2')->first();

        // Assign treatments to rooms based on equipment needs
        // Masaje Relajante
        $masajeRelajante = Tratamiento::where('nombre', 'Masaje Relajante')->first();
        if ($masajeRelajante) {
            $masajeRelajante->habitaciones()->attach([
                $salaMasajes1->id => ['es_preferida' => true],
                $salaMasajes2->id => ['es_preferida' => false],
                $salaMultiuso1->id => ['es_preferida' => false],
            ]);
        }

        // Masaje Deportivo
        $masajeDeportivo = Tratamiento::where('nombre', 'Masaje Deportivo')->first();
        if ($masajeDeportivo) {
            $masajeDeportivo->habitaciones()->attach([
                $salaMasajes1->id => ['es_preferida' => false],
                $salaMasajes2->id => ['es_preferida' => true],
                $salaFisio1->id => ['es_preferida' => false],
                $salaMultiuso1->id => ['es_preferida' => false],
            ]);
        }

        // Fisioterapia
        $fisioterapia = Tratamiento::where('nombre', 'Fisioterapia')->first();
        if ($fisioterapia) {
            $fisioterapia->habitaciones()->attach([
                $salaFisio1->id => ['es_preferida' => true],
                $salaFisio2->id => ['es_preferida' => true],
                $salaMultiuso2->id => ['es_preferida' => false],
            ]);
        }

        // Rehabilitación
        $rehabilitacion = Tratamiento::where('nombre', 'Rehabilitación')->first();
        if ($rehabilitacion) {
            $rehabilitacion->habitaciones()->attach([
                $salaFisio1->id => ['es_preferida' => true],
                $salaFisio2->id => ['es_preferida' => false],
            ]);
        }

        // Osteopatía
        $osteopatia = Tratamiento::where('nombre', 'Osteopatía')->first();
        if ($osteopatia) {
            $osteopatia->habitaciones()->attach([
                $salaOsteopatia->id => ['es_preferida' => true],
                $salaMultiuso1->id => ['es_preferida' => false],
            ]);
        }

        // Acupuntura
        $acupuntura = Tratamiento::where('nombre', 'Acupuntura')->first();
        if ($acupuntura) {
            $acupuntura->habitaciones()->attach([
                $salaAcupuntura->id => ['es_preferida' => true],
            ]);
        }

        // Terapia Manual
        $terapiaManual = Tratamiento::where('nombre', 'Terapia Manual')->first();
        if ($terapiaManual) {
            $terapiaManual->habitaciones()->attach([
                $salaFisio1->id => ['es_preferida' => true],
                $salaFisio2->id => ['es_preferida' => false],
                $salaOsteopatia->id => ['es_preferida' => false],
                $salaMultiuso1->id => ['es_preferida' => false],
            ]);
        }

        // Punción Seca
        $puncionSeca = Tratamiento::where('nombre', 'Punción Seca')->first();
        if ($puncionSeca) {
            $puncionSeca->habitaciones()->attach([
                $salaFisio1->id => ['es_preferida' => true],
                $salaFisio2->id => ['es_preferida' => false],
            ]);
        }
    }
}
