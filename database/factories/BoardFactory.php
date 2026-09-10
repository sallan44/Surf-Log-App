<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BoardFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'   => User::factory(),
            'name'      => fake()->words(2, true),
            'type'      => fake()->randomElement(['shortboard', 'longboard', 'fish', 'gun', 'other']),
            'length_ft' => fake()->randomFloat(1, 5, 10),
        ];
    }
}