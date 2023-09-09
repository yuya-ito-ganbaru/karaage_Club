<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>workspace</title>
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div>
        <p>
            テキストメモ

            ルート設定
            routes/auth.php

            Route::middleware('guest')
            ログイン、新規登録、パスワードリセット

            Route::middleware('auth')
            認証、
        </p>
    </div>
    <!-- Logo -->
    <div class="shrink-0 flex items-center">
        <a href="{{ route('top') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
            <h1>トップページ</h1>
        </a>
    </div>
    @if(Auth::check())
    <div class="shrink-0 flex items-center">
        <a href="{{ route('dashboard') }}">
            <h1>userページ</h1>
        </a>
    </div>
    <div>
        <form action="{{ route('create') }}" method="post">
            @csrf
            <input type="text" name="body" value="{{ old('body', $account ? $account->body : '') }}">
            <input type="submit" name="submit" value="送信">
        </form>
    </div>
    @else
    <div>
        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
    </div>
    @endif

    
</body>

</html>