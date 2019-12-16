<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Welcome
                </div>
            
                <form action="/search" >
                    Search Services <br>
                    <!-- <input type="text" placeholder="Search For Service.." id='autocomplete' onFocus="geolocate()" id="search" name="search"> -->
                    <input type="text" placeholder="Search For Service.." id="search" name="search">
                    <select name="distance" id="distance">
                        <option value="1">1 Km</option>
                        <option value="2">2 Km</option>
                        <option value="5">5 Km</option>
                        <option value="10">10 Km</option>
                        <option value="25">25 Km</option>
                        <option value="50">50 Km</option>
                        <option value="100">100 Km</option>
                        <option value="anywhere">Anywhere</option>
                    </select>
                    <button id='submit'><span class="glyphicon glyphicon-search"></span></button>
                </form>
            </div>
        </div>
    </body>
    
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBao889J8MJPwOnn70VyKB1TMSwoCYJaY&libraries=places&callback=initAutocomplete" async defer></script> -->

<script>
$(document).ready(function() {

    var placeSearch, autocomplete;
    var lat, long;

    // var componentForm = {
    //     street_number: 'short_name',
    //     route: 'long_name',
    //     locality: 'long_name',
    //     administrative_area_level_1: 'short_name',
    //     country: 'long_name',
    //     postal_code: 'short_name'
    // };

    $('#submit').click(function(e){
        e.preventDefault;
        var search = $('#search').val();
        var distance = $('#distance').val();
        $.ajax({
            type: "POST",
            url: "/search",
            data:{ search: search, distance:distance, lat: 43.183941, long: -87.905029, _token: '{{csrf_token()}}' },
            contentType: "json",
            processData: false,
            success: function(data){
                console.log(data); 
            },
            error: function() {
                console.log('request failed');
            }
        });
    });

    // function getLocation() {
    //     if (navigator.geolocation) {
    //         console.log('no');
    //     } else {
    //         console.log('display');
    //     }
    // }

    // function initAutocomplete() {
    //     // Create the autocomplete object, restricting the search predictions to
    //     // geographical location types.
    //     autocomplete = new google.maps.places.Autocomplete(
    //         document.getElementById('autocomplete'), {types: ['geocode']});

    //     // Avoid paying for data that you don't need by restricting the set of
    //     // place fields that are returned to just the address components.
    //     autocomplete.setFields(['address_component']);

    //     // When the user selects an address from the drop-down, populate the
    //     // address fields in the form.
    //     autocomplete.addListener('place_changed', fillInAddress);
    //     }

    //     function fillInAddress() {
    //     // Get the place details from the autocomplete object.
    //     var place = autocomplete.getPlace();

    //     for (var component in componentForm) {
    //         document.getElementById(component).value = '';
    //         document.getElementById(component).disabled = false;
    //     }

    //     // Get each component of the address from the place details,
    //     // and then fill-in the corresponding field on the form.
    //     for (var i = 0; i < place.address_components.length; i++) {
    //         var addressType = place.address_components[i].types[0];
    //         if (componentForm[addressType]) {
    //         var val = place.address_components[i][componentForm[addressType]];
    //         document.getElementById(addressType).value = val;
    //         }
    //     }
    // }

    // // Bias the autocomplete object to the user's geographical location,
    // // as supplied by the browser's 'navigator.geolocation' object.
    // function geolocate() {
    //     if (navigator.geolocation) {
    //         navigator.geolocation.getCurrentPosition(function(position) {
    //         var geolocation = {
    //             lat: position.coords.latitude,
    //             lng: position.coords.longitude
    //         };
    //         lat = geolocation.lat;
    //         long = geolocation.lng;
    //         var circle = new google.maps.Circle(
    //             {center: geolocation, radius: position.coords.accuracy});
    //         autocomplete.setBounds(circle.getBounds());
    //         });
    //     }
    // }
});
</script>

</html>
