<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email'],
            'body' => ['required', 'string', 'max:100'],
        ];

        return $rules;
    }

    /**
     * 属性名
     * /lang/ja/validation.phpで指定した内容を変更する場合に設定
     */
    public function attributes()
    {
        return [
            //'name' => '名前',
            //'email' => 'メールアドレス',
            'body' => 'お問い合わせ内容'
        ];
    }
    /**
     * エラーメッセージ
     */
    public function messages()
    {
        return [
            'required' => ':attributeは必須項目です。'
        ];
    }
}
