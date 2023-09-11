<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileTableSeeder extends Seeder
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
            Profile::create([
                'user_id' => $user_id, // ユーザーIDを指定
                'body' => 'usersテーブルのID' . $user_id . 'のユーザープロフィールのテキストです。よろしくお願いします。',
            ]);
        }
    }
}
