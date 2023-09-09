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

/**** userContentsページ表示 ****/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('/userContents/dashboard');
    })->name('dashboard');
    Route::get('/works', function () {
        return view('/userContents/workspace');
    })->name('works');
    Route::get('/works2', function () {
        return view('/userContents/workspace2');
    })->name('works2');
});

/**** userAccountContentページ表示 ****/
Route::get('/text',[AccountProfileController::class, 'account']);
Route::post('/text',[AccountProfileController::class, 'create'])->name('create');


require __DIR__.'/auth.php';