<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

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
    public function definition()
    {
        return [
            'username' => fake()->unique()->isbn10,
            'first_name' => fake()->firstName('male'),
            'last_name' => fake()->lastName,
            'password' => Hash::make(config('global.default_password')),
            'role' => 1,
        ];
    }
}
