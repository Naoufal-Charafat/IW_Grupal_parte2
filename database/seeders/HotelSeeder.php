<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ---------------------------------------------------------
        // OPCIÓN A: Crear un Hotel Específico (Para tus pruebas)
        // ---------------------------------------------------------

        // 1. Creamos el Usuario primero (o lo buscamos si ya existe)
        $userHotel = User::firstOrCreate(
            ['email' => 'hotelprueba@hotel.com'], // Buscamos por email
            [
                'name' => 'Hotel Madrid Centro',
                'password' => 'hotel', // Contraseña
                'email_verified_at' => now(),
            ]
        );

        // 2. Creamos el registro en la tabla hoteles vinculado a ese usuario
        // Usamos firstOrCreate para no duplicarlo si corres el seeder dos veces
        Hotel::firstOrCreate(
            ['user_id' => $userHotel->id],
            [
                'total_ref_amount' => 0.00 // Inicia con saldo 0
            ]
        );
    }
}
