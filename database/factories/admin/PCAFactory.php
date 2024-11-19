<?php

namespace Database\Factories\admin;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\admin\PCA>
 */
class PCAFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $cocoSeed = fake()->numberBetween(100, 1000);
        $fertilizer = fake()->numberBetween(100, 1000);

        return [
            'coco_seed' => $cocoSeed,
            'fertilizer' => $fertilizer,
            'total_cost' => $cocoSeed + $fertilizer,
        ];
    }

}
