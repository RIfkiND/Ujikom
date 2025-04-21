<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarif>
 */
class TarifFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'jenis_plg' => $this->faker->unique()->word(),
            'biaya_beban' => $this->faker->randomFloat(2, 10000, 100000), // Random value between 10,000 and 100,000
            'tarif_kwh' => $this->faker->randomFloat(2, 1000, 5000), // Random value between 1,000 and 5,000
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
