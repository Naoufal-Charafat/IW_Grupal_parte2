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
        // Ejecutar el seeder de roles primero
        $this->call(RoleSeeder::class);

        // Crear usuarios con cada uno de los roles
        $roles = Role::all();

        foreach ($roles as $role) {
            User::factory()->create([
                'name' => $role->name,
                'email' => $role->name . '@' . $role->name . '.com',
                'password' => bcrypt($role->name),
            ])->assignRole($role->name);
        }
    }
}
