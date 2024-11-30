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
            // 'name' => fake()->name(),
            // 'last_name' => fake()->lastName(),
            // 'gender' => fake()->randomElement(['Male', 'Female']),
            // 'address' => fake()->address(),
            // 'contact' => fake()->phoneNumber(),
            // 'valid_id' => 'valid_ids/id_example.jpg',

            'user_name' => $this->faker->unique()->userName(), // Ensures unique usernames
            'full_name' => $this->faker->name(), // Generates full names (first + last)
            'contact' => $this->faker->unique()->e164PhoneNumber(), // Generates valid phone numbers
            'email' => $this->faker->unique()->safeEmail(), // Unique email addresses
            'email_verified_at' => now(), // Current timestamp for email verification
            'password' => bcrypt('password'), // Default password for generated users
            'user_type' => $this->faker->randomElement([1, 2]), // Randomly selects 1 or 2 as integer
            'remember_token' => Str::random(10), // Generates a random remember token
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
