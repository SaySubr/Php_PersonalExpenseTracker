<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="map.css">
    <title>Карта с магазинами</title>
</head>
<body>

    <header>
        <div class="header-content">
            <div class="logo">Exam PHP</div>
            <a href="welcome.php" class="login-button">На главную</a>
        </div>
    </header>

    <h1>Магазины на карте</h1>
    <div id="map"></div>



</body>
</html>


<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
const map = L.map('map').setView([56.0106, 92.8526], 11);


L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap'
}).addTo(map);


const storeLocation = { name: "Пятёрочка", lat: 56.0123, lon: 92.8529 }; 
const marker = L.marker([storeLocation.lat, storeLocation.lon]).addTo(map);
marker.bindPopup("Магазин: Пятёрочка<br>Трата: молоко — 90 руб, хлеб — 40 руб, категория: Еда").openPopup();


marker.on("click", () => {
    marker.getPopup().setContent(`
        <strong>${storeLocation.name}</strong><br>
        Трата: молоко — 90 руб, хлеб — 40 руб<br>
        Категория: Еда
    `).openOn(map);
});

</script>