<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- リファクタリング予定 css作業スペース -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- accountProfile CSS -->
    <style>
        .btn-danger:hover {
            background-color: red;
            color: white;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
        }
        /**** 評価ボタンのcss ****/
        .stars span {
            display: flex;
            /* 要素をフレックスボックスにする */
            flex-direction: row-reverse;
            /* 星を逆順に並べる */
            justify-content: flex-end;
            /* 逆順なので、左寄せにする */
        }
        .stars input[type='radio'] {
            display: none;
            /* デフォルトのラジオボタンを非表示にする */
        }
        .stars label {
            color: #D2D2D2;
            /* 未選択の星をグレー色に指定 */
            font-size: 30px;
            /* 星の大きさを30pxに指定 */
            padding: 0 5px;
            /* 左右の余白を5pxに指定 */
            cursor: pointer;
            /* カーソルが上に乗ったときに指の形にする */
        }
        .stars label:hover,
        .stars label:hover~label,
        .stars input[type='radio']:checked~label {
            color: #F8C601;
            /* 選択された星以降をすべて黄色にする */
        }


        .star5_rating {
            position: relative;
            z-index: 0;
            display: inline-block;
            white-space: nowrap;
            color: #CCCCCC;
            /* グレーカラー 自由に設定化 */
            font-size: 20px;
            /*フォントサイズ 自由に設定化 */
        }
        .star5_rating:before,
        .star5_rating:after {
            content: '★★★★★';
        }
        .star5_rating:after {
            position: absolute;
            z-index: 1;
            top: 0;
            left: 0;
            overflow: hidden;
            white-space: nowrap;
            color: #ffcf32;
            /* イエローカラー 自由に設定化 */
        }
        .star5_rating[data-rate="5"]:after {
            width: 100%;
        }
        /* 星5 */
        .star5_rating[data-rate="4"]:after {
            width: 80%;
        }
        /* 星4 */
        .star5_rating[data-rate="3"]:after {
            width: 60%;
        }
        /* 星3 */
        .star5_rating[data-rate="2"]:after {
            width: 40%;
        }
        /* 星2 */
        .star5_rating[data-rate="1"]:after {
            width: 20%;
        }
        /* 星1 */
        .star5_rating[data-rate="0"]:after {
            width: 0%;
        }
        /* 星0 */
        .review {
            padding-top: 10px;
            padding-bottom: 10px;
        }
    </style>
    <!-- リファクタリング予定 css作業スペース -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <!-- リファクタリング予定 js作業スペース -->
    <script>
        const radioButtons = document.querySelectorAll('input[type="radio"]');
        const selectedValueInput = document.getElementById('selectedRecommendValue');

        radioButtons.forEach(radioButton => {
            radioButton.addEventListener('click', () => {
                selectedValueInput.value = radioButton.value;
            });
        });
    </script>
</body>
</html>