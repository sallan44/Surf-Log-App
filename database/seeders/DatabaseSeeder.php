<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        // \App\Models\Tag::factory(10)->create();
        // \App\Models\Board::factory(10)->create();
        // \App\Models\Spot::factory(10)->create();
        // \App\Models\SurfSession::factory(10)->create();

        $this->call(UsersTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(BoardsTableSeeder::class);
        $this->call(SpotsTableSeeder::class);
        $this->call(SurfSessionsTableSeeder::class);
    }
}
