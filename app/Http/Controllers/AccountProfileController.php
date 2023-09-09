<?php

namespace App\Http\Controllers;

use App\Models\Profile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountProfileController extends Controller
{
    /**
     * プロフィール検索
     * @return $account
     */
    public function account() {
        //ログインユーザー確認
        $user = Auth::user();
        $account = Profile::where('user_id', $user->id)->first();
        if (!$account) {
            echo '情報がありません';
        } else {
            echo 'ユーザーID:'.$account->user_id.' の情報です。';
        }
        //return $account;
        echo $user->id;
        //echo $account->body;
        return view('/text',compact('account'));
    }

    /**
     * 
     * プロフィール作成
     */
    public function create(Request $request) {
        //dd($request);
        //ログインユーザー確認
        $user = Auth::user();
        //プロフィールモデルのインスタンス作成
        $profile = new Profile();

        //プロフィール情報を設定
        $profile->user_id = $user->id;
        $profile->body = $request->input('body');

        $profile->save();
    }
    
}
