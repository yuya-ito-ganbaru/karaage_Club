<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    public function getTodoList() {
        $sql = 'SELECT * FROM articles';
        $items = DB::select($sql);
        return $items;
    }

    //詳細更新
    public function getTodo(Request $req) {
        $todoId = $req->input('todoId');
        $sql = 'SELECT * FROM articles WHERE id = :todoId';
        $items = DB::select($sql, ['todoId' => $todoId]);
        return $items;
    }

    public function getTodoImage($imageId) {
        // 画像ファイルのパスを取得するロジック（例えばデータベースから画像ファイル名を取得）
        $imagePath = 'storage/article_images/' . $imageId;
    
        // 画像ファイルのパスを返却
        return response()->json(['imagePath' => $imagePath]);
    }

}