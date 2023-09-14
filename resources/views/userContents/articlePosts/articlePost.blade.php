<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ('新規投稿') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ ('新規投稿フォーム') }}
                    <form action="{{ route('postCreate') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div style="display: flex;">
                            <div style="width: 45%;" class="p-6">
                                <div style="width: 100%; height: 0; padding-bottom: 100%; position: relative;">
                                    <img style="border: 1px solid #d1cfcf; width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;" src="{{ asset('images/karaage.png') }}" alt="#">
                                </div>
                                <label for="formFile" class="form-label">投稿写真</label>
                                <input name="image" class="form-control" type="file" id="formFile" value="">
                                <br>

                                <div class="review">
                                    <div class="stars">
                                        <span>
                                            <input id="review01" type="radio" name="recommend" value="5"><label for="review01">★</label>
                                            <input id="review02" type="radio" name="recommend" value="4"><label for="review02">★</label>
                                            <input id="review03" type="radio" name="recommend" value="3"><label for="review03">★</label>
                                            <input id="review04" type="radio" name="recommend" value="2"><label for="review04">★</label>
                                            <input id="review05" type="radio" name="recommend" value="1"><label for="review05">★</label>
                                        </span>
                                    </div>
                                </div>
                                <input type="hidden" name="recommend" id="selectedRecommendValue" value="">
                            </div>
                            <div style="width: 100%;" class="p-6 text-gray-900">
                                <div style="">
                                    <label for="formControlInput" class="form-label">タイトル</label>
                                    <input name="title" style="border-radius: 5px; border:1px solid #d1cfcf;;" type="text" class="form-control" id="formControlInput" value="">
                                </div>
                                <div style="margin-top:2%;">
                                    <label for="formControlInput" class="form-label">タグ</label>
                                    <input name="tag" style="border-radius: 5px; border:1px solid #d1cfcf;;" type="text" class="form-control" id="formControlInput" value="">
                                </div>
                                <div style="margin-top:2%;" class="form-floating">
                                    <textarea name="body" class="form-control" placeholder="自己紹介" id="floatingInput" style="min-height: 350px"></textarea>
                                    <label style="color: #d1cfcf;" for="floatingInput">投稿記事</label>
                                </div>
                            </div>
                        </div>

                        <input style="background-color: black; border-color: white; margin-top:2%; padding:10px;" type="submit" class="btn btn-dark" name="submit" id="submit" value="送信">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>