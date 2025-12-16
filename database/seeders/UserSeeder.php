<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array de roles con sus datos
        // El admin debe ser el primero para que tenga ID=1
        $usersData = [
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => 'admin',
                'role' => 'super_admin',
            ],
            [
                'name' => 'cliente',
                'email' => 'cliente@cliente.com',
                'password' => 'cliente',
                'role' => 'cliente',
            ],
            [
                'name' => 'profesional',
                'email' => 'profesional@profesional.com',
                'password' => 'profesional',
                'role' => 'profesional',
            ],
            [
                'name' => 'recepcionista',
                'email' => 'recepcionista@recepcionista.com',
                'password' => 'recepcionista',
                'role' => 'recepcionista',
            ],
            [
                'name' => 'publico',
                'email' => 'publico@publico.com',
                'password' => 'publico',
                'role' => 'publico',
            ],
        ];

        foreach ($usersData as $userData) {
            // Crear el usuario
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make($userData['password']),
                    'email_verified_at' => now(),
                ]
            );

            // Asignar el rol si existe
            $role = Role::where('name', $userData['role'])->first();
            if ($role) {
                $user->assignRole($role);
                $this->command->info("Usuario '{$userData['name']}' creado con rol '{$userData['role']}'");
            } else {
                $this->command->warn("Rol '{$userData['role']}' no encontrado para el usuario '{$userData['name']}'");
            }
        }

        $this->command->info('Usuarios de prueba creados exitosamente.');
    }
}
