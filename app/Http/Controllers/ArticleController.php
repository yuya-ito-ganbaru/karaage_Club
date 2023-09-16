<?php

namespace App\Http\Controllers;

use App\Models\Article;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * user検索
     * @return $user
     */
    public function account()
    {
        //ログインユーザー確認
        $user = Auth::user();
        return view('/userContents/articlePosts/articlePost', compact('user'));
    }
    /**
     * 記事投稿機能
     */
    public function postCreate(Request $request)
    {
        //dd($_POST);
        //ディレクトリ名
        $dir = 'article_images';
        if ($request->hasFile('image')) {
            //ファイル名を取得
            $file_name = $request->file('image')->getClientOriginalName();
            //storage/public/imgに画像を保存
            $request->file('image')->storeAs('public/' . $dir, $file_name);
        } else {
            $file_name = null;
        }

        //ログインユーザー確認
        $user = Auth::user();
        //プロフィールモデルのインスタンス作成
        $article = new Article();

        $article->user_id = $user->id;
        $article->title = $request->input('title');
        $article->tag = $request->input('tag');
        $article->image = $file_name;
        $article->body = $request->input('body');
        $article->recommend = $request->input('recommend');
        
        return view('/userContents/articlePosts/articleConfirm', compact('article'));
    }
    /**
     * 記事投稿登録機能
     */
    public function postComplete(Request $request)
    {
        //dd($_POST);
        //ログインユーザー確認
        $user = Auth::user();
        //プロフィールモデルのインスタンス作成
        $article = new Article();

        $article->user_id = $user->id;
        $article->title = $request->input('title');
        $article->tag = $request->input('tag');
        $article->image = $request->input('image');;
        $article->body = $request->input('body');
        $article->recommend = $request->input('recommend');
        $article->save();
        return redirect()->route('articlePost');
    }

    /**
     * 投稿記事検索機能
     */
    public function articleSearch() {
        //ログインユーザー確認
        $user = Auth::user();
        $articleList = Article::where('user_id', $user->id)->get();
        return view('/userContents/articleLists/articleList', compact('articleList', 'user'));
    }

}
