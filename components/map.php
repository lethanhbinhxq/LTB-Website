<!DOCTYPE html>
<html>

<head>
    <title>Shop Map</title>
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
</head>

<body>
    <div>
        <div class="mb-3 d-flex justify-content-center align-items-center">
            <input type="text" id="locationInput" placeholder="Enter address or coordinates"
                class="form-control custom-search me-2" />
            <button class="btn btn-primary" onclick="searchLocation()">Search</button>
        </div>

        <div id="map" style="width: 100%; height: 600px"></div>
    </div>

    <script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
    <script>
        // Creating map options
        var mapOptions = {
            center: [10.772948875264623, 106.65871647400839],
            zoom: 14
        }

        // Creating a map object
        var map = new L.map('map', mapOptions);

        // Creating a Layer object
        var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');

        // Adding layer to the map
        map.addLayer(layer);

        var marker = L.marker(mapOptions.center);
        marker.addTo(map);

        // Function to search for location
        function searchLocation() {
            var input = document.getElementById('locationInput').value;

            // Check if input is coordinates
            if (/^-?\d+(\.\d+)?,\s*-?\d+(\.\d+)?$/.test(input)) {
                var coords = input.split(',');
                var lat = parseFloat(coords[0].trim());
                var lng = parseFloat(coords[1].trim());
                map.setView([lat, lng], 12);
                marker.setLatLng([lat, lng]);
            } else {
                // Otherwise, treat input as an address and use Nominatim API
                var url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(input)}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.length > 0) {
                            var lat = data[0].lat;
                            var lng = data[0].lon;
                            map.setView([lat, lng], mapOptions.zoom);
                            marker.setLatLng([lat, lng]);
                        } else {
                            alert("Location not found");
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("Error fetching location data");
                    });
            }
        }
    </script>
</body>

</html>