<?php

namespace Database\Seeders;

use App\Models\Tratamiento;
use Illuminate\Database\Seeder;

class TratamientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tratamientos = [
            [
                'nombre' => 'Masaje Terapéutico',
                'descripcion' => 'Masaje especializado para aliviar tensiones musculares, mejorar la circulación y reducir el estrés. Ideal para dolores crónicos y contracturas.',
                'precio' => 45.00,
                'duracion_minutos' => 60,
                'esta_activo' => true,
            ],
            [
                'nombre' => 'Rehabilitación Deportiva',
                'descripcion' => 'Programa de recuperación especializado para lesiones deportivas. Incluye ejercicios terapéuticos, movilizaciones y fortalecimiento muscular.',
                'precio' => 55.00,
                'duracion_minutos' => 50,
                'esta_activo' => true,
            ],
            [
                'nombre' => 'Electroterapia',
                'descripcion' => 'Tratamiento mediante corrientes eléctricas para reducir dolor, inflamación y estimular la regeneración de tejidos.',
                'precio' => 35.00,
                'duracion_minutos' => 30,
                'esta_activo' => true,
            ],
            [
                'nombre' => 'Punción Seca',
                'descripcion' => 'Técnica avanzada para el tratamiento de puntos gatillo miofasciales mediante agujas de acupuntura. Muy efectiva para dolores musculares persistentes.',
                'precio' => 50.00,
                'duracion_minutos' => 40,
                'esta_activo' => true,
            ],
            [
                'nombre' => 'Fisioterapia Respiratoria',
                'descripcion' => 'Tratamiento especializado para mejorar la función respiratoria mediante técnicas de drenaje, ventilación y ejercicios específicos.',
                'precio' => 40.00,
                'duracion_minutos' => 45,
                'esta_activo' => true,
            ],
            [
                'nombre' => 'Terapia Manual Ortopédica',
                'descripcion' => 'Técnicas manuales especializadas para el tratamiento de disfunciones del sistema musculoesquelético, incluyendo movilizaciones articulares y manipulaciones.',
                'precio' => 60.00,
                'duracion_minutos' => 60,
                'esta_activo' => true,
            ],
            [
                'nombre' => 'Drenaje Linfático Manual',
                'descripcion' => 'Masaje suave y específico para estimular el sistema linfático, reducir edemas y mejorar la eliminación de toxinas del organismo.',
                'precio' => 50.00,
                'duracion_minutos' => 50,
                'esta_activo' => true,
            ],
            [
                'nombre' => 'Reeducación Postural Global (RPG)',
                'descripcion' => 'Método de fisioterapia que trabaja las cadenas musculares para corregir malas posturas y prevenir lesiones. Incluye estiramientos y ejercicios específicos.',
                'precio' => 55.00,
                'duracion_minutos' => 60,
                'esta_activo' => true,
            ],
            [
                'nombre' => 'Vendaje Neuromuscular (Kinesiotaping)',
                'descripcion' => 'Aplicación de vendajes elásticos terapéuticos para mejorar la función muscular, reducir dolor y facilitar la recuperación de lesiones.',
                'precio' => 25.00,
                'duracion_minutos' => 20,
                'esta_activo' => true,
            ],
            [
                'nombre' => 'Fisioterapia para el Suelo Pélvico',
                'descripcion' => 'Tratamiento especializado para disfunciones del suelo pélvico mediante ejercicios, biofeedback y técnicas manuales.',
                'precio' => 65.00,
                'duracion_minutos' => 50,
                'esta_activo' => true,
            ],
            [
                'nombre' => 'Ultrasonoterapia',
                'descripcion' => 'Aplicación de ondas ultrasónicas con fines terapéuticos para reducir inflamación, acelerar la cicatrización y aliviar el dolor profundo.',
                'precio' => 30.00,
                'duracion_minutos' => 25,
                'esta_activo' => true,
            ],
            [
                'nombre' => 'Tratamiento ATM (Articulación Temporomandibular)',
                'descripcion' => 'Fisioterapia especializada para trastornos de la mandíbula, incluyendo bruxismo, dolor facial y limitación de apertura bucal.',
                'precio' => 45.00,
                'duracion_minutos' => 40,
                'esta_activo' => true,
            ],
        ];

        foreach ($tratamientos as $tratamiento) {
            Tratamiento::create($tratamiento);
        }
    }
}
