<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_name' => $this->faker->unique()->userName(), 
            'full_name' => $this->faker->name(), 
            'address' => fake()->address(),
            'contact' => $this->faker->unique()->e164PhoneNumber(), 
            'email' => $this->faker->unique()->safeEmail(), 
            'email_verified_at' => now(), 
            'password' => bcrypt('password'), 
            'user_type' => $this->faker->randomElement([1, 2]),
            'remember_token' => Str::random(10), 
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
