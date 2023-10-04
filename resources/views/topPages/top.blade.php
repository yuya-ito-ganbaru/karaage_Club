<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>topPage</title>
    <!--jquery-->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!--google-->
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <!-- FontIcon -->
    <script src="https://kit.fontawesome.com/aa126b8606.js" crossorigin="anonymous"></script>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
    <!-- Styles -->
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /**** 評価ボタンのcss ****/
        .stars span {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }

        
        .stars input[type='radio'] {
            display: none;
        }

        .stars label {
            color: #D2D2D2;
            font-size: 30px;
            padding: 0 5px;
            cursor: pointer;
        }

        .stars label:hover,
        .stars label:hover~label,
        .stars input[type='radio']:checked~label {
            color: #F8C601;
        }

        .stars_conf {
            pointer-events: none;
        }

        .review {
            padding-top: 10px;
            padding-bottom: 10px;
        }
    </style>
</head>

<body class="d-flex flex-column">
    <main class="flex-shrink-0">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container px-5">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('store') }}">
                        <h1>storeページ</h1>
                    </a>
                </div>
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('top') }}">
                        <x-application-logo style="width:100px; height:100px;" class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>
                <!-- ユーザーページ -->
                @if(Auth::check())
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <h1>userページ</h1>
                    </a>
                </div>
                @else
                <!-- ログイン、新規登録 -->
                <div style="border: 0px;">
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text  focus:outline-2 focus:rounded-sm">Log in</a>
                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text  focus:outline-2 focus:rounded-sm">Register</a>
                </div>
                @endif

            </div>
        </nav>
      
        <section><div id="app"></div></section>

        <!-- Blog preview section-->
        <section class="py-5">
            <div class="container px-5 my-5">

                <div class="row gx-5">
                    @foreach($allArticles as $article)
                    <div class="col-lg-4 mb-5">
                        <div class="card h-100 shadow border-0">
                            <a href="{{ route('pageView', ['id' => $article->id]) }}"><img style="height: inherit;" class="card-img-top" src="{{ asset('storage/article_images/' . $article->image) }}" alt="..." /></a>

                            <div class="card-body p-4">
                                <div style="display: flex;">

                                    <h5 class="card-title mb-3"></h5>
                                    @if(Auth::check())
                                    <i class="click fa-solid fa-heart" style="margin:0 10px; font-size:20px; color: #d1d1d1;">
                                        <input class="article_id" type="hidden" name="article_id" value="{{ $article->id }}">
                                    </i>
                                    @endif
                                </div>
                                <p class="card-text mb-0">{{ $article->tag }}{{ $article->id }}</p>
                            </div>
                            
                            <!-- トリガーボタン -->
                            <a href="{{ route('pageView', ['id' => $article->id]) }}"><button style="width: -webkit-fill-available;" class="load-content-button btn btn-primary">コンテンツを読み込む</button></a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

    </main>

    <!-- Footer-->
    <footer class="py-4 mt-auto bg-light">
        <div class="container px-5">
            {{ 'footer' }}
            <!-- 問い合わせ -->
            <div style="justify-content: end;" class="shrink-0 flex items-center">
                <a href="{{ route('form') }}">
                    <h1>お問い合せページ</h1>
                </a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('js/scripts.js') }}"></script>
    
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
