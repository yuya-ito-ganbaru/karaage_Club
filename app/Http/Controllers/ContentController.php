<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Article;
use App\Models\Like;
use App\Models\Favorite;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    //
    /**
     * contents表示
     * @return view
     */
    public function contentsView()
    {
        $allUsers = Auth::user();
        $allProfiles = Profile::all();
        $allArticles = Article::all();
        $allLikes = Like::all();
        $allFavorite = Favorite::all();

        $id = 5;
        $articles = Article::where('id', $id)->get();

        return view('/topPages/top', compact('allArticles', 'allUsers', 'allProfiles', 'allLikes', 'allFavorite','articles'));
    }
    /**
     * お気に入りリスト
     * 
     */
    public function favoriteList()
    {
        if (Auth::check()) {
        $user = Auth::user();
        $favoriteList = Favorite::where('user_id', $user->id)->get();
        //favoriteテーブルのarticle_idを検索
        $favorite_article_id = $favoriteList->pluck('article_id')->toArray();
        $favorite_articles = Article::whereIn('id', $favorite_article_id)->get();
        return response()->json(['favorite_articles' => $favorite_articles]);
        }
    }

    /**
     * 投稿記事表示機能
     */
    public function pageView($id)
    {
        $articles = Article::where('id', $id)->get();
        return view('/topPages/pageView', compact('articles'));
    }
}
