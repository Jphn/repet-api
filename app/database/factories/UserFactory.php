<?php

namespace App\Database\Factories;

use App\Models\User;

class UserFactory extends Factory
{
    // If this model property isn't defined, Leaf will
    // try to generate the model name from the factory name
    public $model = User::class;

    // You define your factory blueprint here
    // It should return an associative array
    public function definition(): array
    {
        return [
            // 'username' => strtolower($this->faker->firstName),
            // 'fullname' => $this->faker->name,
            // 'email' => $this->faker->unique()->safeEmail,
            // 'email_verified_at' => tick()->now(),
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            // 'remember_token' => $this->str::random(10),

            'display_name' => $this->faker->firstName,
            'username' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->email(),
            'phone' => $this->faker->phoneNumber,
            'birthdate' => $this->faker->date,
            'registration' => 2022209502 . $this->faker->unique()->numberBetween(1000, 9999),
            'points' => $this->faker->randomNumber(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];
    }
}
