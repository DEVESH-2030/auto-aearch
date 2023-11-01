<!DOCTYPE html>
<html lang="en">

<head>
    <title>Auto Search</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCf6n6v9CZTKXOAZXmuiGGSVsFHHb8iVTw&libraries=places&callback=initMap">
    </script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <div class="container mt-3">

        <h2 style="text-align: center">Auto Search Location Using Google API</h2>

        <form action="{{ route('save-location') }}" method="POST">
            @csrf

            {{-- this is a sengle input search for example --}}
            <div class="mb-3 mt-6">
                <label for="address">Single Search Here:</label>
                <input type="text" class="form-control" id="location">
            </div>
            <br> <br>


            {{-- search and auto append data into input field --}}
            <div class="mb-3 mt-6">
                <label for="address">Auto Search :</label>
                <input type="text" class="form-control" id="search-input" placeholder="Please enter location...">
            </div>

            <div class="mb-3 mt-6">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" placeholder="Enter address" name="address" readonly>
            </div>

            <div class="mb-3">
                <label for="city">City:</label>
                <input type="city" class="form-control" id="city" placeholder="Enter city" name="city" readonly>
            </div>

            <div class="mb-3">
                <label for="state">State:</label>
                <input type="state" class="form-control" id="state" placeholder="Enter state" name="state" readonly>
            </div>

            <div class="mb-3">
                <label for="country">Country:</label>
                <input type="country" class="form-control" id="country" placeholder="Enter country" name="country" readonly>
            </div>

            <div class="mb-3">
                <label for="zip">Postal Zip Code:</label>
                <input type="zip" class="form-control" id="zip" placeholder="Enter zip" name="zip" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>


    {{-- search in list of response in single input field --}}
    <script type="text/javascript">
        $(document).ready(function() {
            var autocomplete;
            var search = 'location';

            autocomplete = new google.maps.places.Autocomplete((document.getElementById(search)), {
                types: ['geocode'],
            })
        })
    </script>

    {{-- auto search feature and append the response data into the input field on keyup --}}
    <script>
        // Google API key = AIzaSyCf6n6v9CZTKXOAZXmuiGGSVsFHHb8iVTw
        $(document).ready(function() {
            $('#search-input').on('input', function() {
                var searchQuery = $(this).val();
                var apiKey = "AIzaSyCf6n6v9CZTKXOAZXmuiGGSVsFHHb8iVTw";
                if (searchQuery) {
                    // Make an AJAX request to the Google Maps Geocoding API
                    $.ajax({
                        url: 'https://maps.googleapis.com/maps/api/geocode/json',
                        data: {
                            address: searchQuery,
                            key: apiKey // Replace with your actual API key
                        },
                        success: function(data) {
                            if (data.status === 'OK') {
                                var results = data.results[0];
                                var objects = results.address_components;

                                // left here console for check response address components data
                                console.log(objects);

                                $('#address').val(results.formatted_address);

                                // Initialize zip code if an empty then we set default 123456
                                var zipCode = 123456;

                                for (var i = 0; i < objects.length; i++) {

                                    var type = objects[i].types[0];

                                    if (type === 'locality') {
                                        $('#city').val(objects[i].long_name);

                                    } else if (type === 'administrative_area_level_1') {
                                        $('#state').val(objects[i].long_name);

                                    } else if (type === 'country') {
                                        $('#country').val(objects[i].long_name);

                                    } else if (type === 'postal_code') {
                                        // $('#zip').val(objects[i].long_name);
                                        zipCode = objects[i].long_name;
                                    }
                                }

                                // Set the zip code default
                                $('#zip').val(zipCode);
                            } else {
                                // we can handle error as well but for now I have display "no data found"
                                console.log('No data found');
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
