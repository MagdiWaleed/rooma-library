<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Accounts>
 */
class AccountsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Username' => $this->faker->unique()->userName(),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // Use bcrypt for password hashing
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'whatsappNumber' => $this->faker->randomNumber(9, true),
            'profilePicture' => 'default.png', // Default profile picture
        ];
    }
}
