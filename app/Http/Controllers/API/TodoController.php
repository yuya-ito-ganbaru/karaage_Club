<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    public function getTodoList()
    {
        $sql = 'SELECT * FROM articles';
        $items = DB::select($sql);
        return $items;
    }

    //詳細更新
    public function getTodo(Request $req)
    {
        $todoId = $req->input('todoId');
        $sql = 'SELECT * FROM articles WHERE id = :todoId';
        $items = DB::select($sql, ['todoId' => $todoId]);
        return $items;
    }

    public function getTodoImage($imageId)
    {
        // 画像ファイルのパスを取得するロジック（例えばデータベースから画像ファイル名を取得）
        $imagePath = 'storage/article_images/' . $imageId;

        // 画像ファイルのパスを返却
        return response()->json(['imagePath' => $imagePath]);
    }

    //コメント機能
    public function getCommentList()
    {
        $sql = 'SELECT * FROM comments';
        $comments = DB::select($sql);
        return $comments;
    }

    //コメント作成
    public function postComment(Request $req)
    {
        dd($_POST);
        $user = Auth::user();
        $user_id = $user->id; 
        $params['user_id'] = 1; 
        $params = $req->only(['comment', 'article_id', 'user_id']);
        
        $sql = <<< 'SQL'
        INSERT 
        INTO comments(comment, $user, article_id, CREATE_DATE) 
        VALUES (:comment, :user_id, :article_id, CURDATE())
        SQL;
        DB::insert($sql, $params);
    }
}
