<?php

namespace Database\Factories;

use App\Models\Clinica;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Empleado>
 */
class EmpleadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->firstName(),
            'apellido'=>fake()->lastName(),
            'dni' => fake('es_ES')->unique()->dni(),
            'clinica_id' => rand(1,Clinica::count()),
            'email' => fake()->unique()->safeEmail()
        ];
    }
}
