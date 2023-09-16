<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    <br>
                    <h1>やること</h1>
                    <ul>
                        <li>バリデーション処理</li>
                        <li>エラーメッセージの処理</li>
                        <li>クリック実行確認メッセージ処理</li>
                        <li>保存したimageファイルの削除処理（編集や入力内容変更時）</li>
                        <li>レスポンシブ対応</li>
                        <li>styleのリファクタリング対応</li>
                        <li>jsの読み込みタイミングの確認、表示部分の読み込みでエラーが出ている。※idが見つからないエラーなので読み込みタイミングの調整で解決できると思う。</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
