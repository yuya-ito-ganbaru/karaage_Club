<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ('投稿記事表示') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ ('投稿記事表示') }}
                    @foreach($articles as $article)
                    <!-- Page Content-->
                    <section class="py-5">
                        <div class="container px-5 my-5">
                            <div class="row gx-5">

                                <!-- Post content-->
                                <article style="display: flex;">
                                    <!-- Preview image figure-->
                                    <div style="width: 100%; height: 0; padding-bottom: 100%; position: relative;">
                                        
                                        <figure class="mb-4"><img class="img-fluid rounded" src="{{ asset('storage/article_images/' . $article->image) }}" alt="..." /></figure>
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
                                        </div>
                                    </div>

                                    <!-- Post content-->
                                    <section style="width: 100%;" class="mb-5">
                                        <div style="width: 100%;" class="p-6 text-gray-900">
                                            <div style="border-bottom:1px solid #d1cfcf;">

                                                <p class="fs-5 mb-4">{{ $article->title }}</p>
                                            </div>
                                            <div style="margin-top:2%; border-bottom:1px solid #d1cfcf;">

                                                <p class="fs-5 mb-4">{{ $article->tag }}</p>
                                            </div>
                                            <div style="margin-top:2%; border-bottom:1px solid #d1cfcf; min-height: 350px;" class="form-floating">
                                                <p class="fs-5 mb-4">{{ $article->body }}</p>
                                            </div>
                                        </div>
                                    </section>
                                </article>
                            </div>
                    </section>
                    
                    @if(Auth::user()->id == $article->user_id)
                    <div class="p-6" style="display: flex;">
                        <div>
                            <a class="btn btn-dark" style="margin:0 1.5rem; background-color: black; border-color: white; color:white; padding:10px; padding-right:20px; padding-left:20px;" href="{{ route('articleEditView', ['id' => $article->id]) }}">編集</a>
                        </div>
                        <div>
                            <form action="{{ route('articleDelete') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $article->id }}">
                                <button style="margin:0 1.5rem; padding:10px; padding-right:20px; padding-left:20px;" class="btn btn-danger"><input name="delete" type="submit" value="削除"></button>
                            </form>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>