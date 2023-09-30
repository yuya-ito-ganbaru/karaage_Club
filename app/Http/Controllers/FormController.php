<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactFormRequest;
use App\Mail\FormAdminMail;
use App\Mail\FormUserMail;
use Illuminate\Http\Request;

use App\Models\Form;

class FormController extends Controller
{
    //

    /**
     * 入力ページ
     */
    public function index() {
        return view('form/index');
    }
    /**
     * 確認ページ
     */
    public function confirm() {
        return view('form/confirm');
    }
    /**
     * 完了ページ
     */
    public function complete() {
        return view('form/complete');
    }

    /**
     * メール送信
     */
    public function sendMail(ContactFormRequest $request) {
        //
        //$form_data = $request->validate();
        $form_data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'body' => 'required|string',
        ]);
        //submitボタンの値で条件分岐
        $submitBtnVal = $request->input('submitBtnVal');
        switch ($submitBtnVal) {
            case 'confirm';
            //値を持たせた状態で確認画面へリダイレクト
            return redirect()->route('form.confirm')->withInput();
            break;

            case 'back';
            //値を持たせた状態で入力画面へリダイレクト
            return redirect()->route('form')->withInput();
            break;

            case 'complete';
            //送信先メールアドレス
            $email_admin = 'admin@example.com';
            $email_user = $form_data['email'];
    
            //管理者宛メール
            Mail::to($email_admin)->send( new FormAdminMail($form_data) );
            //ユーザー宛メール
            Mail::to($email_user)->send( new FormUserMail($form_data) );
    
            //ログ
            Log::debug($form_data['name'] . '様よりお問い合わせがありました');

            //送信内容をデータベースに保存
            $form = new Form();
            $form->name = $form_data['name'];
            $form->email = $form_data['email'];
            $form->body = $form_data['body'];
            $form->save();
    
            return redirect()->route('form.complete');
            break;
            default;
        }

        
    }
}
