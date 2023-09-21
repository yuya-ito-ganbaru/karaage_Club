<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>topPage</title>
    <!--jquery-->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- FontIcon -->
    <script src="https://kit.fontawesome.com/aa126b8606.js" crossorigin="anonymous"></script>
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <!-- Logo -->
    <div class="shrink-0 flex items-center">
        <a href="{{ route('top') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
            <h1>トップページ</h1>
        </a>
        <i class="click fa-solid fa-heart" style="color: #ee2f69;"></i>
    </div>
    @if(Auth::check())
    <div class="shrink-0 flex items-center">
        <a href="{{ route('dashboard') }}">
            <h1>userページ</h1>
        </a>
    </div>
    @else
    <div>
        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
    </div>
    @endif

    @if(Auth::check())
    <br><br>
    <div class="shrink-0 flex items-center">
        <a href="{{ route('dashboard') }}">
            <h1>お気に入りページへ</h1>
            {{ $allUsers->id }}
        </a>
    </div>
    <br><br>
    @endif


    <div style="display: flex;">
        <div style="width:50%">
            <p>プロフィールページ</p>
            <ul class="list-group list-group-numbered">
                @foreach($allProfiles as $profile)
                <li class="list-group-item">
                    <p>プロフィールID:{{ $profile->id }}</p>
                    <p>プロフィール名:{{ $profile->nickname }}</p>
                    <p>登録日:{{ $profile->created_at->format('Y-m-d') }}</p>
                </li>
                @endforeach
            </ul>
        </div>
        <div style="width:50%">
            <p>コンテンツページ</p>
            <ul class="list-group list-group-numbered">
                @foreach($allArticles as $article)
                <li class="list-group-item">
                    <p>投稿タイトル:{{ $article->title }}</p>
                    <p>投稿タイトル:{{ $article->body }}</p>
                    <p>投稿日:{{ $article->created_at->format('Y-m-d') }}</p>
                    @if(Auth::check())
                    <i class="click fa-solid fa-heart" style="color: #d1d1d1;">
                        <input class="article_id" type="hidden" name="article_id" value="{{ $article->id }}">
                    </i>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @if(Auth::check())
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
    @endif
</body>

</html>