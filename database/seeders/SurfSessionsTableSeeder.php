<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SurfSessionsTableSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sam = DB::table('users')->where('email', 'sam@example.com')->value('id');

        $blueFish   = DB::table('boards')->where('name', 'Blue Fish')->value('id');
        $oldFaithful = DB::table('boards')->where('name', 'Old Faithful')->value('id');
        $dailyDriver = DB::table('boards')->where('name', 'Daily Driver')->value('id');

        $snapperRocks = DB::table('spots')->where('name', 'Snapper Rocks')->value('id');
        $secretReef   = DB::table('spots')->where('name', 'The Secret Reef')->value('id');

        $sessions = [
            [
                'user_id'      => $sam,
                'spot_id'      => $snapperRocks,
                'board_id'     => $dailyDriver,
                'session_date' => now()->subDays(21)->toDateString(),
                'rating'       => 4,
                'wave_count'   => 12,
                'notes'        => 'Clean lines all morning, light offshore wind. Board felt great on the smaller sets.',
            ],
            [
                'user_id'      => $sam,
                'spot_id'      => $snapperRocks,
                'board_id'     => $oldFaithful,
                'session_date' => now()->subDays(18)->toDateString(),
                'rating'       => 3,
                'wave_count'   => 8,
                'notes'        => 'Bit crowded, took the longboard out to pick off the bigger ones further back.',
            ],
            [
                'user_id'      => $sam,
                'spot_id'      => $secretReef,
                'board_id'     => $blueFish,
                'session_date' => now()->subDays(15)->toDateString(),
                'rating'       => 5,
                'wave_count'   => 6,
                'notes'        => 'Perfect tide window, barely anyone out. One of the best sessions this year.',
            ],
            [
                'user_id'      => $sam,
                'spot_id'      => $snapperRocks,
                'board_id'     => $dailyDriver,
                'session_date' => now()->subDays(12)->toDateString(),
                'rating'       => 2,
                'wave_count'   => 4,
                'notes'        => null,
            ],
            [
                'user_id'      => $sam,
                'spot_id'      => $secretReef,
                'board_id'     => $blueFish,
                'session_date' => now()->subDays(9)->toDateString(),
                'rating'       => 4,
                'wave_count'   => 9,
                'notes'        => 'Swell dropped off by mid morning but still fun while it lasted.',
            ],
            [
                'user_id'      => $sam,
                'spot_id'      => $snapperRocks,
                'board_id'     => $oldFaithful,
                'session_date' => now()->subDays(6)->toDateString(),
                'rating'       => 3,
                'wave_count'   => null,
                'notes'        => 'Lost count of the waves, just cruised.',
            ],
            [
                'user_id'      => $sam,
                'spot_id'      => $snapperRocks,
                'board_id'     => $dailyDriver,
                'session_date' => now()->subDays(3)->toDateString(),
                'rating'       => 5,
                'wave_count'   => 15,
                'notes'        => 'Firing. Best conditions in weeks, stayed out until my arms gave up.',
            ],
            [
                'user_id'      => $sam,
                'spot_id'      => $secretReef,
                'board_id'     => $blueFish,
                'session_date' => now()->subDay()->toDateString(),
                'rating'       => 4,
                'wave_count'   => 7,
                'notes'        => 'Quick evening session before the wind picked up.',
            ],
        ];

        foreach ($sessions as $session) {
            DB::table('surf_sessions')->insert(array_merge($session, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}