<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Favorite;

class FavoriteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startId = 1;
        $endId = 6;
        //
        foreach (range($startId,$endId) as $favoriteId) {
            Favorite::create([
                'article_id' => $favoriteId,
                'user_id' => rand($startId, $endId),
            ]);
        }
    }
}
