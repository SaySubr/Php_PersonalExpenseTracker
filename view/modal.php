<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="/css/modal.css"/>
    <title>Карта с магазинами</title>
</head>
<body>

<div id="modal" style="display:none; position:fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); z-index: 1000; width: 300px;">
    <h4>Добавить трату</h4>
    <form id="expense-form" method="post" action="Date_base/process_expense.php">
        <div class="form-group">
            <label for="product">Товар</label>
            <input required type="text" name="product" id="product" placeholder="Введите товар" />
        </div>
        <div class="form-group">
            <label for="amount">Сумма</label>
            <input required type="number" name="amount" id="amount" placeholder="Введите сумму" />
        </div>
        <div class="form-group">
            <label for="category">Категория</label>
            <select required name="category" id="category">
                <option value="Еда">Еда</option>
                <option value="Транспорт">Транспорт</option>
                <option value="Развлечение">Развлечение</option>
                <option value="Другие">Другие</option>
            </select>
        </div>
        <button type="submit">Подтвердить</button>
        <button type="button" onclick="closeModal()">Закрыть</button>
    </form>
</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    const map = L.map('map').setView([56.0106, 92.8526], 11);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    // Загружаем данные о маркерах с сервера
    fetch('service/markers.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(store => {
                const marker = L.marker([store.lat, store.lon]).addTo(map);
                marker.bindPopup(`${store.name}`).openPopup();

                marker.on("click", () => {
                    // Открываем модальное окно при клике на маркер
                    openModal();
                });
            });
        })
        .catch(() => {
            console.error('Ошибка при загрузке маркеров');
        });

    function openModal() {
        document.getElementById("modal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("modal").style.display = "none";
    }
</script>
</body>
</html>
