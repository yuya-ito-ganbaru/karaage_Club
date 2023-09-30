<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ('お気に入り') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ ('お気に入り') }}
                    <ul class="list-group list-group-flush" style="width: 70%;">

                        @foreach($favoriteLists_articles as $favoriteList_article)
                        <li class="list-group-item">
                            <p><a href="{{ route('articleView', ['id' => $favoriteList_article->id]) }}">{{ $favoriteList_article->title }}</a></p>
                            <p>投稿日:{{ $favoriteList_article->created_at->format('Y-m-d') }}</p>
                            <i class="click fa-solid fa-heart" style="color: #d1d1d1;">
                                <input class="article_id" type="hidden" name="article_id" value="{{ $favoriteList_article->id }}">
                            </i>
                        </li>
                        @endforeach
                        <br>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            var url = "{{ route('favoriteList') }}";

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // 取得したお気に入り記事のID
                    var favoriteArticles = data.favorite_articles;
                    console.log(data.favorite_articles);
                    $('.click').each(function() {
                        var article_id = $(this).find('.article_id').val();

                        var favoriteList = favoriteArticles.some(function(favorite) {
                            return favorite.id === parseInt(article_id);
                        });

                        if (favoriteList) {
                            $(this).css('color', '#ee2f69');
                            console.log('お気に入りです');
                        } else {
                            $(this).css('color', '#d1d1d1');
                            console.log('お気に入りにありません');
                        }
                    });
                },
                error: function() {
                    console.log('error');
                }
            });
        });
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function() {
            $('.click').click(function() {
                var color = $(this).css('color');
                if (color === 'rgb(209, 209, 209)') {
                    $(this).css('color', '#ee2f69');
                    /** いいねカウントアップ **/
                    var count_url = "{{ route('postCountUp') }}";
                    var count_article_id = $(this).find('.article_id').val();
                    $.ajax({
                        url: count_url,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            article_id: count_article_id
                        },
                    }).done(function(data) {
                        alert(data.message);
                    }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
                        alert("error");
                        console.log("XMLHttpRequest : " + XMLHttpRequest.status);
                        console.log("textStatus     : " + textStatus);
                        console.log("errorThrown    : " + errorThrown.message);
                    })
                    /** お気に入り登録 **/
                    var favorite_url = "{{ route('favoriteRegister') }}";
                    var favorite_article_id = $(this).find('.article_id').val();
                    $.ajax({
                        url: favorite_url,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            article_id: favorite_article_id
                        },
                    }).done(function(data) {
                        alert(data.message);
                    }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
                        alert("error");
                        console.log("XMLHttpRequest : " + XMLHttpRequest.status);
                        console.log("textStatus     : " + textStatus);
                        console.log("errorThrown    : " + errorThrown.message);
                    })
                } else {
                    $(this).css('color', '#d1d1d1');
                    /** いいねカウントダウン **/
                    var count_url = "{{ route('postCountDown') }}";
                    var count_article_id = $(this).find('.article_id').val();
                    $.ajax({
                        url: count_url,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            article_id: count_article_id
                        },
                    }).done(function(data) {
                        alert(data.message);
                    }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
                        alert("error");
                        console.log("XMLHttpRequest : " + XMLHttpRequest.status);
                        console.log("textStatus     : " + textStatus);
                        console.log("errorThrown    : " + errorThrown.message);
                    })
                    /** おき入り削除 **/
                    var favorite_url = "{{ route('favoriteDelete') }}";
                    var favorite_article_id = $(this).find('.article_id').val();
                    $.ajax({
                        url: favorite_url,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            article_id: favorite_article_id
                        },
                    }).done(function(data) {
                        alert(data.message);
                    }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
                        alert("error");
                        console.log("XMLHttpRequest : " + XMLHttpRequest.status);
                        console.log("textStatus     : " + textStatus);
                        console.log("errorThrown    : " + errorThrown.message);
                    })
                }
            });
        });
    </script>