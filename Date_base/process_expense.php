<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product = $_POST['product'] ?? '';
    $amount = $_POST['amount'] ?? 0;
    $category = $_POST['category'] ?? '';
    $lat = $_POST['lat'] ?? '';
    $lon = $_POST['lon'] ?? '';

    $data = "Товар: $product, Сумма: $amount, Категория: $category, Lat: $lat, Lon: $lon\n";
    file_put_contents('../view/expenses.txt', $data, FILE_APPEND);

    header('Location: ../view/map.php');
    exit;
} else {
    echo "Недопустимый метод запроса.";
}
