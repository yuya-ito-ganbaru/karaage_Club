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
        <section class="py-5 bg-light" id="scroll-target">
            <div class="container px-5 my-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6"><img class="img-fluid rounded mb-5 mb-lg-0" src="https://dummyimage.com/600x400/343a40/6c757d" alt="..." /></div>
                    <div class="col-lg-6">
                        <h2 class="fw-bolder">Our founding</h2>
                        <p class="lead fw-normal text-muted mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto est, ut esse a labore aliquam beatae expedita. Blanditiis impedit numquam libero molestiae et fugit cupiditate, quibusdam expedita, maiores eaque quisquam.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- About section two-->
        <section class="py-5">
            <div class="container px-5 my-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6 order-first order-lg-last"><img class="img-fluid rounded mb-5 mb-lg-0" src="https://dummyimage.com/600x400/343a40/6c757d" alt="..." /></div>
                    <div class="col-lg-6">
                        <h2 class="fw-bolder">Growth &amp; beyond</h2>
                        <p class="lead fw-normal text-muted mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto est, ut esse a labore aliquam beatae expedita. Blanditiis impedit numquam libero molestiae et fugit cupiditate, quibusdam expedita, maiores eaque quisquam.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Page Content-->
        <section class="py-5">
            <div class="container px-5 my-5">
                <div class="row gx-5">
                    
                    <div style="width: 100%;" class="col-lg-9">
                        <!-- Post content-->
                        <article>
                            
                            <!-- Preview image figure-->
                            <figure class="mb-4"><img class="img-fluid rounded" src="https://dummyimage.com/900x400/ced4da/6c757d.jpg" alt="..." /></figure>
                            <!-- Post content-->
                            <section class="mb-5">
                                <p class="fs-5 mb-4">Science is an enterprise that should be cherished as an activity of the free human mind. Because it transforms who we are, how we live, and it gives us an understanding of our place in the universe.</p>
                                <p class="fs-5 mb-4">The universe is large and old, and the ingredients for life as we know it are everywhere, so there's no reason to think that Earth would be unique in that regard. Whether of not the life became intelligent is a different question, and we'll see if we find that.</p>
                                <p class="fs-5 mb-4">If you get asteroids about a kilometer in size, those are large enough and carry enough energy into our system to disrupt transportation, communication, the food chains, and that can be a really bad day on Earth.</p>
                                <h2 class="fw-bolder mb-4 mt-5">I have odd cosmic thoughts every day</h2>
                                <p class="fs-5 mb-4">For me, the most fascinating interface is Twitter. I have odd cosmic thoughts every day and I realized I could hold them to myself or share them with people who might be interested.</p>
                                <p class="fs-5 mb-4">Venus has a runaway greenhouse effect. I kind of want to know what happened there because we're twirling knobs here on Earth without knowing the consequences of it. Mars once had running water. It's bone dry today. Something bad happened there as well.</p>
                            </section>
                        </article>
                    </div>
                </div>
        </section>
        <!-- Blog preview section-->
        <section class="py-5">
            <div class="container px-5 my-5">

                <div class="row gx-5">
                    @foreach($allArticles as $article)
                    <div class="col-lg-4 mb-5">
                        <div class="card h-100 shadow border-0">
                            <img style="height: inherit;" class="card-img-top" src="{{ asset('storage/article_images/' . $article->image) }}" alt="..." />
                            <div class="card-body p-4">
                                <div style="display: flex;">
                                <h5 class="card-title mb-3">{{ $article->title }}</h5>
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