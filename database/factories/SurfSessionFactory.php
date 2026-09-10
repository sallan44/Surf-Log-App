<?php

namespace Database\Factories;

use App\Models\Board;
use App\Models\Spot;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SurfSessionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'      => User::factory(),
            'spot_id'      => Spot::factory(),
            'board_id'     => Board::factory(),
            'session_date' => fake()->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'rating'       => fake()->numberBetween(1, 5),
            'wave_count'   => fake()->numberBetween(0, 30),
            'notes'        => fake()->sentence(),
        ];
    }
}