<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ('投稿記事編集画面') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ ('投稿記事編集画面') }}
                    @foreach($articles as $article)
                    <form action="{{ route('articleUpData') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <!-- id -->
                        <input type="hidden" name="id" value="{{ $article->id }}">
                        
                        <div style="display: flex;">
                            <div style="width: 70%;" class="p-6">
                                
                                <div style="width: 100%; height: 0; padding-bottom: 100%; position: relative;">
                                    <img id="file-preview" class="art_img" src="{{ asset('storage/article_images/' . $article->image) }}" alt="#">
                                </div>

                                <label for="formFile" class="form-label">投稿写真</label>
                                <input name="image" class="form-control" type="file" id="formFile">
                                <br>

                                <div class="review">
                                    <div class="stars">
                                    <p>おすすめ度</p>
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
                                        @if($errors->has('recommend'))
                                        <p style="color: red;">{{ $errors->first('recommend') }}</p>
                                        @endif
                                        </span>
                                    </div>
                                    <!--
                                    <input type="hidden" name="recommend" id="selectedRecommendValue" value="">
                                    -->
                                </div>
                            </div>
                            <div style="width: 100%;" class="p-6 text-gray-900">
                                <div>
                                    <label for="title" class="form-label">タイトル</label>
                                    @if($errors->has('title'))
                                    <p style="color: red;">{{ $errors->first('title') }}</p>
                                    @endif
                                    <input id="title" name="title" style="border-radius: 5px; border:1px solid #d1cfcf;;" type="text" class="form-control" value="{{ $article->title }}{{ old('title') }}">
                                </div>
                                <div style="margin-top:2%;">
                                    <label for="tag" class="form-label">タグ</label>
                                    <input id="tag" name="tag" style="border-radius: 5px; border:1px solid #d1cfcf;;" type="text" class="form-control" value="{{ $article->tag }}{{ old('tag') }}">
                                </div>
                                <div style="margin-top:2%;">
                                    <label for="store" class="form-label">ここどこ？</label>
                                    <input id="store" name="store" style="border-radius: 5px; border:1px solid #d1cfcf;;" type="text" class="form-control" value="{{ $article->store }}{{ old('store') }}">
                                    <input id="address" name="address" style="border-radius: 5px; border:1px solid #d1cfcf;;" type="text" class="form-control" value="{{ $article->address }}{{ old('address') }}">
                                </div>
                                <div style="margin-top:2%;" class="form-floating">
                                @if($errors->has('body'))
                                    <p style="color: red;">{{ $errors->first('body') }}</p>
                                    @endif
                                    <textarea name="body" class="form-control" placeholder="自己紹介" id="floatingInput" style="min-height: 350px">{{ $article->body }}{{ old('body') }}</textarea>
                                    <label style="color: #d1cfcf;" for="floatingInput">投稿記事</label>
                                </div>
                            </div>
                        </div>
                        
                        <input style="margin:0 1.5rem; background-color: black; border-color: white; color:white; padding:10px; padding-right:20px; padding-left:20px;" type="submit" class="btn btn-dark" name="submit" id="submit" value="送信">
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
