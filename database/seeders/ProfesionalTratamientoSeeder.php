<?php

namespace Database\Seeders;

use App\Models\Profesional;
use App\Models\Tratamiento;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfesionalTratamientoSeeder extends Seeder
{
    /**
     * Seed the profesional_tratamiento pivot table.
     * This defines which treatments each professional can perform.
     */
    public function run(): void
    {
        // Verificar si ya existen relaciones
        if (DB::table('profesional_tratamiento')->count() > 0) {
            echo "Ya existen relaciones profesional-tratamiento en la base de datos\n";
            return;
        }

        // Obtener todos los profesionales y tratamientos
        $profesionales = Profesional::with('user')->get();
        $tratamientos = Tratamiento::all();

        if ($profesionales->isEmpty() || $tratamientos->isEmpty()) {
            echo "⚠ No hay profesionales o tratamientos en la base de datos. Ejecuta primero ProfesionalSeeder y TratamientoSeeder.\n";
            return;
        }

        $tratamientosMap = $tratamientos->keyBy('nombre');

        // Definir qué tratamientos puede hacer cada profesional con precios personalizados
        // Basado en su tarifa_hora y especialidad
        $asignaciones = [
            // Dra. María García - Tarifa: 65€/h - 10 años experiencia en deportiva
            'maria.garcia@fisioclinic.com' => [
                'Masaje Terapéutico' => ['precio' => 48.00],  // +3€ por experiencia
                'Rehabilitación Deportiva' => ['precio' => 58.00],  // +3€ especialidad
                'Punción Seca' => ['precio' => 52.00],  // +2€ experiencia
                'Vendaje Neuromuscular (Kinesiotaping)',  // Usa precio base 25€
                'Terapia Manual Ortopédica' => ['precio' => 63.00],  // +3€
            ],
            
            // Dr. Carlos López - Tarifa: 60€/h - Experto en postural
            'carlos.lopez@fisioclinic.com' => [
                'Masaje Terapéutico',
                'Reeducación Postural Global (RPG)' => ['precio' => 58.00],
                'Terapia Manual Ortopédica' => ['precio' => 60.00],
                'Tratamiento ATM (Articulación Temporomandibular)' => ['precio' => 47.00],
                'Electroterapia',
            ],
            
            // Dra. Ana Martínez - Tarifa: 55€/h - Más económica
            'ana.martinez@fisioclinic.com' => [
                'Masaje Terapéutico' => ['precio' => 42.00],
                'Electroterapia' => ['precio' => 32.00],
                'Ultrasonoterapia' => ['precio' => 28.00],
                'Terapia Manual Ortopédica' => ['precio' => 56.00], 
                'Reeducación Postural Global (RPG)' => ['precio' => 52.00],
            ],
            
            // Dr. Javier Rodríguez - Tarifa: 70€/h - Experto traumatológico
            'javier.rodriguez@fisioclinic.com' => [
                'Rehabilitación Deportiva' => ['precio' => 60.00],
                'Punción Seca' => ['precio' => 55.00], 
                'Terapia Manual Ortopédica' => ['precio' => 66.00], 
                'Electroterapia' => ['precio' => 38.00],
                'Vendaje Neuromuscular (Kinesiotaping)' => ['precio' => 28.00],
                'Ultrasonoterapia' => ['precio' => 33.00],
            ],
            
            // Dra. Laura Sánchez - Tarifa: 75€/h - Especialista suelo pélvico (la más cara)
            'laura.sanchez@fisioclinic.com' => [
                'Fisioterapia para el Suelo Pélvico' => ['precio' => 70.00],  // +5€ especialista máster
                'Masaje Terapéutico' => ['precio' => 50.00],  // +5€
                'Electroterapia' => ['precio' => 38.00],  // +3€
                'Ultrasonoterapia' => ['precio' => 33.00],  // +3€
            ],
            
            // Dr. Miguel Torres - Tarifa: 62€/h - Experto respiratoria
            'miguel.torres@fisioclinic.com' => [
                'Fisioterapia Respiratoria' => ['precio' => 43.00],
                'Drenaje Linfático Manual' => ['precio' => 53.00],
                'Masaje Terapéutico' => ['precio' => 46.00],
                'Electroterapia',  // Precio base 35€
                'Ultrasonoterapia',  // Precio base 30€
            ],
            
            // Dra. Elena Fernández - Tarifa: 68€/h - Pediátrica especializada
            'elena.fernandez@fisioclinic.com' => [
                'Fisioterapia Respiratoria' => ['precio' => 44.00],
                'Masaje Terapéutico' => ['precio' => 48.00],
                'Reeducación Postural Global (RPG)' => ['precio' => 58.00],
                'Terapia Manual Ortopédica' => ['precio' => 63.00],
            ],
        ];

        $relacionesCreadas = 0;

        foreach ($asignaciones as $email => $tratamientosAsignados) {
            // Buscar el profesional por email
            $profesional = $profesionales->firstWhere('user.email', $email);
            
            if (!$profesional) {
                echo "No se encontró profesional con email: $email\n";
                continue;
            }

            foreach ($tratamientosAsignados as $nombreTratamiento => $config) {
                // Si es un array numérico simple, convertir a string
                if (is_numeric($nombreTratamiento)) {
                    $nombreTratamiento = $config;
                    $config = [];
                }
                
                $tratamiento = $tratamientosMap->get($nombreTratamiento);
                
                if (!$tratamiento) {
                    echo "No se encontró tratamiento: $nombreTratamiento\n";
                    continue;
                }

                // Crear la relación en la tabla pivot
                // Si tiene precio personalizado lo usa, si no usa el precio base del tratamiento
                DB::table('profesional_tratamiento')->insert([
                    'profesional_id' => $profesional->id,
                    'tratamiento_id' => $tratamiento->id,
                    'precio_personalizado' => $config['precio'] ?? null,
                    'duracion_personalizada' => $config['duracion'] ?? null,
                    'esta_activo' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $relacionesCreadas++;
            }
        }

        echo "✓ Se crearon $relacionesCreadas relaciones profesional-tratamiento correctamente\n";
        echo "✓ Total relaciones en BD: " . DB::table('profesional_tratamiento')->count() . "\n";
    }
}
