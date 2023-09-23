@extends('layouts.contactForm')

@section('contactForm')

<section>
    <div style="padding: 20px 0;">
        <p>お問い合せフォーム</p>
    </div>
    {{-- ▼▼ エラーメッセージ  --}}
    <!--
@if($errors->any())
<div>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
-->
    {{-- ▲▲ エラーメッセージ  --}}

    {{-- ▼▼ フォーム  --}}
    <form action="{{ route('form.confirm') }}" method="post">
        @csrf

        {{-- ▼ お名前 --}}
        <div style="padding: 0 20px; padding-bottom:20px;" class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label">お名前（必須）</label>
            @if($errors->has('name'))
            <p style="color: red;">{{ $errors->first('name') }}</p>
            @endif
            <div class="col-sm-10">
                <input style="width: 100%;" class="form-control" type="text" id="name" name="name" value="{{ old('name') }}">
            </div>
        </div>
        {{-- ▼ メールアドレス --}}
        <div style="padding: 0 20px; padding-bottom:20px;" class="row mb-3">
            <label for="email" class="col-sm-2 col-form-label">メールアドレス（必須）</label>
            @if($errors->has('email'))
            <p style="color: red;">{{ $errors->first('email') }}</p>
            @endif
            <div class="col-sm-10">
                <input style="width: 100%;" class="form-control" type="text" id="email" name="email" value="{{ old('email') }}">
            </div>
        </div>
        {{-- ▼ お問合わせ内容 --}}
        <div style="padding: 0 20px; padding-bottom:20px;" class="row mb-3">
            <label for="body" class="col-sm-2 col-form-label">お問合わせ（必須）</label>
            @if($errors->has('body'))
            <p style="color: red;">{{ $errors->first('body') }}</p>
            @endif
            <div class="col-sm-10">
                <div class="form-floating">
                    <textarea style="width: 100%; height: 300px" class="form-control" placeholder="お問い合せ内容" type="text" id="body" name="body">{{ old('body') }}</textarea>
                </div>
            </div>
        </div>

        {{-- ▼ 送信ボタン --}}
        <div style="padding: 0 20px;">
            <button style="padding:10px; background-color: black; color: white; border-radius: 5px;" type="submit" name="submitBtnVal" value="confirm">確認画面</button>
        </div>

    </form>
    {{-- ▲▲ フォーム  --}}
</section>
@stop




<!--
        {{-- ▼ お名前 --}}
        <div>
            <label for="name">お名前（必須）</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}">
            @if($errors->has('name'))
            <p>{{ $errors->first('name') }}</p>
            @endif
        </div>
        
        {{-- ▼ メールアドレス --}}
        <div>
            <label for="email">メールアドレス（必須）</label>
            <input type="text" id="email" name="email" value="{{ old('email') }}">
            @if($errors->has('email'))
            <p>{{ $errors->first('email') }}</p>
            @endif
        </div>
        
        {{-- ▼ お問合せ内容 --}}
        <div>
            <label for="body">お問合せ（必須）</label>
            <textarea type="text" id="body" name="body">{{ old('body') }}</textarea>
            @if($errors->has('body'))
            <p>{{ $errors->first('body') }}</p>
            @endif
        </div>
        -->