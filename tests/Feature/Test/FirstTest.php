<?php

namespace Tests\Feature\Test;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Models\Article;
use App\Models\Store;
use App\Models\Profile;
use App\Models\Like;
use App\Models\Favorite;
use Illuminate\Http\Response;

class FirstTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_top(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertSee('top');
    }
    public function test_topFavorite(): void
    {
        // テスト用のユーザーを作成
        $user = User::factory()->create();

        // 作成したユーザーでログイン状態を模倣
        $this->actingAs($user);

        // ログインしたユーザーの状態で /favoriteList ルートにアクセス
        $response = $this->get('/favoriteList');

        // レスポンスを検証
        $response->assertStatus(200);

        // レスポンスに含まれる特定のテキストを確認
        $response->assertSee('favorite_articles');
    }
    /**
     * ユーザー登録のテスト
     */
    public function testUserRegister()
    {
        $data = [
            'name'                  => 'juno',
            'email'                 => 'juno@email.com',
            'password'              => 'test1234',
            'password_confirmation' => 'test1234',
        ];

        $response = $this->postJson(route('register'), $data);

        $response->assertStatus(302)
            ->assertRedirect('/dashboard');

        $this->assertDatabaseHas('users', [
            'name'    => 'juno',
            'email'   => 'juno@email.com',
        ]);
    }
}
