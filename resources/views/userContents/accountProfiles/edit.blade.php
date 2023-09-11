<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ('プロフィール') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ !$account ? route('create') : route('upDate') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div style="margin-top:2%;">
                            <label for="formFile" class="form-label">プロフィール写真</label>
                            <input name="image" class="form-control" type="file" id="formFile" value="">
                        </div>

                        <div style="margin-top:2%;">
                            <label for="formControlInput" class="form-label">ニックネーム</label>
                            <input name="nickname" style="border-radius: 5px; border:1px solid #d1cfcf;;" type="text" class="form-control" id="formControlInput" value="{{ $account ? $account->nickname : 'からあげメンバー' }}">
                        </div>

                        <div style="margin-top:2%;" class="form-floating">
                            <textarea name="body" class="form-control" placeholder="自己紹介" id="floatingInput" style="min-height: 550px">{{ $account ? $account->body : '' }}</textarea>
                            <label style="color: #d1cfcf;" for="floatingInput">自己紹介文</label>
                        </div>

                        <input style="background-color: black; border-color: white; margin-top:2%; padding:10px;" type="submit" class="btn btn-dark" name="submit" id="submit" value="送信">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>