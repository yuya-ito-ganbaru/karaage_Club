<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Favorite;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TodoController extends Controller
{

    //コメント作成
    public function postComment(Request $request)
    {
        //ログインユーザー確認
        $user = Auth::user();
        $comment = new Comment();

        $comment->user_id = $user->id;
        $comment->article_id = $request->input('article_id');
        $comment->article_id = $request->input('comment');
        return redirect()->route('top');
    }


public function getData()
{
    $comments = Comment::orderBy('created_at', 'desc')->get();
    $json = ["comments" => $comments];
    return response()->json($json);
}
}
