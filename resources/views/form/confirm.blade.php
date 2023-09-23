@extends('layouts.contactForm')

@section('contactForm')

<section>
    <div style="padding: 20px 0;">
        <p>お問い合せ確認フォーム</p>
    </div>
    {{-- ▼▼ フォーム  --}}
    <form action="{{ route('form.confirm') }}" method="post">
        @csrf

        {{-- ▼ お名前 --}}
        <div style="padding: 0 20px; padding-bottom:20px;" class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label">お名前</label>
            <p style="padding-top:10px;">{{ old('name') }}</p>
            <input type="hidden" id="name" name="name" value="{{ old('name') }}">
        </div>

        {{-- ▼ メールアドレス --}}
        <div style="padding: 0 20px; padding-bottom:20px;" class="row mb-3">
            <label for="email" class="col-sm-2 col-form-label">メールアドレス</label>
            <p style="padding-top:10px;">{{ old('email') }}</p>
            <input type="hidden" id="email" name="email" value="{{ old('email') }}">
        </div>

        {{-- ▼ お問合わせ内容 --}}
        <div style="padding: 0 20px; padding-bottom:20px;" class="row mb-3">
            <label for="body" class="col-sm-2 col-form-label">お問合わせ</label>
            <p style="padding-top:10px;">{{ old('body') }}</p>
            <input type="hidden" id="body" name="body" value="{{ old('body') }}">
        </div>

        {{-- ▼ 送信ボタン --}}
        <div style="padding: 10px 20px;">
            <button style="padding:10px 20px; background-color: red; color: white; border-radius: 5px; margin-right: 20px;" type="submit" name="submitBtnVal" value="back">戻る</button>
            <button style="padding:10px 20px; background-color: black; color: white; border-radius: 5px; margin-right: 20px;" type="submit" name="submitBtnVal" value="complete">送信</button>
        </div>

    </form>
    {{-- ▲▲ フォーム  --}}
</section>
@stop