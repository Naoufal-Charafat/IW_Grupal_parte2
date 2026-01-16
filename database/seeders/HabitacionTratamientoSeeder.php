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
        
        // Masaje Terapéutico
        $masajeTerapeutico = Tratamiento::where('nombre', 'Masaje Terapéutico')->first();
        if ($masajeTerapeutico) {
            $masajeTerapeutico->habitaciones()->attach([
                $salaMasajes1->id => ['es_preferida' => true],
                $salaMasajes2->id => ['es_preferida' => true],
                $salaMultiuso1->id => ['es_preferida' => false],
            ]);
        }

        // Rehabilitación Deportiva
        $rehabilitacionDeportiva = Tratamiento::where('nombre', 'Rehabilitación Deportiva')->first();
        if ($rehabilitacionDeportiva) {
            $rehabilitacionDeportiva->habitaciones()->attach([
                $salaFisio1->id => ['es_preferida' => true],
                $salaFisio2->id => ['es_preferida' => true],
                $salaMultiuso2->id => ['es_preferida' => false],
            ]);
        }

        // Electroterapia
        $electroterapia = Tratamiento::where('nombre', 'Electroterapia')->first();
        if ($electroterapia) {
            $electroterapia->habitaciones()->attach([
                $salaFisio1->id => ['es_preferida' => true],
                $salaFisio2->id => ['es_preferida' => true],
                $salaMultiuso2->id => ['es_preferida' => false],
            ]);
        }

        // Punción Seca
        $puncionSeca = Tratamiento::where('nombre', 'Punción Seca')->first();
        if ($puncionSeca) {
            $puncionSeca->habitaciones()->attach([
                $salaFisio1->id => ['es_preferida' => true],
                $salaFisio2->id => ['es_preferida' => false],
                $salaAcupuntura->id => ['es_preferida' => false],
            ]);
        }

        // Fisioterapia Respiratoria
        $fisioRespiratoria = Tratamiento::where('nombre', 'Fisioterapia Respiratoria')->first();
        if ($fisioRespiratoria) {
            $fisioRespiratoria->habitaciones()->attach([
                $salaFisio1->id => ['es_preferida' => true],
                $salaFisio2->id => ['es_preferida' => false],
                $salaMultiuso2->id => ['es_preferida' => false],
            ]);
        }

        // Terapia Manual Ortopédica
        $terapiaManual = Tratamiento::where('nombre', 'Terapia Manual Ortopédica')->first();
        if ($terapiaManual) {
            $terapiaManual->habitaciones()->attach([
                $salaFisio1->id => ['es_preferida' => true],
                $salaFisio2->id => ['es_preferida' => false],
                $salaOsteopatia->id => ['es_preferida' => true],
                $salaMultiuso1->id => ['es_preferida' => false],
            ]);
        }

        // Drenaje Linfático Manual
        $drenajeLinfatico = Tratamiento::where('nombre', 'Drenaje Linfático Manual')->first();
        if ($drenajeLinfatico) {
            $drenajeLinfatico->habitaciones()->attach([
                $salaMasajes1->id => ['es_preferida' => true],
                $salaMasajes2->id => ['es_preferida' => true],
                $salaMultiuso1->id => ['es_preferida' => false],
            ]);
        }

        // Reeducación Postural Global (RPG)
        $rpg = Tratamiento::where('nombre', 'Reeducación Postural Global (RPG)')->first();
        if ($rpg) {
            $rpg->habitaciones()->attach([
                $salaFisio1->id => ['es_preferida' => true],
                $salaFisio2->id => ['es_preferida' => false],
                $salaMultiuso2->id => ['es_preferida' => true],
            ]);
        }

        // Vendaje Neuromuscular (Kinesiotaping)
        $vendaje = Tratamiento::where('nombre', 'Vendaje Neuromuscular (Kinesiotaping)')->first();
        if ($vendaje) {
            $vendaje->habitaciones()->attach([
                $salaFisio1->id => ['es_preferida' => true],
                $salaFisio2->id => ['es_preferida' => true],
                $salaMultiuso1->id => ['es_preferida' => false],
                $salaMultiuso2->id => ['es_preferida' => false],
            ]);
        }

        // Fisioterapia para el Suelo Pélvico
        $sueloPelvico = Tratamiento::where('nombre', 'Fisioterapia para el Suelo Pélvico')->first();
        if ($sueloPelvico) {
            $sueloPelvico->habitaciones()->attach([
                $salaFisio1->id => ['es_preferida' => true],
                $salaFisio2->id => ['es_preferida' => false],
                $salaMultiuso2->id => ['es_preferida' => false],
            ]);
        }

        // Ultrasonoterapia
        $ultrasonido = Tratamiento::where('nombre', 'Ultrasonoterapia')->first();
        if ($ultrasonido) {
            $ultrasonido->habitaciones()->attach([
                $salaFisio1->id => ['es_preferida' => true],
                $salaFisio2->id => ['es_preferida' => true],
                $salaMultiuso2->id => ['es_preferida' => false],
            ]);
        }

        // Tratamiento ATM
        $atm = Tratamiento::where('nombre', 'Tratamiento ATM (Articulación Temporomandibular)')->first();
        if ($atm) {
            $atm->habitaciones()->attach([
                $salaFisio1->id => ['es_preferida' => true],
                $salaFisio2->id => ['es_preferida' => false],
                $salaOsteopatia->id => ['es_preferida' => false],
                $salaMultiuso1->id => ['es_preferida' => false],
            ]);
        }
    }
}
