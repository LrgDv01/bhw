<?php

namespace Database\Factories\Farm;
use App\Models\User;
use App\Models\Farm\DiseasesModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Farm\DiseasesModel>
 */
class DiseasesModelFactory extends Factory
{
    protected $model = DiseasesModel::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'farm_id' => User::factory(),
            'yellowing' => fake()->numberBetween(1, 10),
            'bud_rot' => fake()->numberBetween(1, 10),
            'leaf_spot' => fake()->numberBetween(1, 10),
        ];
    }
}
