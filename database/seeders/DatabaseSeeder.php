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

        // 8. Crear reservas de ejemplo para los clientes demo
        $clientes = User::whereIn('email', [
            'cliente@cliente.com',
            'cliente2@cliente.com',
            'cliente3@cliente.com',
        ])->get();

        $totalReservas = 15;
        $reservasPorCliente = [5, 5, 5]; // 5 para cada cliente
        foreach ($clientes as $idx => $cliente) {
            $completadas = 3; // 3 completadas por cliente
            $confirmadas = $reservasPorCliente[$idx] - $completadas;

            // Completadas (ya realizadas)
            Reserva::factory()->count($completadas)->create([
                'user_id' => $cliente->id,
                'estado' => 'completado',
                'estado_pago' => 'pagado',
                'fecha' => now()->subDays(rand(1, 30))->format('Y-m-d'),
            ]);

            // Confirmadas (en los próximos 14 días)
            for ($j = 0; $j < $confirmadas; $j++) {
                Reserva::factory()->create([
                    'user_id' => $cliente->id,
                    'estado' => 'confirmado',
                    'estado_pago' => 'pagado',
                    'fecha' => now()->addDays(rand(1, 14))->format('Y-m-d'),
                ]);
            }
        }

        // 9. Crear horario de la clínica (horarios de apertura y cierre por día)
        $this->call([
            HorarioClinicaSeeder::class,
        ]);

        // 10. Crear bloques de horario para dos profesionales
        $this->call([
            BloqueHorarioSeeder::class,
        ]);

        // 11. Crear mensajes de contacto simulados
        $this->call([
            ContactMessageSeeder::class,
        ]);
    }
}
