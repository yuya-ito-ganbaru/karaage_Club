<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ('新規投稿 確認画面') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ ('新規投稿確認フォーム') }}
                    <form action="{{ route('postCreate') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div style="display: flex;">
                            <div style="width: 70%;" class="p-6">
                                <div style="width: 100%; height: 0; padding-bottom: 100%; position: relative;">
                                    <img class="art_img" src="" alt="#">
                                </div>
                                <label for="formFile" class="form-label">投稿写真</label>
                                <input style="display: none;" name="image" class="form-control" type="file" id="formFile" value="">

                                <div class="review">
                                    <div class="stars stars_conf">
                                        <span>
                                            <input id="review01" type="radio" name="recommend" value="5" {{ $article->recommend == 5 ? 'checked' : '' }}>
                                            <label for="review01">★</label>
                                            <input id="review02" type="radio" name="recommend" value="4" {{ $article->recommend == 4 ? 'checked' : '' }}>
                                            <label for="review02">★</label>
                                            <input id="review03" type="radio" name="recommend" value="3" {{ $article->recommend == 3 ? 'checked' : '' }}>
                                            <label for="review03">★</label>
                                            <input id="review04" type="radio" name="recommend" value="2" {{ $article->recommend == 2 ? 'checked' : '' }}>
                                            <label for="review04">★</label>
                                            <input id="review05" type="radio" name="recommend" value="1" {{ $article->recommend == 1 ? 'checked' : '' }}>
                                            <label for="review05">★</label>
                                        </span>
                                    </div>
                                    <!--
                                    <input type="hidden" name="recommend" id="selectedRecommendValue" value="">
                                    -->
                                </div>
                            </div>
                            <div style="width: 100%;" class="p-6 text-gray-900">
                                <div style="border-bottom:1px solid #d1cfcf;">

                                    <p>{{ $article->title }}</p>
                                </div>
                                <div style="margin-top:2%; border-bottom:1px solid #d1cfcf;">

                                    <p>{{ $article->tag }}</p>
                                </div>
                                <div style="margin-top:2%; border-bottom:1px solid #d1cfcf; min-height: 350px;" class="form-floating">
                                    <p>{{ $article->body }}</p>
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