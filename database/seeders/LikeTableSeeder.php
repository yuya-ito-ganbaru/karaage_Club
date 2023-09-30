<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Like;

class LikeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startArticleId = 1;
        $endArticleId = 4;
        //
        foreach (range($startArticleId,$endArticleId) as $like_id) {
            Like::create([
                'article_id' => $like_id,
                'count' => rand(0, 10),
            ]);
        }
    }
}
