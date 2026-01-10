<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Importante: El orden es crucial
        // 1. Primero los roles base
        $this->call([
            RoleSeeder::class,
        ]);

        // 2. Después los usuarios (el admin debe ser el primero con ID=1)
        $this->call([
            UserSeeder::class,
        ]);

        // 3. Luego los tratamientos disponibles en la clínica
        $this->call([
            TratamientoSeeder::class,
        ]);

        // 4. Crear profesionales (usuarios con rol profesional)
        $this->call([
            ProfesionalSeeder::class,
        ]);

        // 5. Finalmente, asignar tratamientos a profesionales (pivot table)
        $this->call([
            ProfesionalTratamientoSeeder::class,
        ]);
    }
}
