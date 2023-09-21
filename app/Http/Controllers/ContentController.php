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

        return view('/topPages/top', compact('allArticles', 'allUsers', 'allProfiles', 'allLikes', 'allFavorite'));
    }
    /**
     * お気に入りリスト
     * 
     */
    public function favoriteList()
    {
        $user = Auth::user();
        $favoriteList = Favorite::where('user_id', $user->id)->get();
        //favoriteテーブルのarticle_idを検索
        $favorite_article_id = $favoriteList->pluck('article_id')->toArray();
        $favorite_articles = Article::whereIn('id', $favorite_article_id)->get();
        return response()->json(['favorite_articles' => $favorite_articles]);
    }
}
