<?php

namespace Database\Factories\admin;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DOAFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'municipality' => fake()->randomElement(['San Pablo', 'Caluan', 'Liliw', 'Nagcarlan', 'Rizal', 'Victoria']),
            'district' => fake()->randomElement(['III', 'IV']),
        ];
    }
}
