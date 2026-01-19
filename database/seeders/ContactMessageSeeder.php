<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Seeder;

class ContactMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 12 mensajes de contacto sin leer
        ContactMessage::factory(12)->create([
            'leido' => false,
        ]);

        // Crear 5 mensajes de contacto leídos
        ContactMessage::factory(5)->create([
            'leido' => true,
        ]);
    }
}
