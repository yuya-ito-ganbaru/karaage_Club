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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="d-flex flex-column">
    <main class="flex-shrink-0">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container px-5">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('top') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('store') }}">
                        <h1>storeページ</h1>
                    </a>
                </div>
                <!-- ユーザーページ -->
                @if(Auth::check())
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <h1>userページ</h1>
                    </a>
                </div>
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <h1>お気に入りページへ</h1>
                        {{ $allUsers->id }}
                    </a>
                </div>
                @else
                <!-- ログイン、新規登録 -->
                <div>
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                </div>
                @endif
                <!-- 問い合わせ -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('form') }}">
                        <h1>お問い合せページ</h1>
                    </a>
                </div>
            </div>
        </nav>

        <!-- Header-->
        <header class="py-5">
            <div class="container px-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xxl-6">

                    </div>
                </div>
            </div>
        </header>

        <!-- About section one-->
        @foreach($articles as $article)
        <section class="py-5 bg-light" id="scroll-target">
            <div class="container px-5 my-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6"><img class="img-fluid rounded mb-5 mb-lg-0" src="{{ asset('storage/article_images/' . $article->image) }}" alt="..." /></div>
                    <div class="col-lg-6">
                        <h2 class="fw-bolder">{{ $article->title }}</h2>
                        <p class="lead fw-normal text-muted mb-0">{{ $article->body }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- About section two-->
        <section class="py-5">
            <div class="container px-5 my-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6 order-first order-lg-last"><img class="img-fluid rounded mb-5 mb-lg-0" src="{{ asset('storage/article_images/' . $article->image) }}" alt="..." /></div>
                    <div class="col-lg-6">
                        <h2 class="fw-bolder">{{ $article->title }}</h2>
                        <p class="lead fw-normal text-muted mb-0">{{ $article->body }}</p>
                    </div>
                </div>
            </div>
        </section>
        @endforeach
        <!-- Page Content-->
        <section class="py-5">
            <div class="container px-5 my-5">
                <div class="row gx-5">
                    @foreach($articles as $article)
                    <div style="width: 100%;" class="col-lg-9">
                        <!-- Post content-->
                        <article>

                            <!-- Preview image figure-->
                            <figure class="mb-4"><img class="img-fluid rounded" src="{{ asset('storage/article_images/' . $article->image) }}" alt="..." /></figure>
                            <!-- Post content-->
                            <section class="mb-5">
                                <div style="border-bottom:1px solid #d1cfcf;">

                                    <p class="fs-5 mb-4">{{ $article->title }}</p>
                                </div>
                                <div style="margin-top:2%; border-bottom:1px solid #d1cfcf;">

                                    <p class="fs-5 mb-4">{{ $article->tag }}</p>
                                </div>
                                <div style="margin-top:2%; border-bottom:1px solid #d1cfcf;">
                                    <p class="fs-5 mb-4">{{ $article->store }}</p>
                                    <p class="fs-5 mb-4">{{ $article->address }}</p>
                                </div>
                                <div style="margin-top:2%; border-bottom:1px solid #d1cfcf; min-height: 350px;" class="form-floating">
                                    <p class="fs-5 mb-4">{{ $article->body }}</p>
                                </div>
                            </section>
                        </article>
                    </div>
                    @endforeach
                </div>
        </section>
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

                                    <h5 class="card-title mb-3"><a href="{{ route('pageView', ['id' => $article->id]) }}">{{ $article->title }}</a></h5>
                                    @if(Auth::check())
                                    <i class="click fa-solid fa-heart" style="margin:0 10px; font-size:20px; color: #d1d1d1;">
                                        <input class="article_id" type="hidden" name="article_id" value="{{ $article->id }}">
                                    </i>
                                    @endif
                                </div>

                                <p class="card-text mb-0">{{ $article->tag }}</p>
                            </div>
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
        </div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
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