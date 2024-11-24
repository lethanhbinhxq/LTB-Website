<!DOCTYPE html>
<html>

<head>
    <title>Shop Map</title>
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
</head>

<body>
    <div>
        <!-- Store List -->
        <div class="mb-3">
            <h3 class="my-2 text-center fw-bold text-main-pink">Shopping Sites:</h3>
        </div>

        <!-- Map -->
        <div id="map" style="width: 100%; height: 600px"></div>
    </div>

    <script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
    <script>
        // Map options
        var mapOptions = {
            center: [10.772948875264623, 106.65871647400839],
            zoom: 12
        };

        // Create map
        var map = new L.map('map', mapOptions);
        var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
        map.addLayer(layer);

        // Store data
        var stores = [
            { name: "Store A", address: "268 Ly Thuong Kiet, Ward 14, Distric 10, HCM City", coords: [10.772948875264623, 106.65871647400839] },
            { name: "Store B", address: "30 Tan Thang, Son Ky Ward, Tan Phu District, HCM City", coords: [10.801707264198013, 106.61742529596906] },
            { name: "Store C", address: "302 Dien Bien Phu, Ward 17, Binh Thanh District, HCM City", coords: [10.803220779870303, 106.70679852018414] }
        ];

        // Create markers for each store
        stores.forEach((store) => {
            var marker = L.marker(store.coords).addTo(map);
            marker.bindPopup(`
            <i class="bi bi-geo-alt-fill text-main-pink" style="font-size: larger"></i>
            <b class='text-main-pink'>${store.name}</b>
            <br>${store.address}
            `);
        });
    </script>
</body>

</html>