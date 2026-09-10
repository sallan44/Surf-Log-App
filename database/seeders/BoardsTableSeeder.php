<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = DB::table('users')->where('email', 'sam@example.com')->value('id');

        DB::table('boards')->insert([
            'name' => 'Blue Fish',
            'type' => 'fish',
            'length_ft' => 5.8,
            'user_id' => $userId,
        ]);
        DB::table('boards')->insert([
            'name' => 'Old Faithful',
            'type' => 'longboard',
            'length_ft' => 9.0,
            'user_id' => $userId,
        ]);
        DB::table('boards')->insert([
            'name' => 'Daily Driver',
            'type' => 'shortboard',
            'length_ft' => 6.1,
            'user_id' => $userId,
        ]);
    }
}