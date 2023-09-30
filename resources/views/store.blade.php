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
    <div class="shrink-0 flex items-center">
        <a href="{{ route('top') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
        </a>
    </div>
    {{------------------------- google パーツ-------------------------------------}}
    <form action="{{ route('storeRegister') }}" method="post">
        @csrf
        <input name="store" type="text" id="place-name-input" value="">
        <input name="address" type="text" id="place-address-input" value="">
        <input type="submit" value="送信">
    </form>
    <br><br><br>

    <div>
        <input id="pac-input" class="controls" type="text" placeholder="Enter a location" value="札幌市中央区宮の森"/>
    </div>
    <div id="map" style="width:600px; height:450px;"></div>
    <div id="infowindow-content">
        <span id="place-name" class="title"></span><br />
        <span id="place-address"></span>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsEew_vuhM5krFb3cgpZyh5hpveiyWfrY&callback=initMap&libraries=places&v=weekly" defer></script>
    {{------------------------- google パーツ-------------------------------------}}
    <script>
        function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    
                    lat: 43.068661,
                    lng: 141.350755
                   
                },
                zoom: 15,
            });
            const input = document.getElementById("pac-input");
            // Specify just the place data fields that you need.
            const autocomplete = new google.maps.places.Autocomplete(input, {
                fields: ["place_id", "geometry", "name", "formatted_address"],
                types: ['establishment'] // この行を追加して店舗名のみを検索
            });

            autocomplete.bindTo("bounds", map);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            const infowindow = new google.maps.InfoWindow();
            const infowindowContent = document.getElementById("infowindow-content");

            infowindow.setContent(infowindowContent);

            const geocoder = new google.maps.Geocoder();
            const marker = new google.maps.Marker({
                map: map

            });
            const nameInputElement = document.getElementById("place-name-input");
            const addressInputElement = document.getElementById("place-address-input");
            marker.addListener("click", () => {

                infowindow.open(map, marker);
            });
            autocomplete.addListener("place_changed", () => {
                infowindow.close();

                const place = autocomplete.getPlace();

                if (!place.place_id) {
                    return;
                }

                geocoder
                    .geocode({
                        placeId: place.place_id
                    })
                    .then(({
                        results
                    }) => {
                        map.setZoom(18);
                        map.setCenter(results[0].geometry.location);
                        // Set the position of the marker using the place ID and location.
                        // @ts-ignore TODO This should be in @typings/googlemaps.
                        marker.setPlace({
                            placeId: place.place_id,
                            location: results[0].geometry.location,
                        });
                        marker.setVisible(true);
                        nameInputElement.value = place.name;
                        addressInputElement.value = results[0].formatted_address;
                        infowindowContent.children["place-name"].textContent = place.name;
                        //infowindowContent.children["place-id"].textContent = place.place_id;
                        infowindowContent.children["place-address"].textContent = results[0].formatted_address;
                        //infowindow.open(map, marker);
                    })
                    .catch((e) => window.alert("Geocoder failed due to: " + e));
            });
        }

        window.initMap = initMap;
    </script>

</body>

</html>