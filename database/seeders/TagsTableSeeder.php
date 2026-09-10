<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = ['reef break', 'beach break', 'point break', 'beginner-friendly', 'longboard-friendly'];

        foreach ($tags as $name) {
            // firstOrCreate because 'name' has a unique constraint - re-running this seeder
            // (e.g. a plain `php artisan db:seed` without --fresh) would otherwise crash.
            Tag::firstOrCreate(['name' => $name]);
        }
    }
}
