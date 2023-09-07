<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $names = [
            'hayama' => '葉山',
            'yamada' => '山田',
            'tanaka' => '田中'
        ];

        foreach ($names as $email => $user) {
            User::create([
                'name' => $user,
                'email' => $email.'@example.com',
                'password' => bcrypt('xxx')
            ]);
        }
    }
}
