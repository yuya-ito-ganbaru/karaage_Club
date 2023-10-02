<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccountProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\StoreController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**** breeze ****/
//Route::get('/', function () {
//    return view('welcome');
//});

/**** ログイン後の機能 ****/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /**** userContents/accountProfile 表示 ****/
    Route::get('/accountProfile', [AccountProfileController::class, 'account'])->name('accountProfile');
    Route::get('/accountProfile/edit', [AccountProfileController::class, 'edit'])->name('edit');
    /**** userContents/accountProfile 登録、編集、削除 ****/
    Route::post('/accountProfile/create', [AccountProfileController::class, 'create'])->name('create');
    Route::post('/accountProfile/update', [AccountProfileController::class, 'upDate'])->name('upDate');
    Route::post('/accountProfile/delete', [AccountProfileController::class, 'delete'])->name('delete');

    /**** userContents/articlePost 表示 ****/
    Route::get('/articlePost', [ArticleController::class, 'account'])->name('articlePost');
    /**** userContents/articlePost 投稿 ****/
    Route::post('/articlePost/create', [ArticleController::class, 'postCreate'])->name('postCreate');
    Route::post('/articlePost', [ArticleController::class, 'postComplete'])->name('postComplete');

    /**** userContents/articleList 表示 ****/
    Route::get('/articleList', [ArticleController::class, 'articleSearch'])->name('articleList');
    Route::get('/articleView{id}', [ArticleController::class, 'articleView'])->name('articleView');
    Route::get('/articleEdit{id}', [ArticleController::class, 'articleEditView'])->name('articleEditView');
    /**** userContents/articleList 編集、削除 ****/
    Route::post('/articleList/delete', [ArticleController::class, 'articleDelete'])->name('articleDelete');
    Route::post('/articleList/upData', [ArticleController::class, 'articleUpData'])->name('articleUpData');
});


/**** userContents表示 ****/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('/userContents/dashboard');
    })->name('dashboard');
});




/**** お気に入り登録、いいねカウント 機能 ****/
//いいねカウントアップ
Route::post('/postCountUp', [LikeController::class, 'postCountUp'])->name('postCountUp');
//いいねカウントダウン
Route::post('/postCountDown', [LikeController::class, 'postCountDown'])->name('postCountDown');
//お気に入り登録
Route::post('/favoriteRegister', [FavoriteController::class, 'favoriteRegister'])->name('favoriteRegister');
//お気に入り削除
Route::post('/favoriteDelete', [FavoriteController::class, 'favoriteDelete'])->name('favoriteDelete');

/**** お問い合せページ ****/
Route::get('/form', [FormController::class, 'index'])->name('form');
Route::post('/form/confirm', [FormController::class, 'sendMail']);
Route::get('/form/confirm', [FormController::class, 'confirm'])->name('form.confirm');
Route::get('/form/complete', [FormController::class, 'complete'])->name('form.complete');

/**** topページ表示 ****/
Route::get('/', [ContentController::class, 'contentsView'])->name('top');
Route::get('/favoriteList', [ContentController::class, 'favoriteList'])->name('favoriteList');
Route::get('/pageView{id}', [ContentController::class, 'pageView'])->name('pageView');


/**** お気に入り詳細表示 ****/
Route::middleware(['auth'])->group(function () {
    Route::get('/userFavoriteList', [FavoriteController::class, 'favoriteList'])->name('userFavoriteLists');
});


Route::get('/store', [StoreController::class, 'store'])->name('store');


/**** 作業用スペース ****/

//Route::get('/contact', function () {
//    return view('/contactForm');
//});


Route::get('/top', fn() => view('top')) -> where('any', '.+')->name('sample');



Route::post('/articlePost/register', [StoreController::class, 'storeRegister'])->name('storeRegister');



//コメント投稿処理
//Route::post('/store/{comment_id}',[CommentsController::class, 'store']);




/**** 作業用スペース ****/


require __DIR__ . '/auth.php';
