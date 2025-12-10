<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear los roles base sin permisos asignados
        Role::firstOrCreate(['name' => 'cliente']);
        Role::firstOrCreate(['name' => 'profesional']);
        Role::firstOrCreate(['name' => 'recepcionista']);
        Role::firstOrCreate(['name' => 'publico']);
    }
}
