<?php

namespace App\Http\Controllers;

use App\Models\Like;

use App\Models\User;
use App\Models\Article;
use App\Models\Favorite;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LikeController extends Controller
{
    //
    /**
     * いいねカウント+
     * 
     */
    public function postCountUp(Request $request)
    {
        //dd($_POST);
        //$user = Auth::user();
        $like = Like::where('article_id', $request->input('article_id'))->first();
        if (!$like) {
            $new_like = new Like();
            $new_like->article_id = $request->input('article_id');
            $new_like->count = 1;
            $new_like->save();
            //return redirect()->route('top');
            return response()->json(['message' => '新規レコードにカウント+1']);
        }
        $like->count++;
        $like->save();
        //return redirect()->route('top');
        return response()->json(['message' => '既存レコードに追加カウント+1']);
    }
    /**
     * いいねカウント-
     * 
     */
    public function postCountDown(Request $request)
    {
        //dd($_POST);
        //$user = Auth::user();
        $like = Like::where('article_id', $request->input('article_id'))->first();
        if (!$like) {
            return response()->json(['message' => 'いいねの登録がありません']);
        }
        $like->count--;
        $like->save();
        //return redirect()->route('top');
        return response()->json(['message' => 'カウント-1']);
    }
}