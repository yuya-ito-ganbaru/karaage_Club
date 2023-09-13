<?php

namespace App\Http\Controllers;

use App\Models\Profile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AccountProfileController extends Controller
{
    /**
     * プロフィール検索
     * @return $account $user
     */
    public function account()
    {
        //ログインユーザー確認
        $user = Auth::user();
        $account = Profile::where('user_id', $user->id)->first();
        return view('/userContents/accountProfiles/accountProfile', compact('account', 'user'));
    }
    /**
     * プロフィール編集用データ検索
     * @return $account
     */
    public function edit()
    {
        //ログインユーザー確認
        $user = Auth::user();
        $account = Profile::where('user_id', $user->id)->first();
        return view('/userContents/accountProfiles/edit', compact('account'));
    }

    /**
     * プロフィール作成
     * 
     */
    public function create(Request $request)
    {
        //dd($_POST);
        //ディレクトリ名
        $dir = 'img';
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
        $profile = new Profile();

        //プロフィール情報を設定
        $profile->user_id = $user->id;
        $profile->body = $request->input('body');
        $profile->nickname = $request->input('nickname');
        $profile->image = $file_name;
        $profile->save();
        return redirect()->route('accountProfile');
    }
    /**
     * プロフィール更新
     * 
     */
    public function upDate(Request $request)
    {
        $file_name = null;

        //ログインユーザー確認
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();

        //ディレクトリ名
        $dir = 'img';
        // 新しい画像かどうかをチェック
        if ($request->hasFile('image')) {
            // 新しいファイル名を取得
            $file_name = $request->file('image')->getClientOriginalName();
            // 既存の画像ファイルを削除
            if ($profile->image) {
                Storage::delete('public/' . $dir . '/' . $profile->image);
            }

            // 新しい画像を保存
            $request->file('image')->storeAs('public/' . $dir, $file_name);

            // プロフィールに新しい画像の情報を設定
            $profile->image = $file_name;
        }

        $profile->body = $request->body;
        $profile->nickname = $request->input('nickname');
        //$profile->image = $file_name;
        if ($file_name) {
            $profile->image = $file_name;
        }
        $profile->save();
        return redirect()->route('accountProfile');
    }

    /**
     * プロフィール削除
     * 
     */
    public function delete()
    {
        //dd($_POST);
        //ログインユーザー確認
        $user = Auth::user();
        $account = Profile::where('user_id', $user->id)->first();
        if (!$account) {
            return redirect()->route('accountProfile');
        }
        // プロフィールの画像ファイル削除
        if ($account->image) {
            $dir = 'img';
            $imagePath = 'public/' . $dir . '/' . $account->image;

            // 画像ファイルを削除
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
        }
        $account->delete();
        return redirect()->route('accountProfile');
    }
}
