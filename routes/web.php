<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccountProfileController;
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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/**** topページ表示 ****/
Route::get('/', function () {
    return view('/topPage/top');
})->name('top');

/**** userContents表示 ****/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('/userContents/dashboard');
    })->name('dashboard');
    
    Route::get('/accountProfile', [AccountProfileController::class, 'account'])->name('accountProfile');
    Route::get('/accountProfile/edit', [AccountProfileController::class, 'edit'])->name('edit');

    Route::get('/articlePost', function () {
        return view('/userContents/articlePosts/articlePost');
    })->name('articlePost');
});

/**** userContents 登録、編集、削除 ****/
Route::middleware(['auth'])->group(function () {
    Route::post('/accountProfile/create', [AccountProfileController::class, 'create'])->name('create');
    Route::post('/accountProfile/update', [AccountProfileController::class, 'upDate'])->name('upDate');
    Route::post('/accountProfile/delete', [AccountProfileController::class, 'delete'])->name('delete');
});

/**** 作業用スペース ****/
//Route::get('/text',[AccountProfileController::class, 'account']);
//Route::post('/text',[AccountProfileController::class, 'create'])->name('create');


/**** 作業用スペース ****/


require __DIR__ . '/auth.php';
