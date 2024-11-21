<?php

namespace Database\Factories\Farm;
use App\Models\User;
use App\Models\Farm\CoconutVarietyModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Farm\CoconutVarietyModel>
 */
class CoconutVarietyModelFactory extends Factory
{
    protected $model = CoconutVarietyModel::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'user_id' => User::factory(),
            'laguna_tall' => fake()->numberBetween(1, 10),
            'dwarf_coconut' => fake()->numberBetween(1, 10),
            'hybrid' => fake()->numberBetween(1, 10),
        ];
    }
}
