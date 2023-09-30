<?php

namespace Tests\Feature\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;
use App\Models\Article;
use App\Models\Store;
use App\Models\Profile;
use App\Models\Like;
use App\Models\Favorite;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactFormRequest;
use App\Mail\FormAdminMail;
use App\Mail\FormUserMail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PostDeleteTest extends TestCase
{
    use WithFaker;
    
    /**
     * A basic feature test example.
     */
    // 投稿の内容の入力確認 保存された内容を上書きで保存
    public function test_can_store_upData()
    {
        // テスト用のダミーユーザーを作成
        $user = User::factory()->create();

        // テスト用のダミー記事を作成
        $article = Article::factory()->create(['user_id' => $user->id]);

        // テスト用の画像ファイルを作成（例：storage/app/public/article_images）
        // カスタムのファイル名を生成
        $file_name = '_upData_post.jpg';
        $image = UploadedFile::fake()->image('test.jpg');
        $image2 = UploadedFile::fake()->image($file_name);

        // 記事データを変数に格納
        $articleData = [
            'id' => $article->id,
            'title' => $this->faker->sentence,
            'tag' => $this->faker->word,
            'body' => $this->faker->paragraph,
            'recommend' => $this->faker->numberBetween(1, 5),
            'store' => 'テスト店舗',
            'address' => 'テスト住所',
            'image' => $image,
        ];

        // テスト用のダミーリクエストを作成
        $response = $this->actingAs($user)->post('/articleList/upData', $articleData);
        $response->assertStatus(302);

        // データを更新するために新しいデータを設定
        $updatedArticleData = [
            'id' => $article->id,
            'title' => '編集ずみです',
            'tag' => '編集ずみです',
            'body' => '編集ずみです',
            'recommend' => 3,
            'store' => 'テスト店舗2',
            'address' => 'テスト住所1',
            'image' => $image2,
        ];

        // 更新用のリクエストを送信
        $response = $this->actingAs($user)
            ->post('/articleList/upData', $updatedArticleData);
        // レスポンスを検証
        $response->assertStatus(302); // リダイレクト先に正しくリダイレクトされることを確認
        $response->assertRedirect(route('articleList'));
        
    }
    // 投稿の内容の入力確認 保存された内容を削除
    public function test_can_store_delete()
    {
        // テスト用のダミーユーザーを作成
        $user = User::factory()->create();

        // テスト用のダミー記事を作成
        $article = Article::factory()->create(['user_id' => $user->id]);

        // カスタムのファイル名を生成
        $file_name = '_delete_post.jpg';
        // テスト用の画像ファイルを作成（例：storage/app/public/article_images）
        $image3 = UploadedFile::fake()->image($file_name);
        //$image2 = UploadedFile::fake()->image('testTest.jpg');

        // 記事データを変数に格納
        $articleData = [
            'id' => $article->id,
            'title' => 'テスト削除',
            'tag' => $this->faker->word,
            'body' => $this->faker->paragraph,
            'recommend' => $this->faker->numberBetween(1, 5),
            'store' => 'テスト店舗',
            'address' => 'テスト住所',
            'image' => $image3,
        ];

        // テスト用のダミーリクエストを作成
        $response = $this->actingAs($user)->post('/articleList/upData', $articleData);
        $response->assertStatus(302);

        // 記事を削除
        $deleteResponse = $this->actingAs($user)->post('/articleList/delete', ['id' => $article->id]);
        $deleteResponse->assertStatus(302);

        // データベースから記事が削除されたことを確認
        $this->assertDatabaseMissing('articles', ['id' => $article->id]);
    }

    // プロフィールのの保存 保存された内容を上書きで保存
    public function test_upData_profile()
    {
        // テスト用のユーザーを作成
        $user = User::factory()->create();

        // 初回のプロフィール作成
        // テスト用の画像ファイルを作成（例：storage/app/public/imag）
        $image = UploadedFile::fake()->image('test.jpg');
        $image2 = UploadedFile::fake()->image('testTest.jpg');

        $createResponse = $this->actingAs($user)->post('/accountProfile/create', [
            'body' => '初回のプロフィール内容です。',
            'image' => $image,
            'nickname' => '初回のニックネーム',
        ]);

        // レスポンスを検証
        $createResponse->assertStatus(302);
        $createResponse->assertRedirect(route('accountProfile'));

        // プロフィールの上書き更新
        //$updatedImagePath = storage_path('app/public/img/updated_test_image.jpg');
        //$updatedUploadedFile = new UploadedFile($updatedImagePath, 'updated_test_image.jpg', 'image/jpeg', null, true);
        //UploadedFile::fake()->create('updated_test_image.jpg')->storeAs('public/img', 'updated_test_image.jpg');

        $updateResponse = $this->actingAs($user)->post('/accountProfile/update', [
            'body' => '更新後のプロフィール内容です。',
            'image' => $image2,
            'nickname' => '更新後のニックネーム',
        ]);

        // レスポンスを検証
        $updateResponse->assertStatus(302);
        $updateResponse->assertRedirect(route('accountProfile'));
    }

    // プロフィールのの保存 保存された内容を削除
    public function test_delete_profile()
    {
        // テスト用のユーザーを作成
        $user = User::factory()->create();

        // テスト用の画像ファイルを生成
        $image = UploadedFile::fake()->image('profile_delete_image.jpg');

        // POSTリクエストを送信
        $response = $this->actingAs($user)->post(route('create'), [
            'body' => $this->faker->paragraph,
            'image' => $image, // 生成した画像ファイルを使用
            'nickname' => '削除ネーム',
        ]);

        // レスポンスを検証
        $response->assertStatus(302); // リダイレクト先に正しくリダイレクトされることを確認
        $response->assertRedirect(route('accountProfile')); // 正しいリダイレクト先にリダイレクトされることを確認

        // データベースにプロフィールが保存されたことを確認
        $this->assertDatabaseHas('profiles', [
            'user_id' => $user->id,
        ]);

        // プロフィールを削除
        $deleteResponse = $this->actingAs($user)->post('/accountProfile/delete', ['id' => $user->id]);
        $deleteResponse->assertStatus(302);
    }


    // お気に入りの保存 保存してから削除
    public function test_delete_favorite() {
        // テスト用のユーザーを作成
        $user = User::factory()->create();
        // Article を作成
        $article_favorite_delete = Article::factory()->state([
            'title' => '削除お気に入り',
        ])->create(['user_id' => $user->id]);

        // 未登録のお気に入り登録リクエストを送信
        $response = $this->actingAs($user)->post('/favoriteRegister', [
            'article_id' => $article_favorite_delete->id,
        ]);

        // レスポンスを検証
        $response->assertJson(['message' => '新規お気に入り登録しました']);
        $response->assertStatus(200);

        // 既に登録済みのお気に入り登録リクエストを送信
        $response = $this->actingAs($user)->post('/favoriteDelete', [
            'article_id' => $article_favorite_delete->id,
        ]);

        $response->assertJson(['message' => 'お気に入り削除しました']);
        $response->assertStatus(200);

    }

   // いいねの保存 保存してから削除
   public function test_delete_like() {
    // テスト用のユーザーを作成
    $user = User::factory()->create();
    // Article を作成
    $article_like_delete = Article::factory()->state([
        'title' => '削除いいね',
    ])->create(['user_id' => $user->id]);
    
    // 記事に対するLikeレコードが存在しない状態でリクエストを送信してカウントを1に増やす
    $response = $this->postJson('/postCountUp', ['article_id' => $article_like_delete->id]);
    
    // レスポンスを検証（新しいLikeレコードが作成され、カウントが1になることを期待）
    $response->assertStatus(Response::HTTP_OK);
    $response->assertJson(['message' => '新規レコードにカウント+1']);
    
    // データベースにLikeレコードが作成されたことを確認
    $this->assertDatabaseHas('likes', ['article_id' => $article_like_delete->id, 'count' => 1]);
    
    // 同じ記事に対して再度リクエストを送信（カウントが減少することを期待）
    $response = $this->postJson('/postCountDown', ['article_id' => $article_like_delete->id]);
    
    // レスポンスを検証（既存のLikeレコードのカウントが減少することを期待）
    $response->assertStatus(Response::HTTP_OK);
    $response->assertJson(['message' => 'カウント-1']);
    
    // データベースのLikeレコードのカウントが減少したことを確認
    $this->assertDatabaseHas('likes', ['article_id' => $article_like_delete->id, 'count' => 0]);
    
   }
}
