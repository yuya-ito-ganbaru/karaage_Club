<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ('新規投稿') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ ('新規投稿フォーム') }}
                    <form action="{{ route('postCreate') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div style="display: flex;">
                            <div style="width: 70%;" class="p-6">

                                <div style="width: 100%; height: 0; padding-bottom: 100%; position: relative;">
                                    <img id="file-preview" class="art_img" src="{{ asset('images/karaage.png') }}" alt="#">
                                </div>


                                <label for="formFile" class="form-label">投稿写真</label>
                                <input name="image" class="form-control" type="file" id="formFile">
                                @if($errors->has('image'))
                                <p style="color: red;">{{ $errors->first('image') }}</p>
                                @endif
                                <br>

                                <div class="review">
                                    <p>おすすめ度</p>
                                    <div class="stars">
                                        <span>
                                            <input id="review01" type="radio" name="recommend" value="5">
                                            <label for="review01">★</label>
                                            <input id="review02" type="radio" name="recommend" value="4">
                                            <label for="review02">★</label>
                                            <input id="review03" type="radio" name="recommend" value="3">
                                            <label for="review03">★</label>
                                            <input id="review04" type="radio" name="recommend" value="2">
                                            <label for="review04">★</label>
                                            <input id="review05" type="radio" name="recommend" value="1">
                                            <label for="review05">★</label>
                                        </span>
                                        @if($errors->has('recommend'))
                                        <p style="color: red;">{{ $errors->first('recommend') }}</p>
                                        @endif
                                    </div>
                                    <!--
                                    <input type="hidden" name="recommend" id="selectedRecommendValue" value="">
                                    -->
                                </div>
                            </div>
                            <div style="width: 100%;" class="p-6 text-gray-900">
                                <div>
                                    <label for="title" class="form-label">タイトル</label>
                                    @if($errors->has('title'))
                                    <p style="color: red;">{{ $errors->first('title') }}</p>
                                    @endif
                                    <input id="title" name="title" style="border-radius: 5px; border:1px solid #d1cfcf;;" type="text" class="form-control" value="{{ old('title') }}">
                                </div>
                                <div style="margin-top:2%;">
                                    <label for="tag" class="form-label">タグ</label>
                                    <input id="tag" name="tag" style="border-radius: 5px; border:1px solid #d1cfcf;;" type="text" class="form-control" value="{{ old('tag') }}">
                                </div>
                                {{------------------------- google パーツ-------------------------------------}}

                                <input name="store" type="hidden" id="place-name-input" value="">
                                <input name="address" type="hidden" id="place-address-input" value="">

                                <div style="margin-top: 10px;">
                                    <label>ここどこ？</label>
                                    <input id="pac-input" class="controls" type="text" placeholder="Enter a location" />
                                </div>
                                <div id="map" style="display:none; width:10px; height:10px;"></div>
                                <div id="infowindow-content">
                                    <span id="place-name" class="title"></span><br />
                                    <span id="place-address"></span>
                                </div>

                                {{------------------------- google パーツ-------------------------------------}}
                                <div style="margin-top:10px;" class="form-floating">
                                    @if($errors->has('body'))
                                    <p style="color: red;">{{ $errors->first('body') }}</p>
                                    @endif
                                    <textarea name="body" class="form-control" placeholder="自己紹介" id="floatingInput" style="min-height: 350px; margin:5px;">{{ old('body') }}</textarea>
                                    <label style="color: #d1cfcf;" for="floatingInput">投稿記事</label>
                                </div>
                            </div>
                        </div>

                        <input style="background-color: black; border-color: white; margin-top:2%; padding:10px 30px;" type="submit" class="btn btn-dark" name="submit" id="submit" value="送信">
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsEew_vuhM5krFb3cgpZyh5hpveiyWfrY&callback=initMap&libraries=places&v=weekly" defer></script>
<script>
    //articlePost
    document.addEventListener('DOMContentLoaded', function() {

        var formFileInput = document.getElementById('formFile');
        var imgPreview = document.getElementById('file-preview');

        formFileInput.addEventListener('change', function(e) {
            //1枚表示
            var file = e.target.files[0];
            //ファイルのブラウザ上でのURLを取得する
            var blobUrl = window.URL.createObjectURL(file);
            //img要素に表示
            var img = document.getElementById('file-preview');
            img.src = blobUrl;


        });
    });
</script>
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