<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profesional;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProfesionalSeeder extends Seeder
{
    public function run(): void
    {
        // Verificar si ya existen profesionales
        if (Profesional::count() > 0) {
            echo "ℹ  Ya existen profesionales en la base de datos\n";
            return;
        }

        $profesionales = [
            [
                'usuario' => [
                    'name' => 'Dra. María García',
                    'email' => 'maria.garcia@fisioclinic.com',
                    'password' => Hash::make('password123'),
                    'email_verified_at' => now(),
                    'telefono' => '+34 600 111 222',
                    'line_1' => 'Calle Salud 123',
                    'postal_code' => '28001',
                    'esta_activo' => 1,
                    'tipo' => 'particular',
                ],
                'profesional' => [
                    'numero_licencia' => 'FT-12345',
                    'biografia' => 'Especialista en fisioterapia deportiva con 10 años de experiencia. Miembro de la Asociación Española de Fisioterapia. Apasionada por la recuperación funcional de atletas.',
                    'tarifa_hora' => 65.00,
                ]
            ],
            [
                'usuario' => [
                    'name' => 'Dr. Carlos López',
                    'email' => 'carlos.lopez@fisioclinic.com',
                    'password' => Hash::make('password123'),
                    'email_verified_at' => now(),
                    'telefono' => '+34 600 333 444',
                    'line_1' => 'Avenida Bienestar 45',
                    'postal_code' => '28002',
                    'esta_activo' => 1,
                    'tipo' => 'particular',
                ],
                'profesional' => [
                    'numero_licencia' => 'FT-67890',
                    'biografia' => 'Experto en rehabilitación postural y terapia manual. Formado en las últimas técnicas de recuperación funcional. Especialista en dolor de espalda y cervicales.',
                    'tarifa_hora' => 60.00,
                ]
            ],
            [
                'usuario' => [
                    'name' => 'Dra. Ana Martínez',
                    'email' => 'ana.martinez@fisioclinic.com',
                    'password' => Hash::make('password123'),
                    'email_verified_at' => now(),
                    'telefono' => '+34 600 555 666',
                    'line_1' => 'Plaza Recuperación 7',
                    'postal_code' => '28003',
                    'esta_activo' => 1,
                    'tipo' => 'particular',
                ],
                'profesional' => [
                    'numero_licencia' => 'FT-54321',
                    'biografia' => 'Especialista en fisioterapia neurológica y geriátrica. Amplia experiencia en tratamiento de pacientes crónicos. Enfoque humanizado y personalizado.',
                    'tarifa_hora' => 55.00,
                ]
            ],
        ];

        $creados = 0;
        
        foreach ($profesionales as $data) {
            // Verificar si el usuario ya existe
            $user = User::where('email', $data['usuario']['email'])->first();
            
            if (!$user) {
                // Crear usuario si no existe
                $user = User::create($data['usuario']);
            }
            
            // Verificar si ya tiene profesional asociado
            $profesionalExistente = Profesional::where('user_id', $user->id)->first();
            
            if (!$profesionalExistente) {
                // Crear profesional asociado
                Profesional::create([
                    'user_id' => $user->id,
                    'numero_licencia' => $data['profesional']['numero_licencia'],
                    'biografia' => $data['profesional']['biografia'],
                    'tarifa_hora' => $data['profesional']['tarifa_hora'],
                ]);
                $creados++;
            }
        }

        echo " Se crearon $creados profesionales correctamente\n";
        echo " Total profesionales en BD: " . Profesional::count() . "\n";
    }
}