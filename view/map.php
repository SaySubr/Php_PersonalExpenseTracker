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

    <div id="modal-container"></div> 

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
    openModal(`
        <strong>${store.name}</strong><br>
        Трата: ${store.expenses}<br>
        Категория: ${store.category}
    `);
});

      
       // Массив для хранения маркеров
        const markers = [];

        // Функция для добавления маркера при клике на карту
        map.on('click', function(e) {
            const lat = e.latlng.lat;
            const lon = e.latlng.lng;

            // Создаем маркер
            const marker = L.marker([lat, lon]).addTo(map);
            markers.push(marker);

            // Загружаем модальное окно из modal.php
            fetch('modal.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('modal-container').innerHTML = data;
                    openModal();

                    

                    marker.on("click", () => {
                        openModal();
                    });
                });
        });

        function openModal() {
            document.getElementById("modal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("modal").style.display = "none";
        }


</script>