<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profesional;
use Illuminate\Database\Seeder;

class ProfesionalSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener usuarios que serán profesionales
        $usuarios = User::whereIn('email', [
            'profesional1@clinica.com',
            'profesional2@clinica.com',
            'profesional3@clinica.com'
        ])->get();

        // Si no existen, crearlos
        if ($usuarios->isEmpty()) {
            $usuarios = User::factory(3)->create([
                'rol' => 'profesional'
            ]);
        }

        $profesionales = [
            [
                'user_id' => $usuarios[0]->id,
                'numero_licencia' => 'FT-12345',
                'biografia' => 'Especialista en fisioterapia deportiva con 10 años de experiencia. Miembro de la Asociación Española de Fisioterapia.',
                'tarifa_hora' => 60.00,
            ],
            [
                'user_id' => $usuarios[1]->id,
                'numero_licencia' => 'FT-67890',
                'biografia' => 'Experta en rehabilitación postural y terapia manual. Formada en las últimas técnicas de recuperación funcional.',
                'tarifa_hora' => 55.00,
            ],
            [
                'user_id' => $usuarios[2]->id,
                'numero_licencia' => 'FT-54321',
                'biografia' => 'Especialista en fisioterapia neurológica y geriátrica. Amplia experiencia en tratamiento de pacientes crónicos.',
                'tarifa_hora' => 50.00,
            ],
        ];

        foreach ($profesionales as $profesional) {
            Profesional::create($profesional);
        }
    }
}