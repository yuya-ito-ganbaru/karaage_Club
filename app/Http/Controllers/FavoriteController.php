<?php

namespace App\Http\Controllers;

use App\Models\Favorite;

use App\Models\User;
use App\Models\Article;
use App\Models\Like;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FavoriteController extends Controller
{
    //
    /**
     * お気に入り 登録
     * 
     */
    public function favoriteRegister(Request $request)
    {
        //dd($_POST);
        $user = Auth::user();
        $favorite = Favorite::where([
            'user_id' => $user->id,
            'article_id' => $request->input('article_id')
        ])->first();
        if (!$favorite) {
            $new_favorite = new Favorite();
            $new_favorite->user_id = $user->id;
            $new_favorite->article_id = $request->input('article_id');
            $new_favorite->save();
            //return redirect()->route('top');
            return response()->json(['message' => '新規お気に入り登録しました']);
        }
        return response()->json(['message' => 'お気に入り登録済みです']);
    }
    //
    /**
     * お気に入り 削除
     * 
     */
    public function favoriteDelete(Request $request)
    {
        //dd($_POST);
        $user = Auth::user();
        $favorite = Favorite::where([
            'user_id' => $user->id,
            'article_id' => $request->input('article_id')
        ])->first();
        if (!$favorite) {
            return response()->json(['message' => 'お気に入り登録がありません']);
        }
        $favorite->delete();
        //return redirect()->route('top');
        return response()->json(['message' => 'お気に入り削除しました']);
    }
    /**
     * お気に入り検索
     * @return view
     */
    public function favoriteList()
    {
        $user = Auth::user();
        $favoriteLists = Favorite::where('user_id', $user->id)->get();
        //favoriteテーブルのarticle_idを検索
        $favoriteLists_article_id = $favoriteLists->pluck('article_id')->toArray();
        //favoriteテーブルのarticle_idからArticleテーブルのidを検索
        $favoriteLists_articles = Article::whereIn('id', $favoriteLists_article_id)->get();
        return view('/userContents/favoriteLists/favoriteList', compact('favoriteLists_articles'));
    }
}

/*
for ($i = 1; $i <= 10; $i++) {
    if ($i % 3 === 0) {
        echo 'fuzz';
    } elseif ($i % 5 === 0) {
        echo 'bizz';
    } else {
        echo $i;
    }
}
*/
