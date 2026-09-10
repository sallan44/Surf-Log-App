<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpotFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'     => User::factory(),
            'name'        => fake()->city() . ' Point',
            'region'      => fake()->city() . ', ' . fake()->stateAbbr(),
            'latitude'    => fake()->latitude(-45, -10),
            'longitude'   => fake()->longitude(110, 155),
            'description' => fake()->sentence(),
            'is_private'  => false,
        ];
    }

    public function private(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_private' => true,
        ]);
    }
}