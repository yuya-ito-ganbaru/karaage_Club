<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Store;

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
        $article_data = $request->validate([
            'image' => 'required|file',
            'title' => 'required|string',
            'body' => 'required|string',
            'recommend' => 'required|string',
        ]);
        //dd($_POST);
        //ログインユーザー確認
        $user = Auth::user();
        //プロフィールモデルのインスタンス作成
        $article = new Article();
        $store = new Store();
        
        //ディレクトリ名
        $dir = 'article_images';
        if ($request->hasFile('image')) {
            //ファイル名を取得
            //$file_name = $request->file('image')->getClientOriginalName();
            $file_name = $user->id . '_' . date('Y_m_d_His') . '_' . $request->file('image')->getClientOriginalName();
            //storage/public/imgに画像を保存
            $request->file('image')->storeAs('public/' . $dir, $file_name);
        } else {
            $file_name = null;
        }

        $article->user_id = $user->id;
        $article->title = $article_data['title'];
        $article->tag = $request->input('tag');
        $article->image = $file_name;
        $article->body = $article_data['body'];
        $article->recommend = $article_data['recommend'];
        $store->store = $request->input('store');
        $store->address = $request->input('address');
        return view('/userContents/articlePosts/articleConfirm', compact('article','store'));
    }
    /**
     * 記事投稿登録機能
     */
    public function postComplete(Request $request)
    {
        if ($request->input('return')) {
            return redirect()->route('articlePost')->withInput();
        }
        //dd($_POST);
        //ログインユーザー確認
        $user = Auth::user();
        //プロフィールモデルのインスタンス作成
        $article = new Article();
        $store = new Store();

        $article->user_id = $user->id;
        $article->title = $request->input('title');
        $article->tag = $request->input('tag');
        $article->image = $request->input('image');;
        $article->body = $request->input('body');
        $article->store = $request->input('store');
        $article->address = $request->input('address');
        $article->recommend = $request->input('recommend');
        $article->save();
        $store->store = $request->input('store');
        $store->address = $request->input('address');
        $store->recommend = $request->input('recommend');
        $store->save();
        return redirect()->route('articlePost');
    }

    /**
     * 投稿記事検索機能
     */
    public function articleSearch()
    {
        //ログインユーザー確認
        $user = Auth::user();
        $articleList = Article::where('user_id', $user->id)->get();
        return view('/userContents/articleLists/articleList', compact('articleList', 'user'));
    }
    /**
     * 投稿記事表示機能
     */
    public function articleView($id)
    {
        $articles = Article::where('id', $id)->get();
        return view('/userContents/articleLists/articleView', compact('articles'));
    }
    /**
     * 投稿記事削除機能
     */
    public function articleDelete(Request $request)
    {
        //dd($_POST);
        $article = Article::find($request->input('id'));
        //dd($article);
        // 既存画像ファイル削除
        if ($article->image) {
            $dir = 'article_images';
            $imagePath = 'public/' . $dir . '/' . $article->image;

            // 画像ファイルを削除
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
        }
        $article->delete();
        return redirect()->route('articleList');
    }

    /**
     * 編集画面表示
     */
    public function articleEditView($id)
    {
        $articles = Article::where('id', $id)->get();
        return view('/userContents/articleLists/articleEdit', compact('articles'));
    }
    /**
     * 投稿記事編集機能
     */
    public function articleUpData(Request $request)
    {
        $article_data = $request->validate([
            //'image' => 'required|file',
            'title' => 'required|string',
            'body' => 'required|string',
            'recommend' => 'required|string',
        ]);
        //dd($_POST);
        $user = Auth::user();
        $article = Article::find($request->input('id'));
        $dir = 'article_images';

        if ($request->hasFile('image')) {
            $imagePath = 'public/' . $dir . '/' . $article->image;

            // 画像ファイルを削除
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
            //ファイル名を取得
            //$file_name = $request->file('image')->getClientOriginalName();
            $file_name = $user->id . '_' . date('Y_m_d_His') . '_' . $request->file('image')->getClientOriginalName();
            //storage/public/imgに画像を保存
            $request->file('image')->storeAs('public/' . $dir, $file_name);
            $article->image = $file_name;
        }

        $article->user_id = $user->id;
        $article->title = $article_data['title'];
        $article->tag = $request->input('tag');
        $article->address = $request->input('address');
        $article->recommend = $request->input('recommend');
        $article->body = $article_data['body'];
        $article->recommend = $article_data['recommend'];
        $article->save();
        
        
        
        return redirect()->route('articleList');
    }
}
