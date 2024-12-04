<?php

namespace Database\Factories\Farm;
use App\Models\Farm\FarmModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FarmModel>
 */
class FarmModelFactory extends Factory
{
    protected $model = FarmModel::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->company(),
            'location' => fake()->address(),
            'variety' => fake()->randomElement(['Laguna Tall', 'Dwarf Coconut', 'Hybrid']),
            'hectares' => fake()->numberBetween(1, 100), // Random number for hectares
            'tree_age' => fake()->numberBetween(1, 50), // Random age between 1 to 50 years
            'planted_coconut' => fake()->numberBetween(10, 1000), // Number of trees planted
            'soil_type' => fake()->randomElement(['Sandy', 'Clay', 'Loamy', 'Silty']), // Random soil types
        ];
    }

}
