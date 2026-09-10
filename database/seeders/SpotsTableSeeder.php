<?php

namespace Database\Seeders;

use App\Models\Spot;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = DB::table('users')->where('email', 'sam@example.com')->value('id');

        $publicSpot = Spot::create([
            'user_id'     => $userId,
            'name'        => 'Snapper Rocks',
            'region'      => 'Gold Coast, QLD',
            'latitude'    => -28.1598,
            'longitude'   => 153.5470,
            'description' => 'Long right-hand point break, gets crowded but works on most swells.',
            'is_private'  => false,
        ]);

        $privateSpot = Spot::create([
            'user_id'     => $userId,
            'name'        => 'The Secret Reef',
            'region'      => 'Gold Coast, QLD',
            'latitude'    => -28.2000,
            'longitude'   => 153.5600,
            'description' => 'Only good on a very specific swell/tide combo - keep this one quiet.',
            'is_private'  => true,
        ]);

        // Attach whichever of these tags exist - guards against this seeder running before TagsTableSeeder
        $pointBreak = Tag::where('name', 'point break')->first();
        $beginnerFriendly = Tag::where('name', 'beginner-friendly')->first();
        $reefBreak = Tag::where('name', 'reef break')->first();

        $publicSpot->tags()->attach(array_filter([$pointBreak?->id, $beginnerFriendly?->id]));
        $privateSpot->tags()->attach(array_filter([$reefBreak?->id]));
    }
}
