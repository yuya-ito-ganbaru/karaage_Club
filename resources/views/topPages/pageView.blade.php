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
    <!-- リファクタリング予定 css作業スペース -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        /**** accountProfile css ****/
        .btn-danger:hover {
            background-color: red;
            color: white;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
        }

        .prof_img {
            border: 1px solid #d1cfcf;
            border-radius: 50%;
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
        }

        /**** articlePost css ****/
        .art_img {
            border: 1px solid #d1cfcf;
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
        }

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
    <!-- リファクタリング予定 css作業スペース -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- FontIcon -->
    <script src="https://kit.fontawesome.com/aa126b8606.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="d-flex flex-column">
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
                                    <div style="width: 100%; height: 0; position: relative;">

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
                                            <div style="margin-top:2%; border-bottom:1px solid #d1cfcf;">
                                                <p class="fs-5 mb-4">{{ $article->store }}</p>
                                                <p class="fs-5 mb-4">{{ $article->address }}</p>
                                            </div>
                                            <div style="margin-top:2%; border-bottom:1px solid #d1cfcf; min-height: 350px;" class="form-floating">
                                                <p class="fs-5 mb-4">{{ $article->body }}</p>
                                            </div>
                                        </div>
                                    </section>
                                </article>
                            </div>
                    </section>
                    @endforeach
                    <button type="button" onClick="history.back()">戻る</button>

                </div>
            </div>

        </div>
    </div>

</body>

</html>