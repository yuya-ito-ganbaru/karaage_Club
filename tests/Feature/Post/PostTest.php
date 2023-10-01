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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;



use Illuminate\Support\Facades\Event;

class PostTest extends TestCase
{
    use WithFaker;
    // ログイン後ページ表示テスト
    public function test_can_create_post()
    {

        $user = User::factory()->create();
        $response =  $this->actingAs($user)->get('/dashboard');
        $response =  $this->actingAs($user)->get('/accountProfile');
        $response =  $this->actingAs($user)->get('/accountProfile/edit');
        $response =  $this->actingAs($user)->get('/articlePost');

        $articleId = 1;
        $response =  $this->actingAs($user)->get('/articleView' . $articleId);
        $response =  $this->actingAs($user)->get('/articleEdit' . $articleId);
        $response =  $this->actingAs($user)->get('/pageView' . $articleId);
        $response->assertStatus(200);
    }

    // 投稿の内容の入力確認
    public function test_can_store_post()
    {
        // テスト用ユーザーを作成
        $user = User::factory()->create();
        
        // テスト用の画像ファイルを用意する（適切なファイルパスを指定してください）
        $imagePath = storage_path('app/public/article_images/test_PostImage.jpg');
        // POSTリクエストを送信
        $response = $this->actingAs($user)->post('/articlePost/create', [
            'title' => '入力よう',
            'tag' => '入力よう',
            'body' => '入力よう。',
            'image' => $imagePath,
            'recommend' => rand(1, 5),
            'store' => 'テスト店舗',
            'address' => 'テスト住所',
        ]);

        // レスポンスを検証
        $response->assertStatus(200); // リダイレクト先ではなく、確認画面が表示されることを確認

    }

    // 投稿の内容の保存
    public function test_post_complete()
    {
        // テスト用ユーザーを作成
    $user = User::factory()->create();

    // テスト用のダミー記事を作成
    $article = Article::factory()->create(['user_id' => $user->id]);
    //$file_name = '_upData_post.jpg';
    // テスト用の画像ファイルを作成
    $file_name = 'test.jpg';
    $image = UploadedFile::fake()->image($file_name);

    // 記事データを変数に格納
    $articleData = [
        'id' => $article->id,
        'title' => '新規投稿テスト',
        'tag' => $this->faker->word,
        'body' => $this->faker->paragraph,
        'recommend' => $this->faker->numberBetween(1, 5),
        'store' => '新規テスト店舗',
        'address' => '新規テスト住所',
        'image' => $file_name, // アップロード用の画像ファイルを設定
    ];

    // テスト用のダミーリクエストを作成
    $response = $this->actingAs($user)->post('/articlePost', $articleData);

    // レスポンスを検証
    $response->assertStatus(302);
    // 正しいリダイレクト先にリダイレクトされることを確認
    $response->assertRedirect(route('articlePost'));

    // データベースに記事が保存されたことを確認
    $this->assertDatabaseHas('articles', [
        'title' => $articleData['title'],
        'tag' => $articleData['tag'],
        'body' => $articleData['body'],
        'user_id' => $user->id,
        'store' => $articleData['store'],
        'address' => $articleData['address'],
        'recommend' => $articleData['recommend'],
    ]);

    // データベースに店舗情報が保存されたことを確認
    $this->assertDatabaseHas('stores', [
        'store' => $articleData['store'],
        'address' => $articleData['address'],
        'recommend' => $articleData['recommend'],
    ]);

        
    }
    // プロフィールの保存
    public function test_create_profile()
    {
        // テスト用のユーザーを作成
        $user = User::factory()->create();

        // テスト用の画像ファイルを生成
        $image = UploadedFile::fake()->image('profile_image.jpg');

        // POSTリクエストを送信
        $response = $this->actingAs($user)->post(route('create'), [
            'body' => $this->faker->paragraph,
            'image' => $image, // 生成した画像ファイルを使用
            'nickname' => $this->faker->userName,
        ]);

        // レスポンスを検証
        $response->assertStatus(302); // リダイレクト先に正しくリダイレクトされることを確認
        $response->assertRedirect(route('accountProfile')); // 正しいリダイレクト先にリダイレクトされることを確認

        // データベースにプロフィールが保存されたことを確認
        $this->assertDatabaseHas('profiles', [
            'user_id' => $user->id,
        ]);
    }

    // お気に入りの保存
    public function test_create_favorite()
    {
        // テスト用のユーザーを作成
        $user = User::factory()->create();
        // Article を作成
        $article_favorite = Article::factory()->state([
            'title' => 'お気に入り',
        ])->create(['user_id' => $user->id]);

        // 未登録のお気に入り登録リクエストを送信
        $response = $this->actingAs($user)->post('/favoriteRegister', [
            'article_id' => $article_favorite->id,
        ]);

        // レスポンスを検証
        $response->assertJson(['message' => '新規お気に入り登録しました']);
        $response->assertStatus(200);

        // データベースにお気に入りが保存されたことを確認
        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'article_id' => $article_favorite->id,
        ]);

        // 既に登録済みのお気に入り登録リクエストを送信
        $response = $this->actingAs($user)->post('/favoriteRegister', [
            'article_id' => $article_favorite->id,
        ]);

        // レスポンスを検証
        $response->assertJson(['message' => 'お気に入り登録済みです']);
        $response->assertStatus(200);
    }

    // いいねの保存
    public function test_create_like()
    {
        // テスト用のユーザーを作成
        $user = User::factory()->create();
        // Article を作成
        $article_like = Article::factory()->state([
            'title' => 'いいね',
        ])->create(['user_id' => $user->id]);

        // 記事に対するLikeレコードが存在しない状態でリクエストを送信
        $response = $this->postJson('/postCountUp', ['article_id' => $article_like->id]);

        // レスポンスを検証（新しいLikeレコードが作成され、カウントが1になることを期待）
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(['message' => '新規レコードにカウント+1']);

        // データベースにLikeレコードが作成されたことを確認
        $this->assertDatabaseHas('likes', ['article_id' => $article_like->id, 'count' => 1]);

        // 同じ記事に対して再度リクエストを送信
        $response = $this->postJson('/postCountUp', ['article_id' => $article_like->id]);

        // レスポンスを検証（既存のLikeレコードのカウントが増加することを期待）
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(['message' => '既存レコードに追加カウント+1']);

        // データベースのLikeレコードのカウントが増加したことを確認
        $this->assertDatabaseHas('likes', ['article_id' => $article_like->id, 'count' => 2]);
    }

    // 問い合わせの保存、問い合わせメール送信
    public function test_create_contact()
    {
        // 仮のフォームデータを作成
        $formData = [
            'name' => 'john Doe',
            'email' => 'johndoe@example.com',
            'body' => 'This is a test message.',
        ];

        // 送信ボタンの値を 'complete' に設定
        $formData['submitBtnVal'] = 'complete';

        // お問い合わせフォーム送信エンドポイントに POST リクエストを送信
        $response = $this->post('/form/confirm', $formData);

        // 送信後のリダイレクト先を検証
        $response->assertRedirect(route('form.complete'));

        // データベースにフォームデータが保存されたことを確認
        $this->assertDatabaseHas('forms', [
            'name' => $formData['name'],
            'email' => $formData['email'],
            'body' => $formData['body'],
        ]);
    }
}
