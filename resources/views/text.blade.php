テキストメモ


ルート設定
routes/auth.php

Route::middleware('guest')
ログイン、新規登録、パスワードリセット

Route::middleware('auth')
認証、
