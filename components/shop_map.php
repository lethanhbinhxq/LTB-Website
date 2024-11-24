<!DOCTYPE html>
<html>

<head>
    <title>Shop Map</title>
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
</head>

<body>
    <div>
        <!-- Search bar -->
        <div class="mb-3 d-flex justify-content-center align-items-center">
            <input type="text" id="locationInput" placeholder="Enter address or coordinates"
                class="form-control custom-search me-2" />
            <button class="btn btn-primary" onclick="searchLocation()">Search</button>
        </div>

        <!-- Store List -->
        <div class="mb-3">
            <h3 class="my-2 text-center fw-bold text-main-pink">Shopping Sites:</h3>
            <ul id="storeList">
                <!-- Stores will be dynamically populated here -->
            </ul>
        </div>

        <!-- Map -->
        <div id="map" style="width: 100%; height: 600px"></div>
    </div>

    <script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
    <script>
        // Map options
        var mapOptions = {
            center: [10.772948875264623, 106.65871647400839],
            zoom: 14
        };

        // Create map
        var map = new L.map('map', mapOptions);
        var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
        map.addLayer(layer);

        // Marker for store locations
        var marker = L.marker(mapOptions.center);
        marker.addTo(map);

        // Store data
        var stores = [
            { name: "Store A", address: "268 Ly Thuong Kiet, Ward 14, Distric 10, HCM City", coords: [10.772948875264623, 106.65871647400839] },
            { name: "Store B", address: "30 Tan Thang, Son Ky Ward, Tan Phu District, HCM City", coords: [10.801707264198013, 106.61742529596906] },
            { name: "Store C", address: "302 Dien Bien Phu, Ward 17, Binh Thanh District, HCM City", coords: [10.803220779870303, 106.70679852018414] }
        ];

        // Populate store list
        var storeList = document.getElementById('storeList');
        stores.forEach((store, index) => {
            var listItem = document.createElement('li');
            listItem.classList.add('store-item');
            listItem.innerHTML = `
                <i class="bi bi-shop-window me-2 text-main-pink" style="font-size: larger;"></i>
                <strong>${store.name}</strong>: ${store.address}
                <button class="btn btn-primary p-1 m-1" onclick="showStore(${index})">View on Map</button>
                <button class="btn btn-secondary p-1 m-1" onclick="window.open('https://www.google.com/maps?q=${store.coords[0]},${store.coords[1]}', '_blank')">Open in Google Maps</button>
            `;
            storeList.appendChild(listItem);
        });

        // Show store on the map
        function showStore(index) {
            var store = stores[index];
            map.setView(store.coords, 14);
            marker.setLatLng(store.coords);
        }

        // Search location
        function searchLocation() {
            var input = document.getElementById('locationInput').value;

            if (/^-?\d+(\.\d+)?,\s*-?\d+(\.\d+)?$/.test(input)) {
                // Handle coordinates input
                var coords = input.split(',');
                var lat = parseFloat(coords[0].trim());
                var lng = parseFloat(coords[1].trim());
                map.setView([lat, lng], 14);
                marker.setLatLng([lat, lng]);
            } else {
                // Handle address input with Nominatim API
                var url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(input)}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.length > 0) {
                            var lat = data[0].lat;
                            var lng = data[0].lon;
                            map.setView([lat, lng], 14);
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
