<?php
// --- Загрузка маркеров из expenses.txt ---
$markers = [];
if (file_exists('expenses.txt')) {
    $lines = file('expenses.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (preg_match('/Товар: (.*), Сумма: (.*), Категория: (.*), Lat: (.*), Lon: (.*)/', $line, $m)) {
            $markers[] = [
                'name' => trim($m[1]),
                'amount' => trim($m[2]),
                'category' => trim($m[3]),
                'lat' => floatval($m[4]),
                'lon' => floatval($m[5])
            ];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <link rel="stylesheet" href="map.css">
    <title>Карта расходов</title>
</head>
<body>
<header>
    <div class="header-content">
        <div class="logo">Exam PHP</div>
        <div class="buttons">
            <button id="show-expenses-btn">Траты за день</button>
            <form id="date-form" style="display:inline;">
                 <input type="date" id="date" name="date"
                     value="<?php echo htmlspecialchars($_GET['date'] ?? date('Y-m-d')); ?>">
                <button type="submit">Перейти</button>
            </form>
            <a href="welcome.php" class="login-button">На главную</a>
        </div>
    </div>
</header>

<h2 style="text-align:center;">Магазины и траты</h2>
<div id="map"></div>

<div id="sidebar">
    <h3>Траты за день</h3>
    <div id="expense-list">Выберите дату, чтобы увидеть расходы.</div>
</div>


<!-- Модалка -->
<div id="modal">
    <h3>Добавить трату</h3>
    <form id="expense-form">
        <label>Товар: <input type="text" name="item" required></label><br>
        <label>Сумма: <input type="number" name="amount" required></label><br>
        <label>Категория: <input type="text" name="category" required></label><br>
        <input type="hidden" name="lat">
        <input type="hidden" name="lon">
        <button type="submit">Сохранить</button>
        <button type="button" onclick="closeModal()">Отмена</button>
    </form>
</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
const map = L.map('map').setView([56.01, 92.85], 11);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap'
}).addTo(map);

// Загружаем маркеры из PHP
const markers = <?php echo json_encode($markers, JSON_UNESCAPED_UNICODE); ?>;
markers.forEach(m => {
    const popupContent = `
        <b>Товар:</b> ${m.name}<br>
        <b>Сумма:</b> ${m.amount}<br>
        <b>Категория:</b> ${m.category}<br><br>
        <button class="edit-btn" data-lat="${m.lat}" data-lon="${m.lon}" 
                data-name="${m.name}" data-amount="${m.amount}" data-category="${m.category}">
            Изменить
        </button>
    `;

    L.marker([m.lat, m.lon])
        .addTo(map)
        .bindPopup(popupContent);
});

// Обработчик кнопки "Изменить" внутри попапа
map.on('popupopen', e => {
    const btn = e.popup._contentNode.querySelector('.edit-btn');
    if (btn) {
        btn.addEventListener('click', () => {
            const modal = document.getElementById('modal');
            const form = document.getElementById('expense-form');

            // Подставляем старые данные в форму
            form.item.value = btn.dataset.name;
            form.amount.value = btn.dataset.amount;
            form.category.value = btn.dataset.category;
            form.lat.value = btn.dataset.lat;
            form.lon.value = btn.dataset.lon;

            // Меняем текст заголовка и кнопки
            modal.querySelector('h3').textContent = 'Изменить трату';
            form.querySelector('button[type="submit"]').textContent = 'Сохранить изменения';

            modal.style.display = 'block';
        });
    }
});




// При клике на карту — показать модалку
map.on('click', e => {
    const modal = document.getElementById('modal');
    const form = document.getElementById('expense-form');
    form.lat.value = e.latlng.lat;
    form.lon.value = e.latlng.lng;
    modal.style.display = 'block';
});

// Закрыть модалку
function closeModal() {
    document.getElementById('modal').style.display = 'none';
}

// Сохранить запись
document.getElementById('expense-form').addEventListener('submit', e => {
    e.preventDefault();
    const form = e.target;
    const data = new FormData(form);

    fetch('save_expense.php', {
        method: 'POST',
        body: data
    }).then(() => {
        location.reload();
    });
});

// --- Боковая панель ---
const sidebar = document.getElementById("sidebar");
const showBtn = document.getElementById("show-expenses-btn");
const expenseList = document.getElementById("expense-list");
const dateForm = document.getElementById("date-form");

// Показ / скрытие панели
showBtn.addEventListener("click", () => {
    sidebar.classList.toggle("active");
});

// Переход к другой дате (фильтрация расходов)
dateForm.addEventListener("submit", e => {
    e.preventDefault();
    const date = document.getElementById("date").value;

    fetch(`load_expenses.php?date=${encodeURIComponent(date)}`)
        .then(r => r.text())
        .then(html => {
            expenseList.innerHTML = html || "Нет данных за выбранную дату.";
        });
});



</script>
</body>
</html>
