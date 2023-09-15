<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ('プロフィール ※レスポンシブ未対応、styleのリファクタリング未対応') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div style="display: flex;">
                    <div style="width: 25%;" class="p-6">
                        <div style="width: 100%; height: 0; padding-bottom: 100%; position: relative;">
                            <img class="prof_img" src="{{ $account && $account->image ? asset('storage/img/' . $account->image) : asset('images/karaage.png') }}" alt="#">
                        </div>
                    </div>
                    <div style="width: 100%;" class="p-6 text-gray-900">
                        <h1 style="padding-bottom:2%;">ニックネーム</h1>
                        <p style="padding-bottom:2%;">{{ $account && $account->nickname ? $account->nickname : 'からあげメンバー' }}</p>
                        <h1 style="padding-bottom:2%;">自己紹介</h1>
                        <p style="padding-bottom:2%;">{{ $account ? $account->body : '' }}</p>
                        <p style="padding-bottom:2%;">登録日:{{ date('Y年n月j日', strtotime($user->created_at)) }}</p>
                    </div>
                </div>
                <div class="p-6" style="display: flex;">
                    <div>
                        <a class="btn btn-dark" style="background-color: black; border-color: white; margin:24px 1.5rem; color:white; padding:10px;" href="{{ route('edit') }}">編集・登録</a>
                    </div>
                    <div>
                        <form action="{{ route('delete') }}" method="post">
                        @csrf
                        <button style="margin:24px 1.5rem; padding:10px;" class="btn btn-danger"><input name="delete" type="submit" value="プロフィールリセット"></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>