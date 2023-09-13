<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startUserId = 1;
        $endUserId = 6;
        //
        foreach (range($startUserId,$endUserId) as $user_id) {
            Article::create([
                'user_id' => rand($startUserId, $endUserId),
                'title' => 'テスト投稿'.$user_id,
                'tag' => 'テスト投稿タグ'.$user_id,
                'body' => 'テスト投稿'.$user_id.'内容です。',
                'recommend' => rand(1, 5),
            ]);
        }
    }
}