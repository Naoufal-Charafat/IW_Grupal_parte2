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
            echo "Ya existen profesionales en la base de datos\n";
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
            [
                'usuario' => [
                    'name' => 'Dr. Javier Rodríguez',
                    'email' => 'javier.rodriguez@fisioclinic.com',
                    'password' => Hash::make('password123'),
                    'email_verified_at' => now(),
                    'telefono' => '+34 600 777 888',
                    'line_1' => 'Calle Terapia 12',
                    'postal_code' => '28004',
                    'esta_activo' => 1,
                    'tipo' => 'particular',
                ],
                'profesional' => [
                    'numero_licencia' => 'FT-98765',
                    'biografia' => 'Especialista en fisioterapia traumatológica. Experto en recuperación post-quirúrgica y lesiones deportivas. Certificado en técnicas de punción seca.',
                    'tarifa_hora' => 70.00,
                ]
            ],
            [
                'usuario' => [
                    'name' => 'Dra. Laura Sánchez',
                    'email' => 'laura.sanchez@fisioclinic.com',
                    'password' => Hash::make('password123'),
                    'email_verified_at' => now(),
                    'telefono' => '+34 600 999 000',
                    'line_1' => 'Avenida Movimiento 34',
                    'postal_code' => '28005',
                    'esta_activo' => 1,
                    'tipo' => 'empresa',
                ],
                'profesional' => [
                    'numero_licencia' => 'FT-13579',
                    'biografia' => 'Fisioterapeuta especializada en suelo pélvico y salud femenina. Máster en Uroginecología y Obstetricia. Enfoque integral para la mujer en todas las etapas.',
                    'tarifa_hora' => 75.00,
                ]
            ],
            [
                'usuario' => [
                    'name' => 'Dr. Miguel Torres',
                    'email' => 'miguel.torres@fisioclinic.com',
                    'password' => Hash::make('password123'),
                    'email_verified_at' => now(),
                    'telefono' => '+34 600 222 333',
                    'line_1' => 'Plaza Equilibrio 8',
                    'postal_code' => '28006',
                    'esta_activo' => 1,
                    'tipo' => 'particular',
                ],
                'profesional' => [
                    'numero_licencia' => 'FT-24680',
                    'biografia' => 'Experto en fisioterapia respiratoria y cardíaca. Especializado en pacientes con patologías pulmonares crónicas. Terapeuta certificado en drenaje linfático manual.',
                    'tarifa_hora' => 62.00,
                ]
            ],
            [
                'usuario' => [
                    'name' => 'Dra. Elena Fernández',
                    'email' => 'elena.fernandez@fisioclinic.com',
                    'password' => Hash::make('password123'),
                    'email_verified_at' => now(),
                    'telefono' => '+34 600 444 555',
                    'line_1' => 'Calle Rehabilitación 56',
                    'line_2' => '2º D',
                    'postal_code' => '28007',
                    'esta_activo' => 1,
                    'tipo' => 'particular',
                ],
                'profesional' => [
                    'numero_licencia' => 'FT-11223',
                    'biografia' => 'Fisioterapeuta pediátrica y del desarrollo. Especialista en atención temprana y trastornos del neurodesarrollo. Formada en terapia Vojta y Bobath.',
                    'tarifa_hora' => 68.00,
                ]
            ],
        ];

        $creados = 0;
        
        foreach ($profesionales as $data) {
            // Verificar si el usuario ya existe
            $user = User::where('email', $data['usuario']['email'])->first();
            
            if (!$user) {
                $user = User::create($data['usuario']);
                if (class_exists('\Spatie\Permission\Models\Role')) {
                    $user->assignRole('profesional');
                }
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