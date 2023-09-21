<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!--jquery-->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

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
        /*
        const radioButtons = document.querySelectorAll('input[type="radio"]');
        const selectedValueInput = document.getElementById('selectedRecommendValue');

        radioButtons.forEach(radioButton => {
            radioButton.addEventListener('click', () => {
                selectedValueInput.value = radioButton.value;

            });
        });
        */
    </script>
    
    
</body>

</html>