<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactMessage>
 */
class ContactMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $servicios = [
            'Fisioterapia Manual',
            'Rehabilitación Deportiva',
            'Masajes Terapéuticos',
            'Electroterapia',
            'Consulta General',
            'Otro'
        ];

        return [
            'nombre' => $this->faker->name(),
            'email' => $this->faker->email(),
            'telefono' => $this->faker->phoneNumber(),
            'servicio_interes' => $this->faker->randomElement($servicios),
            'mensaje' => $this->faker->paragraphs(nb: 2, asText: true),
            'leido' => false,
        ];
    }
}
