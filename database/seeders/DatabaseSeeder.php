<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Reserva;
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

        // 4. Crear habitaciones/salas de la clínica
        $this->call([
            HabitacionSeeder::class,
        ]);

        // 5. Crear profesionales (usuarios con rol profesional)
        $this->call([
            ProfesionalSeeder::class,
        ]);

        // 6. Asignar tratamientos a profesionales (pivot table)
        $this->call([
            ProfesionalTratamientoSeeder::class,
        ]);

        // 7. Asignar tratamientos a habitaciones (pivot table)
        $this->call([
            HabitacionTratamientoSeeder::class,
        ]);

        // 8. Crear hoteles (referidos)
        $this->call([
            HotelSeeder::class,
        ]);

        // 8. Crear reservas de ejemplo para el cliente demo
        $cliente = User::where('email', 'cliente@cliente.com')->first();
        if ($cliente) {
            // 3 reservas completadas
            Reserva::factory()->count(3)->create([
                'user_id' => $cliente->id,
                'estado' => 'completado',
                'estado_pago' => 'pagado',
            ]);
            // 2 reservas confirmadas
            Reserva::factory()->count(2)->create([
                'user_id' => $cliente->id,
                'estado' => 'confirmado',
                'estado_pago' => 'pagado',
            ]);
        }
    }
}
